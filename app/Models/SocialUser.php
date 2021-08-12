<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'social_id',
        'social_user_id',
        'name',
        'email',
        'avatar',
        'expiresIn',
        'user_object',
        'token',
        'code'
    ];
}
