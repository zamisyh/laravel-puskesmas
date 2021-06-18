<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;
    protected $table = 'diagnosa';

    protected $fillable = ['code', 'nama_penyakit', 'ciri_ciri_penyakit', 'kasus', 'keterangan', 'keterangan_umum'];
}
