<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $commerce_value_id
 * @property int $amount
 * @property float $percent
 *
 * Relations:
 * @property CommerceValue $commerceValue
 */
class Coefficient extends Model
{
    /** @var string  */
    protected $table = 'coefficients';

    /** @var array */
    protected $fillable = [
        'commerce_value_id',
        'amount',
        'percent'
    ];

    /**
     * @return BelongsTo
     */
    public function commerceValue()
    {
        return $this->belongsTo(CommerceValue::class, 'commerce_value_id', 'id');
    }
}
