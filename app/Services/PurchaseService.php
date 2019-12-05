<?php

namespace App\Services;

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
}
