<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeeder::class);
         $this->call(CurrencySeeder::class);
         $this->call(CommerceValueSeeder::class);
         $this->call(CoefficientSeeder::class);
         $this->call(CustomerSeeder::class);
         $this->call(PurchaseSeeder::class);
    }
}
