<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

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
            'commerce_value_id' => 'required|integer|exists:commerce_values,id',
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
            'amount'  => $this->input('amount'),
            'percent' => $this->input('percent'),
        ];
    }
}
