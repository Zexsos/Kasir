<?php

namespace App\Imports;

use App\Models\produk_titipan;
use Maatwebsite\Excel\Concerns\ToModel;

class NamaImpor implements ToModel
{
    public function model(array $row)
    {
        return new produk_titipan([
            'nama_produk' => $row[0],
            'nama_supplier' => $row[1],
            'harga_beli' => $row[2],
            'harga_jual' => $row[3],
            'stok' => $row[4],
            'keterangan' => $row[5],
        ]);
    }
}
