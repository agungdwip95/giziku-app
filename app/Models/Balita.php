<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    protected $table = 'balita';
    protected $fillable = ['user_id', 'nama', 'tanggal_lahir', 'jenis_kelamin'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengukuranGizis()
    {
        return $this->hasMany(PengukuranGizi::class);
    }
}