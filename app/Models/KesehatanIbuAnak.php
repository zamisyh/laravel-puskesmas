<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KesehatanIbuAnak extends Model
{
    use HasFactory;
    protected $table = 'kesehatan_ibu_anak';
    protected $guarded = [];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id');
    }
}
