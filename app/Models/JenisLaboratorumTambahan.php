<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLaboratorumTambahan extends Model
{
    use HasFactory;

    protected $table = 'jenis_laboratorum_tambahan';
    protected $guarded = [];

    // public function lab()
    // {
    //     $this->belongsTo(Laboratorium::class, 'id_laboratorium', 'id');
    // }
}
