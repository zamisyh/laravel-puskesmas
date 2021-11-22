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
            'riwayat_tindakan' => DB::table('riwayat_tindakan')
            ->join('pendaftaran', 'riwayat_tindakan.no_rekamedis', '=', 'pendaftaran.no_rekammedis')
            ->join('pasien', 'riwayat_tindakan.no_rekamedis', '=', 'pasien.kode_paramedis')
            ->where('no_rekamedis', $this->no_rekamedis)
            ->get([
                'tanggal_daftar',
                'no_rekamedis',
                'nama_pasien',
                'keluhan',
                'cek_fisik',
                'temperatur',
                'tekanan_darah',
                'tekanan_nadi',
                'hr',
                'rr',
                'tinggi_badan',
                'bb',
                'lp',
                'imt',
                'hasil_periksa',
                'jenis_kasus',
                'nama_tindakan',
                'rencana_pengobatan',
            ])
        ]);


    }
}
