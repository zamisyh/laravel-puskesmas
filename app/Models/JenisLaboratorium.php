<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLaboratorium extends Model
{
    use HasFactory;
    protected $table = 'jenis_laboratorium';

    protected $guarded = [];
}
