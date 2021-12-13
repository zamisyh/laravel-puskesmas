<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorium extends Model
{
    use HasFactory;
    protected $table = 'laboratorium';
    protected $fillable = ['no_rawat', 'no_rekammedis', 'id_pasien'];


    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }


    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pasien');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }



    public function jenis_laboratorium()
    {
        return $this->belongsToMany(JenisLaboratorium::class, 'laboratorium_jenis_laboratorium')
            ->withPivot('hasil')->withTimestamps();
    }

    public function jenis_laboratorum_tambahan()
    {
        return $this->hasMany(JenisLaboratorumTambahan::class, 'id_laboratorium', 'id');
    }
}
