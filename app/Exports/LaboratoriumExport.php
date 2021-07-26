<?php

namespace App\Exports;

use App\Models\Laboratorium;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaboratoriumExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($id)
    {
        $this->id = $id;
    }



    public function view() : View
    {
        if (!(is_null($this->id))) {
            return view('livewire.admin.exports.laboratorium', [
                'labs' => Laboratorium::where('id', $this->id)->with(
                        'pendaftaran', 
                        'pendaftaran.pasien:id,nama_pasien,usia,alamat',
                        'pendaftaran.dokter:id,nama_dokter',
                        'pendaftaran.poli:id,nama_poli')
                    ->get()
            ]);
        } else {
            return view('livewire.admin.exports.laboratorium', [
                'labs' => Laboratorium::with(
                        'pendaftaran', 
                        'pendaftaran.pasien:id,nama_pasien,usia,alamat',
                        'pendaftaran.dokter:id,nama_dokter',
                        'pendaftaran.poli:id,nama_poli')
                    ->get()
            ]);
        }
        
    }
}
