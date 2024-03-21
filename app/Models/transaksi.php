<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $table = "transaksi";
    protected $guarded = ["created_at", "updated_at"];

    public function pelanggan()
    {
        return $this->belongsTo(pelanggan::class, 'id_pelanggan');
    }
    public function detail_transaksi()
    {
        return $this->hasMany(detail_transaksi::class);
    }
}
