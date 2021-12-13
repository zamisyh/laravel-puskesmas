<?php

namespace App\Exports;

use App\Models\Pasien;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PasienExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }
    public function view() : View
    {
       if (!is_null($this->from) && !is_null($this->to)) {
            return view('livewire.admin.exports.pasien', [
                'pasien' =>   Pasien::whereRaw(
                    "(created_at >= ? AND created_at <= ?)",
                    [$this->from." 00:00:00", $this->to." 23:59:59"]
                  )->with('jaminan')->get()
            ]);
       }else{
            return view('livewire.admin.exports.pasien', [
                'pasien' => Pasien::with('jaminan')->get()
            ]);
       }


    }
}
