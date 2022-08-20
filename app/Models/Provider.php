<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    Const GOOGLE_PROVIDER = 'google';
    Const FACEBOOK_PROVIDER = 'facebook';

    use HasFactory;

    protected $fillable = [
        'provider_user_id', 'name', 'provider_name', 'email', 'password', 'avatar',
        'email_verified_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
