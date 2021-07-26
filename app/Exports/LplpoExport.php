<?php

namespace App\Exports;


use App\Models\lplpo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LplpoExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('livewire.admin.exports.lplpo', [
            'lplpo' => lplpo::with('obat', 'stock')->get()
        ]);
    }
}
