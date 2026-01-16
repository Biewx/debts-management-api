<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DebtController;

Route::post('/debts', [DebtController::class, 'store']);
Route::get('/debts/{id}', [DebtController::class, 'show']);

Route::put('/debts/{id}/pay', [DebtController::class, 'payDebt']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');