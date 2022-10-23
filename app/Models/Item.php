<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'stock',
        'buy_price',
        'sell_price',
        'item_photo'
    ];
}
