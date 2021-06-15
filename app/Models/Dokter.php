<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    protected $table = 'dokter';

    protected $fillable = [
        'id_poli', 'kode_dokter', 'nama_dokter', 'jenis_kelamin', 'nid', 'tempat_lahir', 'tanggal_lahir', 'alamat'
    ];

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id');
    }
}
