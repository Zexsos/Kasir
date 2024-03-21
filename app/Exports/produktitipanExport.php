<?php

namespace App\Exports;

use App\Models\produk_titipan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProdukTitipanExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    public function collection()
    {
        return produk_titipan::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Produk',
            'Nama Supplier',
            'Harga Beli',
            'Harga Jual',
            'Stok',
            'Keterangan',
            'Tanggal Dibuat',
            'Tanggal Diperbarui'
        ];
    }

    public function map($produk): array
    {
        return [
            $produk->id,
            $produk->nama_produk,
            $produk->nama_supplier,
            $produk->harga_beli,
            $produk->harga_jual,
            $produk->stok,
            $produk->keterangan,
            $produk->created_at->format('Y-m-d H:i:s'),
            $produk->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
