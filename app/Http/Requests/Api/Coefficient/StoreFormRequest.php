<?php

namespace App\Http\Requests\Api\Coefficient;

use App\Http\Requests\Api\CoefficientFormRequest;

class StoreFormRequest extends CoefficientFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return parent::rules();
    }

    /**
     * @return array
     */
    public function getCoefficientData()
    {
        return parent::getCoefficientData();
    }
}
