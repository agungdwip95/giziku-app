<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PesananSellerExport;
use App\Exports\PesananDetailSellerExport;
use Maatwebsite\Excel\Facades\Excel;

class PesananSellerController extends Controller
{
    // Menampilkan semua pesanan masuk untuk seller yang login
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'seller') {
            abort(403, 'Unauthorized');
        }

        $pesanans = Pesanan::with(['customer', 'seller'])
            ->where('id_seller', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return view('pesananseller.view', compact('pesanans'));
    }

    // Menampilkan detail pesanan
    public function show($id)
    {
        $pesanan = Pesanan::with(['products', 'customer', 'seller'])
            ->where('id', $id)
            ->where('id_seller', Auth::id())
            ->firstOrFail();

        return view('pesananseller.show', compact('pesanan'));
    }

     public function exportPdf()
    {
        $user = Auth::user();
        if ($user->role !== 'seller') {
            abort(403, 'Unauthorized');
        }

        $pesanans = Pesanan::with(['customer', 'seller'])
            ->where('id_seller', $user->id)
            ->get();

        $pdf = Pdf::loadView('pesananseller.pdf', compact('pesanans'));
        return $pdf->download('data-pesanan-seller.pdf');
    }

    public function exportExcel()
    {
        $user = Auth::user();
        if ($user->role !== 'seller') {
            abort(403, 'Unauthorized');
        }

        return Excel::download(new PesananSellerExport($user->id), 'data-pesanan-seller.xlsx');
    }

    public function cetakPdfDetail($id)
    {
        $user = Auth::user();
        if ($user->role !== 'seller') {
            abort(403, 'Unauthorized');
        }

        $pesanan = Pesanan::with('products', 'customer', 'seller')
            ->where('id', $id)
            ->where('id_seller', $user->id)
            ->firstOrFail();

        // Hitung total dan ongkir
        $total = 0;
        foreach ($pesanan->products as $produk) {
            $subtotal = $produk->pivot->harga * $produk->pivot->quantity;
            $total += $subtotal;
        }
        $ongkir = $pesanan->total_harga - $total;

        $pdf = Pdf::loadView('pesananseller.pdfDetail', compact('pesanan', 'total', 'ongkir'));

        return $pdf->download('detail_pesanan_seller_' . $pesanan->id . '.pdf');
    }

    public function exportExcelDetail($id)
    {
        $user = Auth::user();
        if ($user->role !== 'seller') {
            abort(403, 'Unauthorized');
        }

        $pesanan = Pesanan::with('products')
            ->where('id', $id)
            ->where('id_seller', $user->id)
            ->firstOrFail();

        return Excel::download(new PesananDetailSellerExport($pesanan), 'detail_pesanan_seller_' . $pesanan->id . '.xlsx');
    }

}
