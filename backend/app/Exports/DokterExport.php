<?php

namespace App\Exports;

use App\Models\Dokter;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class DokterExport implements FromView
{
    
    public function view() : View
    {
        return view('livewire.admin.exports.dokter', [
            'dokters' => Dokter::with('poli')->get()
        ]);
    }
}
