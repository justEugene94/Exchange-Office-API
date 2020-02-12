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

    /**
     * @param Coefficient $coefficient
     *
     * @return void
     */
    public function save(Coefficient $coefficient)
    {
        /** @var CommerceValue $commerceValue */
        $commerceValue = (new CommerceValue)->random();

        $coefficient->commerce_value_id = $commerceValue->id;

        $coefficient->save();
    }
}
