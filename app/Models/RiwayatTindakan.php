<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTindakan extends Model
{
    use HasFactory;
    protected $table = 'riwayat_tindakan';
    protected $guarded = [];


    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id');
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran', 'id');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id');
    }

    public function tindakan()
    {
        return $this->belongsTo(Tindakan::class, 'id_tindakan', 'id');
    }

    public function diagnosa()
    {
        return $this->belongsTo(Diagnosa::class, 'id_diagnosa', 'id');
    }

    public function diagnosaMany()
    {
        return $this->belongsToMany(Diagnosa::class, 'diagnosa_riwayat_tindakan')->withTimestamps();
    }
}
