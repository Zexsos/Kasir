<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $guarded = ['id'];

    public function jenis()
    {
        return $this->belongsTo(jenis::class, 'jenis_id');
    }
    // public function stok()
    // {
    //     return $this->hasMany(Stok::class, 'menu_id', 'id');
    // }
}
