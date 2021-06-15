<?php

namespace App\Http\Livewire\Admin\MasterData;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dokter as Dokters;
use App\Models\Poli;

class Dokter extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['confirmed'];


    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate, $details;
    public $data_poli, $dokterId;

    public $nama_dokter, $kode_dokter, $jenis_kelamin, $poli, $nid,
        $tempat_lahir, $tanggal_lahir, $alamat;

    public function render()
    {

        $this->data_poli = Poli::orderBy('created_at', 'DESC')->get();

        if ($this->search) {
            $dokters = dokters::where('nama_pegawai', 'LIKE', '%' . $this->search . '%')
                ->with('poli')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $dokters = dokters::with('poli')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }

        return view('livewire.admin.master-data.dokter', compact('dokters'))->extends('layouts.app')->section('content');
    }

    public function openFormCreateDokter()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreateDokter()
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
    public function openFormUpdateDokter($id)
    {
        $user = dokters::findOrFail($id);

        $this->nama_dokter = $user->nama_dokter;
        $this->kode_dokter = $user->kode_dokter;
        $this->nid = $user->nid;
        $this->poli = $user->id_poli;
        $this->jenis_kelamin = $user->jenis_kelamin;
        $this->tempat_lahir = $user->tempat_lahir;
        $this->tanggal_lahir = $user->tanggal_lahir;
        $this->alamat = $user->alamat;

        $this->dokterId = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdateDokter()
    {
        $this->openFormUpdate = false;
    }

    public function saveDokter()
    {
        $this->validasi();

        try {

            dokters::create([
                'nama_dokter' => $this->nama_dokter,
                'kode_dokter' => strtoupper($this->kode_dokter),
                'nid' => $this->nid,
                'id_poli' => $this->poli,
                'jenis_kelamin' => $this->jenis_kelamin,
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'alamat' => $this->alamat,

            ]);


            $this->alert('success', 'Succesfully create dokter', [
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

    public function updateDokter($id)
    {

        $this->validasi();
        $data = dokters::findOrFail($id);

        $data->nama_dokter = $this->nama_dokter;
        $data->kode_dokter = $this->kode_dokter;
        $data->nid = $this->nid;
        $data->id_poli = $this->poli;
        $data->jenis_kelamin = $this->jenis_kelamin;
        $data->tempat_lahir = $this->tempat_lahir;
        $data->tanggal_lahir = $this->tanggal_lahir;
        $data->alamat = $this->alamat;

        $data->save();

        $this->alert('success', 'Succesfully update dokter', [
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


    public function deleteDokter($id)
    {
        $data = dokters::findOrFail($id);
        $this->dokterId = $data->id;

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

        dokters::findOrFail($this->dokterId)->delete();

        $this->alert('success', 'Succesfully delete dokter', [
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




    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    public function validasi()
    {
        $this->validate([
            'nama_dokter' => 'required|min:4',
            'jenis_kelamin' => 'required',
            'kode_dokter' => 'required',
            'nid' => 'required',
            'poli' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
        ]);
    }
}
