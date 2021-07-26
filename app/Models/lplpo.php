<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lplpo extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }


    public function stock()
    {
        return $this->belongsTo(StokObat::class, 'id_obat', 'id_obat');
    }
}
