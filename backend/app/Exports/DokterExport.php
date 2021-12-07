<?php

namespace App\Exports;

use App\Models\Dokter;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use App\Models\RiwayatTindakan;

class DokterExport implements FromView
{

    public function view() : View
    {

        // $data = RiwayatTindakan::with('pasien', 'poli', 'diagnosa', 'pasien.jaminan')->orderBy('created_at', 'DESC')->get();
        // dd($data);

        return view('livewire.admin.exports.dokter', [
            'dokters' => RiwayatTindakan::with('pasien', 'poli', 'diagnosa', 'pasien.jaminan')->orderBy('created_at', 'DESC')->get()
        ]);
    }
}
