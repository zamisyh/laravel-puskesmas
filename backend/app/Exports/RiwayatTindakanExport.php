<?php

namespace App\Exports;

use App\Models\RiwayatTindakan;
use App\Models\Pendaftaran;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class RiwayatTindakanExport implements FromView
{

    public function __construct($no_rekamedis)
    {
        $this->no_rekamedis = $no_rekamedis;
    }

    public function view() : View
    {
        return view('livewire.admin.exports.riwayat-tindakan', [
            'riwayat_tindakan' => RiwayatTindakan::where('no_rekamedis', $this->no_rekamedis)
            ->with('pasien:id,nama_pasien', 'pendaftaran:id,tanggal_daftar')
            ->orderBy('created_at', 'DESC')
            ->get()
        ]);
    }
}
