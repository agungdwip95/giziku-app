<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SellerController extends Controller
{
    public function index()
    {
        $seller = User::where('role', 'seller')->get();
        return view('seller.view', compact('seller'));
    }

    public function create()
    {
        return view('seller.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'no_telp' => 'nullable|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'password' => Hash::make($request->password),
            'role' => 'seller',
            'saldo' => 0,
        ]);

        return redirect()->route('seller')->with('success', 'Seller berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $seller = User::where('id', $id)->where('role', 'seller')->firstOrFail();
        return view('seller.update', compact('seller'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $request->id,
            'no_telp' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6',
        ]);

        $user = User::where('id', $request->id)->where('role', 'seller')->firstOrFail();

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('seller')->with('success', 'Seller berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->where('role', 'seller')->firstOrFail();
        $user->delete();

        return redirect()->route('seller')->with('success', 'Seller berhasil dihapus.');
    }

    public function cetak_pdf()
    {
        $seller = User::where('role', 'seller')->get();
        $pdf = Pdf::loadView('seller.seller_pdf', compact('seller'));
        return $pdf->download('laporan-seller.pdf');
    }
}
