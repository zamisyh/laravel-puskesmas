<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbaikanGizi extends Model
{
    use HasFactory;
    protected $table = 'perbaikan_gizi';

    protected $fillable = [
        'nama_anak', 'nama_tindakan', 'nama_obat', 'jumlah', 'satuan', 'tanggal'
    ];
}
