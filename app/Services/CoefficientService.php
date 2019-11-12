<?php

namespace App\Services;

use App\Http\Requests\Api\Coefficient\StoreFormRequest;
use App\Models\Coefficient;
use Illuminate\Support\Facades\DB;

class CoefficientService
{
    /**
     * @param StoreFormRequest $request
     *
     * @return Coefficient
     */
    public function create(StoreFormRequest $request): Coefficient
    {
        $data = $request->getCoefficientData();

        $commerceValueId = $request->input('commerce_value_id');

        /** @var Coefficient $coefficient */
        $coefficient = new Coefficient($data);

        DB::beginTransaction();

        $coefficient->commerceValue()->associate($commerceValueId);
        $coefficient->save();

        DB::commit();

        return $coefficient;
    }
}
