<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranObat extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran_obat';

    protected $fillable = [
        'no_terima_obat', 'id_pasien', 'id_obat', 'jumlah', 'tanggal_serah_obat', 'keterangan'
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat', 'id');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id');
    }
}
