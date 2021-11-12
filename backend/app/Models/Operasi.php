<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operasi extends Model
{
    use HasFactory;
    protected $table = 'operasi';

    protected $fillable = [
        'kode_operasi', 'nama_operasi', 'biaya', 'tindakan_oleh'
    ];
}
