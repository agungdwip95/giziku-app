<?php

namespace App\Http\Controllers;

use App\Models\EdukasiGizi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class EdukasiGiziController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $edukasiGizi = EdukasiGizi::all();
        return view('edukasi_gizi.view', compact('edukasiGizi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('edukasi_gizi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:150',
            'konten' => 'required|string',
            'kategori' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        EdukasiGizi::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'kategori' => $request->kategori,
            'created_at' => now(),
        ]);

        return redirect()->route('edukasi_gizi.index')->with('success', 'Materi edukasi gizi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $edukasiGizi = EdukasiGizi::findOrFail($id);
        return view('edukasi_gizi.show', compact('edukasiGizi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edukasiGizi = EdukasiGizi::findOrFail($id);
        return view('edukasi_gizi.update', compact('edukasiGizi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:150',
            'konten' => 'required|string',
            'kategori' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $edukasiGizi = EdukasiGizi::findOrFail($id);
        $edukasiGizi->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('edukasi_gizi.index')->with('success', 'Materi edukasi gizi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $edukasiGizi = EdukasiGizi::findOrFail($id);
        $edukasiGizi->delete();

        return redirect()->route('edukasi_gizi.index')->with('success', 'Materi edukasi gizi berhasil dihapus.');
    }

    /**
     * Generate a PDF of all edukasi_gizi records.
     */
    public function cetak_pdf()
    {
        $edukasiGizi = EdukasiGizi::all();
        $pdf = Pdf::loadView('edukasi_gizi.edukasi_gizi_pdf', compact('edukasiGizi'));
        return $pdf->download('edukasi_gizi.pdf');
    }
}