<?php

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            ['name' => 'USD'],
            ['name' => 'EUR'],
            ['name' => 'UAH'],
            ['name' => 'RUR'],
        ];

        foreach ($currencies as $currency)
        {
            Currency::create([
                'name' => $currency['name']
            ]);
        }
    }
}
