<?php

namespace App\Http\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class ExchangeRateService
{
    public function getConversionRate()
    {
        $response = Http::get(config('services.cryptopia.api'));

        if ($response->failed()) {
            throw new Exception("Error retrieving conversion rate");
        }

        $data = $response->json()['data'][0]['value'];
        return $data ?? null;
    }
}