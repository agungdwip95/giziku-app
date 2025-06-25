<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PesananExport;
use App\Exports\PesananDetailExport;
use Maatwebsite\Excel\Facades\Excel;

class PesananController extends Controller
{
    // Menampilkan semua pesanan untuk admin
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $pesanans = Pesanan::with(['customer', 'seller'])
            ->orderByDesc('created_at')
            ->get();

        return view('pesanan.view', compact('pesanans'));
    }

    // Menampilkan detail pesanan tertentu
    public function show($id)
    {
        $pesanan = Pesanan::with(['products', 'customer', 'seller'])
            ->findOrFail($id);

        return view('pesanan.show', compact('pesanan'));
    }

    public function exportPdf()
    {
        $pesanans = Pesanan::with(['customer', 'seller'])->get();
        $pdf = Pdf::loadView('pesanan.pdf', compact('pesanans'));
        return $pdf->download('data-pesanan.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new PesananExport, 'data-pesanan.xlsx');
    }

    public function cetakPdfDetail($id)
    {
        $pesanan = Pesanan::with('products', 'customer', 'seller')->findOrFail($id);

        // Hitung total dan ongkir (sama seperti di view)
        $total = 0;
        foreach ($pesanan->products as $produk) {
            $subtotal = $produk->pivot->harga * $produk->pivot->quantity;
            $total += $subtotal;
        }
        $ongkir = $pesanan->total_harga - $total;

        $pdf = Pdf::loadView('pesanan.pdfDetail', compact('pesanan', 'total', 'ongkir'));

        return $pdf->download('detail_pesanan_'.$pesanan->id.'.pdf');
    }

    public function exportExcelDetail($id)
    {
        $pesanan = Pesanan::with('products')->findOrFail($id);

        return Excel::download(new PesananDetailExport($pesanan), 'detail_pesanan_'.$pesanan->id.'.xlsx');
    }

    
}
