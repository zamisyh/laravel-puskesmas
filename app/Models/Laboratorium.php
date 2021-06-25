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

    public function jenis_laboratorium()
    {
        return $this->belongsToMany(JenisLaboratorium::class, 'laboratorium_jenis_laboratorium')
            ->withPivot('hasil')->withTimestamps();
    }
}
