<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 */
class CommerceValue extends ArrayModel
{
    /** @var int  */
    const SALE = 1;

    /** @var int  */
    const BUY = 2;

    /** @var int  */
    const AMOUNT = 3;

    /**
     * @return array
     */
    protected function getData(): array
    {
       return [
           [
               'id'   => self::SALE,
               'name' => 'sale'
           ],
           [
               'id'   => self::BUY,
               'name' => 'buy'
           ],
           [
               'id'   => self::AMOUNT,
               'name' => 'amount'
           ],
       ];
    }
}
