<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\Customer;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class PurchaseService
{
    /**
     * @param Customer $customer
     * @param array $purchaseData
     * @param int $currencyId
     * @param int $exchangeCurrencyId
     *
     * @return Purchase
     */
    public function create(Customer $customer, array $purchaseData, int $currencyId, int $exchangeCurrencyId)
    {
        /** @var Purchase $purchase */
        $purchase = new Purchase($purchaseData);

        DB::beginTransaction();

        $purchase->currency()->associate($currencyId);
        $purchase->exchangeCurrency()->associate($exchangeCurrencyId);

        $customer->purchases()->save($purchase);

        DB::commit();

        return $purchase;
    }

    /**
     * @param Currency $currency
     *
     * @return array
     */
    public function getArrayOfBuyAndSaleSums(Currency $currency)
    {
        $countBuy = $this->getSum($currency, 'buy');

        $countSale = $this->getSum($currency, 'sale');

        return [
            'buy'  => $countBuy,
            'sale' => $countSale,
        ];
    }

    /**
     * @param Currency $currency
     * @param string $accessor
     *
     * @return int
     */
    protected function getSum(Currency $currency, string $accessor = 'buy')
    {
        if ($accessor == 'sale') {
            $column = 'currency_id';
        }
        else {
            $column = 'exchange_currency_id';
        }

        return Purchase::query()->where($column, $currency->id)->sum('value');
    }
}
