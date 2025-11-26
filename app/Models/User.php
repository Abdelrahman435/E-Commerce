<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the identifier stored in the JWT subject claim.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key-value array, containing any custom claims added to the JWT.
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function products()
{
    return $this->hasMany(\App\Models\Product::class, 'user_id');
}
public function comments()
{
    return $this->hasMany(\App\Models\Comment::class, 'user_id');
}


}
