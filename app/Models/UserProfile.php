<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'file_id', 'address', 'phone_number'
    ];

    //Relationship
    public function user () {
        return $this->belongsTo(User::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    //Accessor
    public function getFileUrlAttribute()
    {
        if (empty($this->file_id)) {
            return null;
        }

        return Storage::url($this->file->location);
    }
}
