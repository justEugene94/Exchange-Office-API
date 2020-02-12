<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $commerce_value_id
 * @property int $amount
 * @property float $percent
 */
class CoefficientFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'commerce_value_id' => 'required|integer',
            'amount'            => 'required|integer',
            'percent'           => 'required|numeric|between:0,0.99',
        ];
    }

    /**
     * @return array
     */
    public function getCoefficientData()
    {
        return [
            'amount'  => $this->amount,
            'percent' => $this->percent,
        ];
    }
}
