<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 *
 * Relations:
 * @property Purchase[] $purchases
 * @property Purchase[] $exchangePurchases
 */
class Currency extends Model
{
    /** @var string  */
    protected $table = 'currencies';

    /** @var bool  */
    public $timestamps = false;

    /** @var array  */
    protected $fillable = [
        'name'
    ];

    public const ACCESSOR_BUY = 'buy';

    public const ACCESSOR_SALE = 'sale';

    /**
     * @return HasMany
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'currency_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function exchangePurchases()
    {
        return $this->hasMany(Purchase::class, 'exchange_currency_id', 'id');
    }
}
