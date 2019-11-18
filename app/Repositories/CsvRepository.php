<?php
namespace App\Repositories;

use App\Services\CsvReader;
use App\Repositories\CsvRepositoryInterface;

class CsvRepository implements CsvRepositoryInterface
{
    /**
     * @var Reader
     */
    protected $model;
    public function __construct() {
        $model = new CsvReader(public_path('file/transactions.csv'));
        $this->model = $model;
    }
    /**
     * Get's a Transactions by it's ID
     *
     * @param int
     * @return array
     */
    public function get($id)
    {
        $data = $this->model->toArray();
        return data_get($data, $id, []);
    }
    /**
     * Get's all Transactions.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model->toArray(); 
    }
    /**
     * Deletes a Transactions.
     *
     * @param int
     */
    public function delete($index)
    {
        $data = $this->model->toArray();
        return array_splice($array, $index, 1);
           
    }
    /**
     * Updates a Transactions.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data)
    {
    }
    /**
     * Store a Transactions.
     *
     * @param int
     * @param array
     */
    public function store($data)
    {
        $this->model->add($data);
    }
}

