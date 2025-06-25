<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EdukasiGizi extends Model
{
    protected $table = 'edukasi_gizi';
    protected $fillable = ['judul', 'konten', 'kategori'];
}