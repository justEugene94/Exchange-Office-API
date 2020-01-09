<?php

namespace App\Services;

use App\Http\Requests\Api\Coefficient\StoreFormRequest;
use App\Http\Requests\Api\Coefficient\UpdateFormRequest;
use App\Models\Coefficient;
use App\Models\CommerceValue;
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

    /**
     * @param UpdateFormRequest $request
     * @param Coefficient       $coefficient
     *
     * @return Coefficient
     */
    public function update(UpdateFormRequest $request, Coefficient $coefficient): Coefficient
    {
        $data = $request->getCoefficientData();

        $commerceValueId = $request->input('commerce_value_id');

        $oldCommerceValue = $coefficient->commerceValue;

        DB::beginTransaction();

        if ($oldCommerceValue->id !== $commerceValueId) {
            $newCommerceValue = CommerceValue::query()->findOrFail($commerceValueId);
            $coefficient->commerceValue()->associate($newCommerceValue)->save();
        }

        $coefficient->update($data);

        DB::commit();

        return $coefficient;
    }

    /**
     * @param Coefficient $coefficient
     * @throws \Exception
     */
    public function delete(Coefficient $coefficient)
    {
        $coefficient->delete();
    }

    /**
     * @param int $amountOfPurchases
     * @param string $accessor
     *
     * @return Coefficient
     */
    public function getBySumOfPurchaseAmounts(int $amountOfPurchases, string $accessor)
    {
        return Coefficient::query()->{$accessor}()->where('amount', '<', $amountOfPurchases)->orderBy('amount', 'desc')->first();
    }
}
