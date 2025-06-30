<?php

namespace App\Http\Controllers;

use App\Models\PengukuranGizi;
use App\Models\Balita;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PengukuranGiziController extends Controller
{
    public function index()
    {
        $pengukuranGizi = PengukuranGizi::with('balita')->get();
        return view('pengukuran_gizi.view', compact('pengukuranGizi'));
    }

    public function create()
    {
        $balitas = Balita::all();
        return view('pengukuran_gizi.create', compact('balitas'));
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'balita_id' => 'required|exists:balitas,id',
    //         'tanggal_ukur' => 'required|date',
    //         'usia_bulan' => 'required|integer|min:0',
    //         'berat_badan' => 'required|numeric|min:0',
    //         'tinggi_badan' => 'required|numeric|min:0',
    //         'status_gizi' => 'required|in:Normal,Stunting',
    //         'catatan' => 'nullable|string',
    //     ]);

    //     PengukuranGizi::create($validated);

    //     return redirect()->route('pengukuran_gizi.index')->with('success', 'Data pengukuran gizi berhasil ditambahkan.');
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'balita_id'     => 'required|exists:balita,id',
            'tanggal_ukur'  => 'required|date',
            'usia_bulan'    => 'required|integer|min:0',
            'berat_badan'   => 'required|numeric|min:0',
            'tinggi_badan'  => 'required|numeric|min:0',
            'catatan'       => 'nullable|string',
        ]);

        // Hitung status gizi otomatis berdasarkan TB/U (tinggi badan menurut usia)
        $usia = $validated['usia_bulan'];
        $tinggi = $validated['tinggi_badan'];

        // Contoh sederhana ambil nilai median tinggi badan dari WHO (laki-laki & perempuan)
        // Angka berikut disederhanakan untuk ilustrasi (contoh real butuh data WHO z-score)
        $standar_tinggi = [
            0 => 49.9,  // usia 0 bulan
            1 => 54.7,
            2 => 58.4,
            3 => 61.4,
            4 => 63.9,
            5 => 65.9,
            6 => 67.6,
            12 => 76.1,
            18 => 81.7,
            24 => 85.5,
            36 => 95.2,
            48 => 102.3,
            60 => 109.2,
        ];

        // Cari standar terdekat (atau interpolasi untuk akurat)
        $usiaTerdekat = array_key_last($standar_tinggi);
        foreach ($standar_tinggi as $bulan => $tb) {
            if ($usia <= $bulan) {
                $usiaTerdekat = $bulan;
                break;
            }
        }

        $median_tb = $standar_tinggi[$usiaTerdekat];
        $selisih = $tinggi - $median_tb;

        // Aturan sederhana (real-nya pakai Z-score WHO):
        // Jika tinggi < -2 SD dari median → Stunting, else Normal
        if ($selisih < -2) {
            $status_gizi = 'Stunting';
        } else {
            $status_gizi = 'Normal';
        }

        // Simpan data
        PengukuranGizi::create([
            ...$validated,
            'status_gizi' => $status_gizi,
        ]);

        return redirect()->route('pengukuran_gizi.index')->with('success', 'Data pengukuran gizi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pengukuranGizi = PengukuranGizi::with('balita')->findOrFail($id);
        return view('pengukuran_gizi.show', compact('pengukuranGizi'));
    }

    public function edit($id)
    {
        $pengukuranGizi = PengukuranGizi::findOrFail($id);
        $balitas = Balita::all();
        return view('pengukuran_gizi.update', compact('pengukuranGizi', 'balitas'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'balita_id' => 'required|exists:balita,id',
            'tanggal_ukur' => 'required|date',
            'usia_bulan' => 'required|integer|min:0',
            'berat_badan' => 'required|numeric|min:0',
            'tinggi_badan' => 'required|numeric|min:0',
            'status_gizi' => 'required|in:Normal,Stunting',
            'catatan' => 'nullable|string',
        ]);

        $pengukuranGizi = PengukuranGizi::findOrFail($id);
        $pengukuranGizi->update($validated);

        return redirect()->route('pengukuran_gizi.index')->with('success', 'Data pengukuran gizi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengukuranGizi = PengukuranGizi::findOrFail($id);
        $pengukuranGizi->delete();

        return redirect()->route('pengukuran_gizi.index')->with('success', 'Data pengukuran gizi berhasil dihapus.');
    }

    public function cetak_pdf()
    {
        $pengukuranGizi = PengukuranGizi::with('balita')->get();
        $pdf = Pdf::loadView('pengukuran_gizi.pengukuran_gizi_pdf', compact('pengukuranGizi'));
        return $pdf->download('laporan-pengukuran-gizi.pdf');
    }
}