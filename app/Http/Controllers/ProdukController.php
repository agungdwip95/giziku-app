<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProdukController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil user yang sedang login

        if ($user->role === 'seller') {
            // Jika user adalah seller, hanya tampilkan produk miliknya
            $produk = Produk::where('id_seller', $user->id)
                            ->with(['kategori', 'seller'])
                            ->get();
        } else {
            // Jika bukan seller (misal admin), tampilkan semua produk milik seller
            $produk = Produk::whereHas('seller', function($query) {
                $query->where('role', 'seller');
            })->with(['kategori', 'seller'])->get();
        }

        return view('produk.view', compact('produk'));
    }

    public function create()
    {
        // Ambil hanya user dengan role seller untuk pilihan id_seller
        $sellers = User::where('role', 'seller')->get();
        $kategoris = Kategori::all();

        return view('produk.create', compact('kategoris', 'sellers'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'seller') {
            abort(403, 'Hanya seller yang dapat menambahkan produk.');
        }

        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategoris,id',
            'nama' => 'required|string|max:255|unique:produks,nama',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048', // validasi setiap file
        ]);

        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = 'products/' . uniqid() . '_' . $image->getClientOriginalName();
                $image->move(public_path('products'), $filename); // simpan ke folder public/products
                $imagePaths[] = $filename;
            }
        }

        Produk::create([
            'id_seller' => $user->id,
            'id_kategori' => $request->id_kategori,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'imagePath' => $imagePaths,
        ]);

        return redirect()->route('produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all();
        $sellers = User::where('role', 'seller')->get();

        return view('produk.update', compact('produk', 'kategoris', 'sellers'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'seller') {
            abort(403, 'Hanya seller yang dapat memperbarui produk.');
        }

        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategoris,id',
            'nama' => 'required|string|max:255|unique:produks,nama,' . $request->id,
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $produk = Produk::findOrFail($request->id);

        if ($produk->id_seller != $user->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah produk ini.');
        }

        $imagePaths = $produk->imagePath ?? [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = 'products/' . uniqid() . '_' . $image->getClientOriginalName();
                $image->move(public_path('products'), $filename);
                $imagePaths[] = $filename;
            }
        }

        $produk->update([
            'id_seller' => $user->id,
            'id_kategori' => $request->id_kategori,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'imagePath' => $imagePaths,
        ]);

        return redirect()->route('produk')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $produk = Produk::findOrFail($id);

        // Hanya seller yang boleh menghapus produk miliknya
        if ($user->role === 'seller' && $produk->id_seller != $user->id) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus produk ini.');
        }

        // Hapus file gambar dari folder public/products
        if (is_array($produk->imagePath)) {
            foreach ($produk->imagePath as $path) {
                $fullPath = public_path($path);
                if (file_exists($fullPath)) {
                    unlink($fullPath); // hapus file
                }
            }
        }

        $produk->delete();

        return redirect()->route('produk')->with('success', 'Produk berhasil dihapus.');
    }

   public function cetak_pdf()
   {
        $user = Auth::user(); // Ambil user yang sedang login

        if ($user->role === 'seller') {
            // Jika seller, ambil hanya produk miliknya
            $produk = Produk::where('id_seller', $user->id)
                            ->with(['kategori', 'seller'])
                            ->get();
        } else {
            // Jika bukan seller, ambil semua produk dari seller
            $produk = Produk::whereHas('seller', function ($query) {
                $query->where('role', 'seller');
            })->with(['kategori', 'seller'])->get();
        }

        $pdf = Pdf::loadView('produk.produk_pdf', compact('produk'));
        return $pdf->download('laporan-produk.pdf');
   }

}
