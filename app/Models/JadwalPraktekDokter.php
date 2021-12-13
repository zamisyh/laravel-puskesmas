<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPraktekDokter extends Model
{
    use HasFactory;
    protected $table = 'jadwal_praktek_dokter';

    protected $fillable = ['id_dokter', 'id_poli', 'hari', 'jam_mulai', 'jam_selesai'];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id');
    }
}
