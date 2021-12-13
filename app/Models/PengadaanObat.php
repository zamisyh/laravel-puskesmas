<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengadaanObat extends Model
{
    use HasFactory;
    protected $table = 'pengadaan_obat';

    protected $fillable = [
        'no_trans', 'id_supplier', 'id_obat', 'harga_beli', 'jumlah', 'keterangan', 'total', 'tanggal_transaksi'
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id');
    }
}
