<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampBenefit extends Model
{
    use HasFactory;

    protected $fillable = [
        'camp_id', 'name'
    ];

    //Relationship
    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }
}
