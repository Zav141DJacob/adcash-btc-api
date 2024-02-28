<?php

namespace App\Http\Controllers;

use App\Http\Services\ExchangeRateService;
use App\Models\Transaction;
use Exception;
use Illuminate\Validation\ValidationException;

class BalanceController extends Controller
{
    private ExchangeRateService $balanceService;

    public function __construct(ExchangeRateService $balanceService)
    {
        $this->balanceService = $balanceService;
    }

    public function index()
    {
        try {
            $unspent_btc_amount = Transaction::query()->where('spent', false)->sum('amount');
            return [
                'BTC' => $unspent_btc_amount,
                'EUR' => round($unspent_btc_amount * $this->balanceService->getConversionRate(), 2),
            ];
        } catch (Exception $exception) {
            throw ValidationException::withMessages([
                'amount' => "Error retrieving conversion rate"
            ]);
        }
    }
}
