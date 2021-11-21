<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';

    protected $guarded = [];

    public function jaminan()
    {
        return $this->belongsTo(Jaminan::class, 'id_jaminan', 'id');
    }
}
