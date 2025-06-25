<?php

namespace App\Exports;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class PesananSellerExport implements FromArray, WithHeadings, WithTitle
{
    protected $sellerId;

    public function __construct($sellerId)
    {
        $this->sellerId = $sellerId;
    }

    public function array(): array
    {
        $pesanans = Pesanan::with(['customer', 'products'])
            ->where('id_seller', $this->sellerId)
            ->get();

        $data = [];

        foreach ($pesanans as $pesanan) {
            $totalProduk = 0;
            foreach ($pesanan->products as $produk) {
                $totalProduk += $produk->pivot->harga * $produk->pivot->quantity;
            }
            $ongkir = $pesanan->total_harga - $totalProduk;

            $data[] = [
                $pesanan->id,
                $pesanan->customer->nama ?? '-',
                $pesanan->status,
                $pesanan->created_at->format('d-m-Y H:i'),
                'Rp ' . number_format($totalProduk, 0, ',', '.'),
                'Rp ' . number_format($ongkir, 0, ',', '.'),
                'Rp ' . number_format($pesanan->total_harga, 0, ',', '.'),
            ];
        }

        return $data;
    }

    public function headings(): array
    {
        return ['ID', 'Customer', 'Status', 'Tanggal Pesan', 'Total Produk', 'Ongkir', 'Total Bayar'];
    }

    public function title(): string
    {
        return 'Data Pesanan Seller';
    }
}
