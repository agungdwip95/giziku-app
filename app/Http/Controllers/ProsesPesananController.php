<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProsesPesananController extends Controller
{
    // Tampilkan semua pesanan yang sedang diproses oleh seller
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'seller') {
            abort(403, 'Unauthorized');
        }

        // Ambil pesanan dengan status = 'proses' milik seller yang sedang login
        $pesanans = Pesanan::with(['customer'])
            ->where('status', 'proses')
            ->where('id_seller', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return view('pesananSeller.proses', compact('pesanans'));
    }

    // Proses kirim pesanan
    public function kirim($id)
    {
        $user = Auth::user();

        $pesanan = Pesanan::where('id', $id)
            ->where('id_seller', $user->id)
            ->firstOrFail();

        $pesanan->status = 'dikirim';
        $pesanan->save();

        return redirect()->back()->with('success', 'Pesanan berhasil dikirim.');
    }
}
