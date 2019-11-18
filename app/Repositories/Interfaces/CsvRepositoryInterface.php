<?php
namespace App\Repositories\interfaces;
interface CsvRepositoryInterface
{
    /**
     * Get's a Transactions by it's ID
     *
     * @param int
     */
    public function get($id);
    /**
     * Get's all Transactions.
     *
     * @return mixed
     */
    public function all();
    /**
     * Deletes a Transactions.
     *
     * @param int
     */
    public function delete($id);
    /**
     * Updates a Transactions.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);
    /**
     * Create a Transactions.
     *
     * @param int
     * @param array
     */
    public function store($data);
}