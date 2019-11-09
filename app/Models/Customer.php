<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone_number
 *
 * Relations:
 * @property Purchase[] $purchases
 */
class Customer extends Model
{
    /** @var string  */
    protected $table = 'customers';

    /** @var null  */
    const UPDATED_AT = null;

    /** @var array  */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
    ];

    /**
     * @return HasMany
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'customer_id', 'id');
    }
}
