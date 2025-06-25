<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class WithdrawController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Hanya admin yang boleh mengakses halaman ini
        if ($user->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // Ambil semua withdraw 
        $withdraws = Withdraw::with('seller')
            ->orderByDesc('created_at')
            ->get();

        return view('withdraw.view', compact('withdraws'));
    }

    public function approve($id)
    {
        // Ambil data withdraw
        $withdraw = \App\Models\Withdraw::findOrFail($id);

        // Ambil user seller
        $user = \App\Models\User::findOrFail($withdraw->id_seller);

        // Hitung total yang diajukan (jumlah bersih + potongan)
        $jumlahBersih = $withdraw->total_saldo;
        $jumlahWithdraw = $jumlahBersih / 0.95; // Karena 95% adalah yang diterima
        $potonganAdmin = $jumlahWithdraw - $jumlahBersih;

        // Tambahkan saldo ke seller (karena bersifat simulasi pencairan)
        $user->saldo += $jumlahBersih;
        $user->save();

        // Tambahkan potongan ke admin
        $admin = \App\Models\User::where('role', 'admin')->first();
        if ($admin) {
            $admin->saldo += $potonganAdmin;
            $admin->save();
        }

        // Ubah status withdraw jadi disetujui
        $withdraw->status = 1;
        $withdraw->save();

        return redirect()->back()->with('success', 'Withdraw disetujui.');
    }

    public function reject($id)
    {
        $withdraw = \App\Models\Withdraw::findOrFail($id);
        $seller = \App\Models\User::findOrFail($withdraw->id_seller);

        // Hitung kembali jumlah withdraw awal (karena yang disimpan hanya 95%)
        $jumlahWithdraw = $withdraw->total_saldo / 0.95;

        // Kembalikan saldo seller ke kondisi semula
        $seller->saldo += $jumlahWithdraw;
        $seller->save();

        // Update status withdraw menjadi ditolak
        $withdraw->status = 2;
        $withdraw->save();

        return redirect()->back()->with('success', 'Withdraw ditolak dan saldo dikembalikan.');
    }

    public function exportPDF()
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $withdraws = Withdraw::with('seller')->orderByDesc('created_at')->get();

        $pdf = Pdf::loadView('withdraw.pdf', compact('withdraws'));
        return $pdf->download('riwayat_withdraw.pdf');
    }
}
