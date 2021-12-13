<?php

namespace App\Exports;

use App\Models\Dokter;
use App\Models\Laboratorium;
use App\Models\Pasien;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use App\Models\RiwayatTindakan;
use Illuminate\Support\Facades\DB;

class DokterExport implements FromView
{

    public function view() : View
    {
        return view('livewire.admin.exports.dokter', [
            'dokters' => RiwayatTindakan::with('pasien', 'poli', 'diagnosa', 'pasien.jaminan', 'pasien.laboratorium')->orderBy('created_at', 'DESC')->get()
        ]);

    }
}
