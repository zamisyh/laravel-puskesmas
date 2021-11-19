<?php

namespace App\Imports;

use App\Models\Diagnosa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class DiagnosaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */



    public function model(array $row)
    {
        return new Diagnosa([
            'code' => $row['kode_icd_x'],
            'nama_penyakit' => $row['diagnosa']
        ]);
    }
}
