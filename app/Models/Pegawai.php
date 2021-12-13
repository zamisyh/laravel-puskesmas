<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';

    protected $fillable = [
        'id_jabatan', 'id_bidang', 'nama_pegawai', 'jenis_kelamin',
        'npwp', 'tempat_lahir', 'tanggal_lahir'
    ];


    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang', 'id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id');
    }
}
