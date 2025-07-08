<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengukuranGizi extends Model
{
    protected $table = 'pengukuran_gizi';

    // Define fillable attributes for mass assignment protection
    protected $fillable = [
        'balita_id',
        'tanggal_ukur',
        'usia_bulan',
        'berat_badan',
        'tinggi_badan',
        'status_gizi',
        'catatan',
    ];

    // Define data type casting for consistency with migration
    protected $casts = [
        'balita_id' => 'integer',
        'tanggal_ukur' => 'date',
        'usia_bulan' => 'integer',
        'berat_badan' => 'decimal:2',
        'tinggi_badan' => 'decimal:2',
        'status_gizi' => 'string',
        'catatan' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with Balita model
    public function balita()
    {
        return $this->belongsTo(Balita::class);
    }
}
