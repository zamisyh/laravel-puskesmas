<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbaikanGizi extends Model
{
    use HasFactory;
    protected $table = 'perbaikan_gizi';

    protected $fillable = [
        'id_pasien', 'hasil', 'terapi', 'tanggal'
    ];


    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }
}
