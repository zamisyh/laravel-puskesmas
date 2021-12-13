<?php

namespace App\Exports;

use App\Models\Obat;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ObatExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        return view('livewire.admin.exports.obat', [
            'obats' => Obat::all()
        ]);
    }
}
