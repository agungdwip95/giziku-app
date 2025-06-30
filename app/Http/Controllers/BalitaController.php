<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BalitaController extends Controller
{
    public function index()
    {
        $balitas = Balita::with('user')->get();
        return view('balita.view', compact('balitas'));
    }

    public function create()
    {
        $users = User::where('role', 'ortu')->get();
        return view('balita.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        Balita::create($validated);

        return redirect()->route('balita.index')->with('success', 'Data balita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $balita = Balita::findOrFail($id);
        $users = User::where('role', 'ortu')->get();
        return view('balita.update', compact('balita', 'users'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $balita = Balita::findOrFail($id);
        $balita->update($validated);

        return redirect()->route('balita.index')->with('success', 'Data balita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $balita = Balita::findOrFail($id);
        $balita->delete();

        return redirect()->route('balita.index')->with('success', 'Data balita berhasil dihapus.');
    }

    public function cetak_pdf()
    {
        $balitas = Balita::with('user')->get();
        $pdf = Pdf::loadView('balita.balita_pdf', compact('balitas'));
        return $pdf->download('laporan-balita.pdf');
    }
}