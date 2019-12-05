<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class CustomerService
{
    /**
     * @param array $customerData
     * @return Model
     */
    public function findOrCreate(array $customerData)
    {
        return Customer::query()->firstOrCreate(['phone_number' => $customerData['phone_number']], $customerData);
    }
}
