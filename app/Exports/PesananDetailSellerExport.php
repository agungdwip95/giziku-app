<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PesananDetailSellerExport implements FromArray, WithHeadings, WithStyles, WithEvents
{
    protected $pesanan;
    protected $ongkir;
    protected $totalProduk;
    protected $rows = [];

    public function __construct($pesanan)
    {
        $this->pesanan = $pesanan;
        $this->prepareData();
    }

    public function prepareData()
    {
        $this->totalProduk = 0;
        foreach ($this->pesanan->products as $produk) {
            $this->totalProduk += $produk->pivot->harga * $produk->pivot->quantity;
        }
        $this->ongkir = $this->pesanan->total_harga - $this->totalProduk;

        $this->rows[] = ['Detail Pesanan Seller #' . $this->pesanan->id];
        $this->rows[] = ['Shop SARMI'];
        $this->rows[] = [];
        $this->rows[] = ['Tanggal Pesan:', $this->pesanan->created_at->format('d-m-Y H:i')];
        $this->rows[] = ['Customer:', $this->pesanan->customer->nama ?? '-'];
        $this->rows[] = ['Seller:', $this->pesanan->seller->nama ?? '-'];
        $this->rows[] = ['Status:', $this->pesanan->status];
        $this->rows[] = ['Ongkir:', 'Rp ' . number_format($this->ongkir, 0, ',', '.')];
        $this->rows[] = ['Total Bayar:', 'Rp ' . number_format($this->pesanan->total_harga, 0, ',', '.') . ' (Termasuk Ongkir)'];
        $this->rows[] = []; // empty row
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

        // Add total row
        $dataRows[] = ['', '', '', 'Total Harga:', $this->totalProduk];

        return array_merge($this->rows, [$this->headings()], $dataRows);
    }

    public function headings(): array
    {
        return ['No', 'Nama Produk', 'Harga', 'Jumlah', 'Subtotal'];
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
                $event->sheet->mergeCells('A1:E1');
                $event->sheet->mergeCells('A2:E2');
            },
        ];
    }
}
