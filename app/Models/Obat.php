<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;
    protected $table = 'obat';

    protected $fillable = [
        'kode_obat', 'nama_obat', 'jenis_obat', 'dosis_aturan_obat', 'satuan', 'sediaan'
    ];


    public function stock()
    {
        return $this->hasOne(StokObat::class, 'id_obat');
    }
}
