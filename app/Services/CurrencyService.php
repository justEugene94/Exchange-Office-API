<?php

namespace App\Services;

use App\Models\Currency;

class CurrencyService
{
    /**
     * @param string $currency
     *
     * @return Currency
     */
    public function get(string $currency)
    {
        /** @var Currency $currency */
        $currency = Currency::query()->where('name', $currency)->firstOrFail();

        return $currency;
    }
}
