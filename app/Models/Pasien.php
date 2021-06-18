<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';

    protected $fillable = [
        'id_jaminan', 'no_kk', 'nama_pasien', 'kode_paramedis', 'no_ktp', 'no_bpjs', 'jenis_kelamin',
        'tempat_lahir', 'tanggal_lahir', 'alamat', 'status_pasien', 'wilayah', 'usia', 'no_jaminan'
    ];


    public function jaminan()
    {
        return $this->belongsTo(Jaminan::class, 'id_jaminan', 'id');
    }
}
