<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 *
 * Relations:
 * @property Coefficient[] $coefficients
 */
class CommerceValue extends Model
{
    /** @var string  */
    protected $table = 'commerce_values';

    /** @var bool  */
    public $timestamps = false;

    /** @var array  */
    protected $fillable = [
        'name'
    ];

    /**
     * @return HasMany
     */
    public function coefficients()
    {
        return $this->hasMany(Coefficient::class, 'commerce_value_id', 'id');
    }
}
