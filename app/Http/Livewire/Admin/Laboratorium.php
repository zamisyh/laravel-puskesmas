<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Laboratorium as Lab;

class Laboratorium extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'updatedHasil' => 'updateData'
    ];

    public $search, $pageSize = 5;


    public $openLab, $data_pasien, $data_labo, $openUpdateHasil;
    public $nama_pasien, $no_rawat, $no_rekamedis, $hasil = [];
    public $printPage;


    public function render()
    {


        if ($this->search) {

            $data_lab = Lab::whereHas('pasien', function ($q) {
                $q->where('nama_pasien', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('no_rawat', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('no_rekammedis', 'LIKE', '%' . $this->search . '%');
            })->with('pasien')->paginate($this->pageSize);
        } else {
            $data_lab = Lab::with('pasien')->orderBy('created_at', 'DESC')->paginate($this->pageSize);
        }

        return view('livewire.admin.laboratorium', compact('data_lab'))->extends('layouts.app')->section('content');
    }

    public function openFormLab($id)
    {
        $this->openLab = true;
        $this->data_pasien = Lab::where('id', $id)->with('pasien')->first();
        $this->nama_pasien = $this->data_pasien->pasien->nama_pasien;
        $this->no_rawat = $this->data_pasien->no_rawat;
        $this->no_rekamedis = $this->data_pasien->no_rekammedis;
    }

    public function updatedHasil()
    {
        $lab = Lab::where('no_rawat', $this->no_rawat)->first();
        foreach ($this->hasil as $key => $value) {
            $lab->jenis_laboratorium()->updateExistingPivot($key, ['hasil' => $value]);
        }
    }

    public function openInputUpdateHasil()
    {
        $this->openUpdateHasil = true;
    }

    public function closeInputUpdateHasil()
    {
        $this->openUpdateHasil = false;
    }

    public function refreshData()
    {
        $this->emit('updatedHasil');
    }

    public function updateData()
    {
        $this->closeInputUpdateHasil();
    }

    public function openPrint($id)
    {
        $this->data_pasien = Lab::where('id', $id)->with('pasien')->first();
        $this->printPage = true;
    }
}
