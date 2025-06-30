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

            // Standar tinggi badan berdasarkan WHO (sederhana untuk ilustrasi)
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

            // Cari standar terdekat
            $usiaTerdekat = array_key_last($standar_tinggi);
            foreach ($standar_tinggi as $bulan => $tb) {
                if ($usia <= $bulan) {
                    $usiaTerdekat = $bulan;
                    break;
                }
            }

            $median_tb = $standar_tinggi[$usiaTerdekat];
            $selisih = $tinggi - $median_tb;

            // Aturan sederhana: Jika tinggi < -2 SD dari median → Stunting, else Normal
            // Asumsi SD = 1 untuk simplifikasi (realnya gunakan Z-score WHO)
            $status_gizi = $selisih < -2 ? 'Stunting' : 'Normal';

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
