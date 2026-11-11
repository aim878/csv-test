<?php

namespace App\Http\Controllers;

use App\Repositories\CsvRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CsvController extends Controller
{
    public function __construct(protected CsvRepositoryInterface $transactions)
    {
    }

    /**
     * Display all transactions from the CSV.
     */
    public function index(): View
    {
        return view('csv', [
            'columns' => $this->transactions->columns(),
            'data' => $this->transactions->all(),
        ]);
    }

    /**
     * Append a transaction to the CSV.
     */
    public function store(Request $request): JsonResponse
    {
        $rules = collect($this->transactions->columns())
            ->mapWithKeys(fn (string $column) => [$column => ['nullable', 'string', 'max:255']])
            ->all();

        $row = $this->transactions->store($request->validate($rules));

        return response()->json(['data' => $row], 201);
    }
}
