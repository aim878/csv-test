<?php

namespace App\Services;

use Illuminate\Support\Collection;
use RuntimeException;

/**
 * Reads and appends rows of a CSV file whose first line is a header row.
 */
class CsvReader
{
    /** @var list<string> */
    protected array $header = [];

    /** @var list<array<string, string|null>> */
    protected array $rows = [];

    public function __construct(protected string $file)
    {
        $this->load();
    }

    public static function make(string $file): static
    {
        return new static($file);
    }

    /**
     * @return list<string>
     */
    public function header(): array
    {
        return $this->header;
    }

    public function all(): Collection
    {
        return collect($this->rows);
    }

    public function toArray(): array
    {
        return $this->rows;
    }

    public function toJson(int $options = 0): string
    {
        return json_encode($this->rows, $options | JSON_THROW_ON_ERROR);
    }

    public function count(): int
    {
        return count($this->rows);
    }

    /**
     * Append a row. Values are written in header order; missing keys become empty.
     *
     * @param  array<string, mixed>  $values
     * @return list<string>
     */
    public function append(array $values): array
    {
        $row = array_map(
            fn (string $column) => $this->sanitize((string) ($values[$column] ?? '')),
            $this->header,
        );

        $handle = $this->open('a');

        try {
            flock($handle, LOCK_EX);
            fputcsv($handle, $row, escape: '');
            fflush($handle);
            flock($handle, LOCK_UN);
        } finally {
            fclose($handle);
        }

        $this->rows[] = array_combine($this->header, $row);

        return $row;
    }

    protected function load(): void
    {
        $handle = $this->open('r');

        try {
            $this->header = fgetcsv($handle, escape: '') ?: [];

            while (($row = fgetcsv($handle, escape: '')) !== false) {
                if ($row === [null]) {
                    continue; // blank line
                }

                // Pad/trim so every row lines up with the header.
                $row = array_slice(array_pad($row, count($this->header), null), 0, count($this->header));
                $this->rows[] = array_combine($this->header, $row);
            }
        } finally {
            fclose($handle);
        }
    }

    /**
     * @return resource
     */
    protected function open(string $mode)
    {
        if (! is_file($this->file) || ! is_readable($this->file)) {
            throw new RuntimeException("CSV file [{$this->file}] is not readable.");
        }

        $handle = fopen($this->file, $mode);

        if ($handle === false) {
            throw new RuntimeException("Unable to open CSV file [{$this->file}].");
        }

        return $handle;
    }

    /**
     * Neutralise spreadsheet formula injection (=, +, -, @, tab, CR).
     */
    protected function sanitize(string $value): string
    {
        return preg_match('/^[=+\-@\t\r]/', $value) && ! is_numeric($value)
            ? "'".$value
            : $value;
    }
}
