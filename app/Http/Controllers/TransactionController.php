<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionStoreRequest;
use App\Http\Services\ExchangeRateService;
use App\Http\Services\TransferService;
use App\Models\Transaction;
use Exception;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    private TransferService $transferService;

    private ExchangeRateService $balanceService;

    public function __construct(ExchangeRateService $balanceService, TransferService $transferService)
    {
        $this->balanceService = $balanceService;
        $this->transferService = $transferService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Transaction::all();
    }

    public function store(TransactionStoreRequest $request)
    {
        $validated = $request->validated();
        try {
            $btc_amount = $validated['amount'] / $this->balanceService->getConversionRate();
        } catch (Exception $exception) {
            throw ValidationException::withMessages([
                'amount' => "Error retrieving conversion rate"
            ]);
        }

        try {
            $this->transferService->transfer($btc_amount);
        } catch(Exception $exception) {
            throw ValidationException::withMessages([
                'amount' => $exception->getMessage()
            ]);
        }

    }
}
