<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Camp extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'price'
    ];

    //Relationship
    public function campBenefits()
    {
        return $this->hasMany(CampBenefit::class);
    }

    //Attribute
    public function getIsRegisteredAttribute()
    {
        $user = auth()->user();

        if (!$user) {
            return false;
        }

        return Checkout::whereCampId($this->id)->whereUserId($user->id)->exists();
    }
}
