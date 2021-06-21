<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PenangananOperasi extends Model
{
    use HasFactory;
    protected $table = 'penanganan_operasi';

    protected $fillable = [
        'id_pasien', 'nama_operasi', 'ditangani_oleh', 'tanggal_operasi', 'biaya',
        'kembalian', 'keterangan', 'dibayar', 'kembalian', 'status_pasien'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id');
    }
}
