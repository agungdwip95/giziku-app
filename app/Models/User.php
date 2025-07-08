<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Explicitly define table name (optional, as Laravel assumes 'users')

    // Define fillable attributes for mass assignment protection
    protected $fillable = [
        'nama',
        'foto',
        'email',
        'no_hp',
        'password',
        'alamat',
        'role',
    ];

    // Define hidden attributes to prevent exposure in arrays/JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Define data type casting for consistency with assumed migration
    protected $casts = [
        'nama' => 'string',
        'foto' => 'string', // Assuming foto is a file path or URL
        'email' => 'string',
        'no_hp' => 'string', // Phone numbers are typically stored as strings
        'password' => 'hashed', // Already defined, kept for hashed password
        'alamat' => 'string',
        'role' => 'string',
        'email_verified_at' => 'datetime', // Common in Laravel's default User schema
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Get the identifier for JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Define custom JWT claims
    public function getJWTCustomClaims()
    {
        return [];
    }

    // Relationship with Balita model
    public function balitas()
    {
        return $this->hasMany(Balita::class);
    }
}
