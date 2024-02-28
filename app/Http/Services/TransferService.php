<?php

namespace App\Http\Services;
use App\Models\Transaction;
use Illuminate\Validation\ValidationException;


class TransferService
{
    public function transfer(float $amount) {
        if ($amount < 0.00001) {
            throw ValidationException::withMessages([
                'amount' => "Can not enter amount less than 0.00001 BTC"
            ]);
        }

        $transactions = Transaction::where("spent", false);

        $spent_amount = 0;

        if ($amount > $transactions->sum('amount')) {
            throw ValidationException::withMessages([
                'amount' => "Not enough balance"
            ]);
        }

        foreach ($transactions->get() as $transaction) {
            if ($spent_amount > $amount) {
                Transaction::create([
                    'amount' => $spent_amount - $amount,
                ]);
                return;
            } elseif ($spent_amount == $amount) {
                return;
            }
            $spent_amount += $transaction->amount;

            $transaction->spent = true;
            $transaction->save();
        }

        Transaction::create([
            'amount' => $spent_amount - $amount,
        ]);
    }
}