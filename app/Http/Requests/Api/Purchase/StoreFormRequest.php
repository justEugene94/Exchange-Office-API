<?php

namespace App\Http\Requests\Api\Purchase;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
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
            'first_name'            => 'required|string',
            'last_name'             => 'required|string',
            'phone_number'          => 'required|regex:/(0)[0-9]{8}/',
            'currency_id'           => 'required|integer|exists:currencies,id',
            'exchange_currency_id'  => 'required|integer|exists:currencies,id',
            'value'                 => 'required|integer|min:50',
        ];
    }

    /**
     * @return array
     */
    public function getPurchaseData()
    {
        return [
            'value' => $this->input('value'),
        ];
    }

    /**
     * @return array
     */
    public function getCustomerData()
    {
        return [
            'first_name'   => $this->input('first_name'),
            'last_name'    => $this->input('last_name'),
            'phone_number' => $this->input('phone_number'),
        ];
    }

    /**
     * @return integer
     */
    public function getCurrencyId()
    {
        return $this->input('currency_id');
    }

    /**
     * @return integer
     */
    public function getExchangeCurrencyId()
    {
        return $this->input('exchange_currency_id');
    }
}
