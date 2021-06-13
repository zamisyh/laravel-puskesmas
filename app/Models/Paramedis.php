<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paramedis extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_paramedis', 'jenis_kelamin', 'no_izin_paramedis', 'tempat_lahir',
        'tanggal_lahir', 'alamat', 'id_poli'
    ];


    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id');
    }
}
