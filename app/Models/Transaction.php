<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'status',
        'buyers_id',
        'total_price'
    ];

    public function items() {
        return $this->hasMany(TransactionItems::class, 'transaction_id');
    }
}
