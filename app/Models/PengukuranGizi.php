<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengukuranGizi extends Model
{
    protected $table = 'pengukuran_gizi';
    protected $fillable = [
        'balita_id',
        'tanggal_ukur',
        'usia_bulan',
        'berat_badan',
        'tinggi_badan',
        'status_gizi',
        'catatan',
    ];

    public function balita()
    {
        return $this->belongsTo(Balita::class);
    }
}