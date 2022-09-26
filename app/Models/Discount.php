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

    
}
