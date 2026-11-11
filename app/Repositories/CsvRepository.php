<?php

namespace App\Repositories;

use App\Services\CsvReader;
use Illuminate\Support\Collection;

class CsvRepository implements CsvRepositoryInterface
{
    protected CsvReader $reader;

    public function __construct(?string $file = null)
    {
        $this->reader = CsvReader::make($file ?? public_path('file/transactions.csv'));
    }

    public function get(int $id): ?array
    {
        return $this->reader->toArray()[$id] ?? null;
    }

    public function all(): Collection
    {
        return $this->reader->all();
    }

    public function columns(): array
    {
        return $this->reader->header();
    }

    public function store(array $data): array
    {
        return $this->reader->append($data);
    }
}
