<?php

namespace App\Http\Controllers\api;

use App\Models\PengukuranGizi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class PengukuranGiziController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'balita_id' => 'required|exists:balita,id',
                'tanggal_ukur' => 'required|date',
                'usia_bulan' => 'required|integer|min:0',
                'berat_badan' => 'required|numeric|min:0',
                'tinggi_badan' => 'required|numeric|min:0',
                'catatan' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $validated = $validator->validated();

            // Hitung status gizi otomatis berdasarkan TB/U (tinggi badan menurut usia)
            $usia = $validated['usia_bulan'];
            $tinggi = $validated['tinggi_badan'];

            // Standar WHO Z-score (umum tanpa jenis kelamin, disederhanakan)
            $standar_tb = [
                0 => ['median' => 49.9, 'sd_minus_2' => 46.1, 'sd_minus_3' => 44.2],
                1 => ['median' => 54.7, 'sd_minus_2' => 50.8, 'sd_minus_3' => 48.9],
                2 => ['median' => 58.4, 'sd_minus_2' => 54.4, 'sd_minus_3' => 52.3],
                3 => ['median' => 61.4, 'sd_minus_2' => 57.3, 'sd_minus_3' => 55.0],
                4 => ['median' => 63.9, 'sd_minus_2' => 59.8, 'sd_minus_3' => 57.5],
                5 => ['median' => 65.9, 'sd_minus_2' => 61.8, 'sd_minus_3' => 59.5],
                6 => ['median' => 67.6, 'sd_minus_2' => 63.0, 'sd_minus_3' => 60.0],
                12 => ['median' => 76.1, 'sd_minus_2' => 71.0, 'sd_minus_3' => 68.0],
                18 => ['median' => 81.7, 'sd_minus_2' => 76.0, 'sd_minus_3' => 73.0],
                24 => ['median' => 85.5, 'sd_minus_2' => 79.5, 'sd_minus_3' => 76.0],
                36 => ['median' => 95.2, 'sd_minus_2' => 89.5, 'sd_minus_3' => 86.0],
                48 => ['median' => 102.3, 'sd_minus_2' => 96.5, 'sd_minus_3' => 92.5],
                60 => ['median' => 109.2, 'sd_minus_2' => 103.3, 'sd_minus_3' => 99.0],
            ];

            // Cari usia terdekat
            $usiaTerdekat = array_key_first($standar_tb);
            foreach ($standar_tb as $bulan => $data) {
                if ($usia <= $bulan) {
                    $usiaTerdekat = $bulan;
                    break;
                }
            }

            $standar = $standar_tb[$usiaTerdekat];

            // Tentukan status gizi
            if ($tinggi < $standar['sd_minus_3']) {
                $status_gizi = 'Stunting Berat';
            } elseif ($tinggi < $standar['sd_minus_2']) {
                $status_gizi = 'Stunting';
            } else {
                $status_gizi = 'Normal';
            }

            // Simpan data
            $pengukuran = PengukuranGizi::create([
                'balita_id' => $validated['balita_id'],
                'tanggal_ukur' => $validated['tanggal_ukur'],
                'usia_bulan' => $validated['usia_bulan'],
                'berat_badan' => $validated['berat_badan'],
                'tinggi_badan' => $validated['tinggi_badan'],
                'status_gizi' => $status_gizi,
                'catatan' => $validated['catatan'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Pengukuran gizi berhasil disimpan',
                'data' => [
                    'id' => $pengukuran->id,
                    'balita_id' => $pengukuran->balita_id,
                    'tanggal_ukur' => $pengukuran->tanggal_ukur,
                    'usia_bulan' => $pengukuran->usia_bulan,
                    'berat_badan' => $pengukuran->berat_badan,
                    'tinggi_badan' => $pengukuran->tinggi_badan,
                    'status_gizi' => $pengukuran->status_gizi,
                    'catatan' => $pengukuran->catatan,
                    'created_at' => $pengukuran->created_at,
                    'updated_at' => $pengukuran->updated_at,
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index(Request $request)
    {
        try {
            $query = PengukuranGizi::with('balita')
                ->orderBy('tanggal_ukur', 'desc');

            if ($request->has('balita_id')) {
                $query->where('balita_id', $request->balita_id);
            }

            $perPage = $request->input('per_page', 10);
            $pengukuran = $query->paginate($perPage);

            return response()->json([
                'status' => 'success',
                'message' => 'Data pengukuran gizi berhasil diambil',
                'data' => $pengukuran->items(),
                'pagination' => [
                    'current_page' => $pengukuran->currentPage(),
                    'total_pages' => $pengukuran->lastPage(),
                    'total_items' => $pengukuran->total(),
                    'per_page' => $pengukuran->perPage(),
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
