<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PesananExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pesanan::with(['customer', 'seller'])->get()->map(function($item) {
            return [
                $item->id,
                $item->created_at->format('d-m-Y H:i'),
                $item->customer->nama ?? '-',
                $item->seller->nama ?? '-',
                $item->status,
                $item->total_harga,
            ];
        });
    }

    public function headings(): array
    {
        return ["ID", "Tanggal", "Customer", "Seller", "Status", "Total"];
    }
}
