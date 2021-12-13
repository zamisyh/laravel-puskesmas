<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumLine extends Model
{
    use HasFactory;
    protected $table = 'laboratorium_jenis_laboratorium';

    protected $guarded = [];
}
