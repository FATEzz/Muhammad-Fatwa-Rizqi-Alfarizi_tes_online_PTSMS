<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembelianDetail extends Model
{
    use HasFactory;
    protected $table = 'tbl_pembelian_detail';
    protected $fillable = ['header_id', 'barang_id', 'qty', 'harga_satuan', 'subtotal'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
