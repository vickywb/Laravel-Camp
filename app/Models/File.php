<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'location'
    ];

    //Relationship
    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class);
    }
    
    //Accessor
    public function getFileUrlAttribute()
    {
        return Storage::url($this->location);
    }
}
