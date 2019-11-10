<?php

use App\Models\CommerceValue;
use Illuminate\Database\Seeder;

class CommerceValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commerceValues = [
            ['name' => 'sale'],
            ['name' => 'buy'],
            ['name' => 'amount'],
        ];

        foreach ($commerceValues as $commerceValue)
        {
            CommerceValue::create([
                'name' => $commerceValue['name'],
            ]);
        }
    }
}
