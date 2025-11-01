<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembelianHeader extends Model
{
    use HasFactory;
    protected $table = 'tbl_pembelian_header';
    protected $fillable = ['kode_transaksi', 'tanggal_pembelian', 'user_id', 'total_harga'];

    public function details() // Relasi One-to-Many
    {
        return $this->hasMany(PembelianDetail::class, 'header_id');
    }
}
