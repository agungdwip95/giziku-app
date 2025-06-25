<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PesananDetailExport implements FromArray, WithHeadings, WithStyles, WithEvents
{
    protected $pesanan;
    protected $ongkir;
    protected $total;
    protected $rows = [];

    public function __construct($pesanan)
    {
        $this->pesanan = $pesanan;

        // Hitung total harga produk (tanpa ongkir)
        $totalProduk = 0;
        foreach ($pesanan->products as $produk) {
            $totalProduk += $produk->pivot->harga * $produk->pivot->quantity;
        }

        $this->ongkir = $pesanan->total_harga - $totalProduk;
        $this->total = $pesanan->total_harga;

        $this->prepareData();
    }

    public function prepareData()
    {
        $this->rows[] = ['Detail Pesanan #' . $this->pesanan->id];
        $this->rows[] = ['Shop SARMI'];
        $this->rows[] = [];
        $this->rows[] = ['Tanggal Pesan:', $this->pesanan->created_at->format('d-m-Y H:i')];
        $this->rows[] = ['Customer:', $this->pesanan->customer->nama ?? '-'];
        $this->rows[] = ['Seller:', $this->pesanan->seller->nama ?? '-'];
        $this->rows[] = ['Status:', $this->pesanan->status];
        $this->rows[] = ['Ongkir:', 'Rp ' . number_format($this->ongkir, 0, ',', '.')];
        $this->rows[] = ['Total Bayar:', 'Rp ' . number_format($this->total, 0, ',', '.') . ' (Termasuk Ongkir)'];
        $this->rows[] = []; // Empty row
    }

    public function headings(): array
    {
        return ['No', 'Nama Produk', 'Harga', 'Jumlah', 'Subtotal'];
    }

    public function array(): array
    {
        $dataRows = [];

        foreach ($this->pesanan->products as $index => $produk) {
            $subtotal = $produk->pivot->harga * $produk->pivot->quantity;
            $dataRows[] = [
                $index + 1,
                $produk->nama,
                $produk->pivot->harga,
                $produk->pivot->quantity,
                $subtotal,
            ];
        }

        // Hitung total harga produk (tanpa ongkir)
        $totalProduk = $this->pesanan->products->sum(function ($produk) {
            return $produk->pivot->harga * $produk->pivot->quantity;
        });

        // Tambahkan total produk, ongkir, dan total bayar ke bawah tabel
        $dataRows[] = ['', '', '', 'Total Harga:', $totalProduk];

        return array_merge($this->rows, [$this->headings()], $dataRows);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 14], 'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            2 => ['font' => ['italic' => true], 'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            \Maatwebsite\Excel\Events\AfterSheet::class => function (\Maatwebsite\Excel\Events\AfterSheet $event) {
                $event->sheet->mergeCells('A1:E1'); // Judul
                $event->sheet->mergeCells('A2:E2'); // Subjudul
            },
        ];
    }
}
