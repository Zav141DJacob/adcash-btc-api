<?php

namespace Tests\Feature;

use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    public function test_user_cannot_transfer_with_zero() : void
    {
        $response = $this->postJson('/api/transactions', [
            'amount' => 0,
        ]);

        $response->assertUnprocessable();
    }

    public function test_fetch_balance() : void
    {
        $response = $this->get('/api/balance');

        $response->assertOk();
    }

    public function test_fetch_transactions() : void
    {
        $response = $this->get('/api/transactions');

        $response->assertOk();
    }
}
