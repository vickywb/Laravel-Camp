<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    const TYPE_MAP = [
        'percentage' => 'Percentage',
        'fixed' => 'Fixed'
    ];

    const TYPE_PERCENTAGE = 'percentage';
    const TYPE_FIXED = 'fixed'; 

    protected $fillable = [
        'title', 'code', 'type', 'amount'
    ];

    //Relationship
    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Attribute
    public function getUsedDiscountAttribute()
    {
        $user = auth()->user()->id;
        $discountCheck = Checkout::whereDiscountId($this->id)->whereUserId($user)->count() < 1;

        return $discountCheck;
    }
}
