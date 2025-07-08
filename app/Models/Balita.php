<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    protected $table = 'balita';

    // Define fillable attributes for mass assignment protection
    protected $fillable = ['user_id', 'nama', 'tanggal_lahir', 'jenis_kelamin'];

    // Define data type casting for consistency with migration
    protected $casts = [
        'user_id' => 'integer',
        'nama' => 'string',
        'tanggal_lahir' => 'date',
        'jenis_kelamin' => 'string', // ENUM is treated as string in Eloquent
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with PengukuranGizi model
    public function pengukuranGizis()
    {
        return $this->hasMany(PengukuranGizi::class);
    }
}
