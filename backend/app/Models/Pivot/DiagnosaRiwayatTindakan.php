<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosaRiwayatTindakan extends Model
{
    use HasFactory;
    protected $table = 'diagnosa_riwayat_tindakan';
    protected $guarded = [];
}
