<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface CsvRepositoryInterface
{
    /**
     * Get a transaction by its row index.
     */
    public function get(int $id): ?array;

    /**
     * Get all transactions.
     */
    public function all(): Collection;

    /**
     * The CSV column names.
     *
     * @return list<string>
     */
    public function columns(): array;

    /**
     * Append a transaction and return the written row.
     *
     * @param  array<string, mixed>  $data
     * @return list<string>
     */
    public function store(array $data): array;
}
