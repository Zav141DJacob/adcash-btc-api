<?php

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::post('/transfer', [TransactionController::class, 'store']);
// Route::get('/transactions', [TransactionController::class, 'index']);

Route::resource("/transactions", TransactionController::class)->only(['index', 'store']);
Route::get('/balance', [BalanceController::class, 'index']);
