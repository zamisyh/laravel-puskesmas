<?php

namespace App\Http\Livewire\Admin\TransaksiObat;

use Livewire\Component;

class PengeluaranObat extends Component
{
    public function render()
    {
        return view('livewire.admin.transaksi-obat.pengeluaran-obat')->extends('layouts.app')->section('content');
    }
}
