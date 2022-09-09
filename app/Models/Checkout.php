<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'camp_id', 'name', 'email', 'payment_status', 'midtrans_url',
        'midtrans_booking_code'
    ];

    // protected $casts = [
    //     'expired_date' => 'datetime',
    // ];

    // const PENDING = 'pending';
    // const SUCCESS = 'success';

    //Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }

    // //Attribute
    // public function getExpiredAttribute($value)
    // {
    //     $this->attribute['expired_date'] = date('Y-m-t', strtotime($value));
    // }
}
