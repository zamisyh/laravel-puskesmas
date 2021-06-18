<?php

namespace App\Http\Livewire\Admin\MasterData;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Diagnosa as Diagnosas;

class Diagnosa extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate, $details;
    public $diagnosaId;

    public $kode, $nama_penyakit, $kasus, $ciri_ciri, $ciri_ciri_umum, $keterangan;

    public function render()
    {
        if ($this->search) {
            $diagnosas = Diagnosas::where('nama_penyakit', 'LIKE', '%' . $this->search . '%')
                ->orWhere('code', 'LIKE', '%' . $this->search . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $diagnosas = Diagnosas::orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }

        return view('livewire.admin.master-data.diagnosa', compact('diagnosas'))->extends('layouts.app')->section('content');
    }

    public function openFormCreateDiagnosa()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreateDiagnosa()
    {
        $this->openFormCreate = false;
        $this->resetForm();
    }
    public function openDetails()
    {
        $this->details = true;
    }
    public function closeDetails()
    {
        $this->details = false;
    }
    public function openFormUpdateDiagnosa($id)
    {
        $user = Diagnosas::findOrFail($id);

        $this->kode = $user->code;
        $this->nama_penyakit = $user->nama_penyakit;
        $this->kasus = $user->kasus;
        $this->ciri_ciri = $user->ciri_ciri_penyakit;
        $this->ciri_ciri_umum = $user->keterangan_umum;
        $this->keterangan = $user->keterangan;

        $this->diagnosaId = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdateDiagnosa()
    {
        $this->openFormUpdate = false;
    }

    public function saveDiagnosa()
    {
        $this->validasi();

        try {

            Diagnosas::create([
                'code' => strtoupper($this->kode),
                'nama_penyakit' => $this->nama_penyakit,
                'kasus' => !is_null($this->kasus) ? $this->kasus : '-',
                'ciri_ciri_penyakit' => !is_null($this->ciri_ciri) ? $this->ciri_ciri : '-',
                'keterangan_umum' => !is_null($this->ciri_ciri_umum) ? $this->ciri_ciri_umum : '-',
                'keterangan' => !is_null($this->keterangan) ? $this->keterangan : '-'

            ]);


            $this->alert('success', 'Succesfully create diagnosa', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);

            $this->resetForm();
            $this->openFormCreate = false;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function updateDiagnosa($id)
    {

        $this->validasi();
        $data = Diagnosas::findOrFail($id);

        $data->code  = $this->kode;
        $data->nama_penyakit = $this->nama_penyakit;
        $data->kasus = $this->kasus;
        $data->ciri_ciri_penyakit = $this->ciri_ciri;
        $data->keterangan_umum = $this->ciri_ciri_umum;
        $data->keterangan = $this->keterangan;

        $data->save();

        $this->alert('success', 'Succesfully update diagnosa', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);


        $this->resetForm();
        $this->openFormCreate = false;
    }


    public function deleteDiagnosa($id)
    {
        $data = Diagnosas::findOrFail($id);
        $this->diagnosaId = $data->id;

        $this->triggerConfirm();
    }

    public function triggerConfirm()
    {
        $this->confirm('Are you sure you want to delete this data?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function confirmed()
    {

        Diagnosas::findOrFail($this->diagnosaId)->delete();

        $this->alert('success', 'Succesfully delete diagnosa', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }


    public function noIzinDiagnosa()
    {
        return 'NIP-' . date('His') . '-' . rand(10000, 100000);
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    public function validasi()
    {
        return $this->validate([
            'kode' =>  'required',
            'nama_penyakit' => 'required|min:3'
        ]);
    }
}
