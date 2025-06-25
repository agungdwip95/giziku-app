<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawSellerController extends Controller
{
    // Tampilkan halaman withdraw seller
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'seller') {
            abort(403, 'Unauthorized');
        }

        $withdraws = Withdraw::where('id_seller', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return view('withdrawSeller.view', compact('withdraws'));
    }

    public function store(Request $request)
    {
        $user = auth()->user(); // Asumsi sudah login sebagai seller

        if ($user->role !== 'seller') {
            return redirect()->back()->with('error', 'Hanya seller yang dapat melakukan withdraw.');
        }

        $jumlahWithdraw = $request->input('total_saldo');

        // Validasi minimal withdraw
        if ($jumlahWithdraw < 100000) {
            return redirect()->back()->with('error', 'Minimal withdraw adalah Rp 100.000.');
        }

        // Validasi saldo mencukupi
        if ($user->saldo < $jumlahWithdraw) {
            return redirect()->back()->with('error', 'Saldo tidak mencukupi untuk withdraw.');
        }

        // Simpan data withdraw
        \App\Models\Withdraw::create([
            'id_seller' => $user->id,
            'total_saldo' => $jumlahBersih,
            'status' => 0, // Pending
        ]);

        return redirect()->back()->with('success', 'Withdraw berhasil diajukan dan menunggu konfirmasi admin.');
    }

}
