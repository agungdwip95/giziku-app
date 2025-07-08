<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EdukasiGizi extends Model
{
    protected $table = 'edukasi_gizi';

    // Define fillable attributes for mass assignment protection
    protected $fillable = ['judul', 'konten', 'kategori'];

    // Define data type casting for consistency with migration
    protected $casts = [
        'judul' => 'string',
        'konten' => 'string',
        'kategori' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
