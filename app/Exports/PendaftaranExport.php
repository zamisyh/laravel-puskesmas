<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class PendaftaranExport implements FromView
{

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return \Illuminate\Support\View
     */

    public function view(): View
    {
        if (!is_null($this->from) && !is_null($this->to)) {
            return view('livewire.admin.exports.pendaftaran', [
                'pendaftaran' => Pendaftaran::whereRaw(
                    "(created_at >= ? AND created_at <= ?)",
                    [$this->from . " 00:00:00", $this->to . " 23:59:59"]
                )->with('dokter', 'poli', 'pasien')->get()
            ]);
        } else {
            return view('livewire.admin.exports.pendaftaran', [
                'pendaftaran' => Pendaftaran::with('dokter', 'poli', 'pasien')->get()
            ]);
        }
    }
}
