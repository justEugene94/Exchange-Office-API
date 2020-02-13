<?php

namespace App\Http\Requests\Api\Purchase;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $phone_number
 * @property int    $currency_id
 * @property int    $exchange_currency_id
 * @property int    $value
 */
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
            'value' => $this->value,
        ];
    }

    /**
     * @return array
     */
    public function getCustomerData()
    {
        return [
            'first_name'   => $this->first_name,
            'last_name'    => $this->last_name,
            'phone_number' => $this->phone_number,
        ];
    }

    /**
     * @return integer
     */
    public function getCurrencyId()
    {
        return $this->currency_id;
    }

    /**
     * @return integer
     */
    public function getExchangeCurrencyId()
    {
        return $this->exchange_currency_id;
    }
}
