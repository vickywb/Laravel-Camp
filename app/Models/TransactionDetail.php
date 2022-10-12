<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    
    const UNPAID = 'unpaid';
    const PENDING = 'pending';
    const SUCCESS = 'success';

    protected $fillable = [
        'checkout_id', 'price', 'discount_amount', 'total', 'payment_status',
    ];

    public function checkout()
    {
        return $this->belongsTo(Checkout::class);
    }
}
