<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_transaksi extends Model
{
    use HasFactory;
    protected $table = 'detail_transaksi';
    protected $fillable = ['transaksi_id', 'menu_id', 'jumlah', 'subtotal'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function transaksi()
    {
        return $this->belongsTo(transaksi::class, 'transaksi_id');
    }
}
