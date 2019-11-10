<?php

use App\Models\Coefficient;
use App\Models\CommerceValue;
use Illuminate\Database\Seeder;

class CoefficientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Coefficient::class, 20)->make()->each(function (Coefficient $coefficient) {
            $this->save($coefficient);
        });
    }

    public function save(Coefficient $coefficient)
    {
        $commerceValue = CommerceValue::query()->inRandomOrder()->firstOrFail();

        $coefficient->commerceValue()->associate($commerceValue);

        $coefficient->save();
    }
}
