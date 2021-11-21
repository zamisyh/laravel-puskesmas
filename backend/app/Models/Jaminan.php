<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jaminan extends Model
{
    use HasFactory;
    protected $table = 'jaminan';

    protected $fillable = ['nama_jaminan'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id');
    }
}
