<?php

use App\Http\Controllers\CsvController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('transaction', CsvController::class)->only(['index', 'store']);

Route::fallback(function () {
    return response()->json(['message' => 'Page Not Found'], 404);
});
