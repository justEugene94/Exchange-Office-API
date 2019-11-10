<?php

use App\Models\Currency;
use App\Models\Customer;
use App\Models\Purchase;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Purchase::class,50)->make()->each(function (Purchase $purchase) {
            $this->save($purchase);
        });
    }

    public function save(Purchase $purchase)
    {
        $customer = Customer::query()->inRandomOrder()->firstOrFail();
        $purchase->customer()->associate($customer);

        $currency = Currency::query()->inRandomOrder()->firstOrFail();
        $purchase->currency()->associate($currency);

        $exchangeCurrency = Currency::query()->inRandomOrder()->whereKeyNot($currency->id)->firstOrFail();
        $purchase->exchangeCurrency()->associate($exchangeCurrency);

        $purchase->save();
    }
}
