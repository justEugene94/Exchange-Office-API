<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $customer_id
 * @property int $currency_id
 * @property int $exchange_currency_id
 * @property int $value
 *
 * Relations:
 * @property Customer $customer
 * @property Currency $currency
 * @property Currency $exchangeCurrency
 */
class Purchase extends Model
{
    /** @var string  */
    protected $table = 'purchases';

    /** @var array  */
    protected $fillable = [
        'customer_id',
        'currency_id',
        'exchange_currency_id',
        'value',
    ];

    /**
     * @return  BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function exchangeCurrency()
    {
        return $this->belongsTo(Currency::class, 'exchange_currency_id', 'id');
    }
}
