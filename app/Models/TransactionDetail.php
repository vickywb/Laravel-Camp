<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'checkout_id', 'price', 'discount_amount', 'total', 
    ];

    public function checkout()
    {
        return $this->belongsTo(Checkout::class);
    }
}
