<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DebtController;

Route::post('/debts', [DebtController::class, 'store']);
Route::get('/debts/{id}', [DebtController::class, 'show']);
Route::get('/debts', [DebtController::class, 'list']);
Route::get('/debts/status/open', [DebtController::class, 'listOpenDebts']);
Route::get('/debts/status/paid', [DebtController::class, 'listPaidDebts']);
Route::get('/debts/status/partial', [DebtController::class, 'listPartialDebts']);
Route::get('/debts/{id}/payments', [DebtController::class, 'listDebtPayments']);

Route::put('/debts/{id}/pay', [DebtController::class, 'payDebt']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');