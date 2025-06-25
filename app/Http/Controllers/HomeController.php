<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $total_admin = User::where('role','=','admin')->count();
        $total_seller = User::where('role','=','seller')->count();
        $total_customer = User::where('role','=','customer')->count();
        $total_pesanan = Pesanan::count();

        $userId = Auth::user()->id;
        $nama_seller = User::where('id', $userId)->value('nama');
        $total_produk_seller = Produk::where('id_seller', $userId)->count();
        $total_pesanan_seller = Pesanan::where('id_seller', $userId)->count();
        $total_saldo = User::where('id', $userId)->value('saldo');

        // // bar chart
        $produkss = DB::table('pesanan_produk as pp')
            ->join('produks as p', 'pp.produk_id', '=', 'p.id')
            ->select('p.nama', DB::raw('SUM(pp.quantity) as total_quantity'))
            ->groupBy('pp.produk_id', 'p.nama')
            ->orderByDesc('total_quantity')
            ->get();

        $result = [['Nama Produk', 'Jumlah']];
        foreach ($produkss as $key => $value) {
            $result[] = [$value->nama, (int) $value->total_quantity];
        }

        return view('dashboard', 
        [
            'total_admin' => $total_admin,  
            'total_seller' => $total_seller,  
            'total_customer' => $total_customer,  
            'total_pesanan' => $total_pesanan,  
            'total_saldo' => $total_saldo,  
            'result' => $result,  
            'nama_seller' => $nama_seller,  
            'total_produk_seller' => $total_produk_seller,  
            'total_pesanan_seller' => $total_pesanan_seller,  
        ]);

    }
}
