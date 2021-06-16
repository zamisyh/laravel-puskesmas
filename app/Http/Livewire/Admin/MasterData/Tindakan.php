<?php

namespace App\Http\Livewire\Admin\MasterData;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Poli;
use App\Models\Tindakan as Tindakans;

class Tindakan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate;
    public $data_poli, $tindakanId;

    public $kode, $nama, $tindakan_oleh, $poli;

    public function render()
    {
        $this->data_poli = Poli::orderBy('created_at', 'DESC')->get();

        if ($this->search) {
            $tindakans = Tindakans::where('nama_tindakan', 'LIKE', '%' . $this->search . '%')
                ->orWhere('kode_tindakan', 'LIKE', '%' . $this->search . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $tindakans = Tindakans::orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }

        return view('livewire.admin.master-data.tindakan', compact('tindakans'))->extends('layouts.app')->section('content');
    }

    public function openFormCreateTindakan()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreateTindakan()
    {
        $this->openFormCreate = false;
        $this->resetForm();
    }

    public function openFormUpdateTindakan($id)
    {
        $user = Tindakans::findOrFail($id);

        $this->kode = $user->kode_tindakan;
        $this->nama = $user->nama_tindakan;
        $this->tindakan_oleh = $user->tindakan_oleh;
        $this->poli = $user->id_poli;

        $this->tindakanId = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdateTindakan()
    {
        $this->openFormUpdate = false;
    }

    public function saveTindakan()
    {
        $this->validasi();

        try {

            Tindakans::create([
                'kode_tindakan' => strtoupper($this->kode),
                'nama_tindakan' => $this->nama,
                'tindakan_oleh' => $this->tindakan_oleh,
                'id_poli' => $this->poli,
            ]);


            $this->alert('success', 'Succesfully create tindakan', [
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

    public function updateTindakan($id)
    {

        $this->validasi();
        $data = Tindakans::findOrFail($id);

        $data->kode_tindakan = $this->kode;
        $data->nama_tindakan = $this->nama;
        $data->tindakan_oleh = $this->tindakan_oleh;
        $data->id_poli = $this->poli;


        $data->save();

        $this->alert('success', 'Succesfully update tindakan', [
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


    public function deleteTindakan($id)
    {
        $data = Tindakans::findOrFail($id);
        $this->tindakanId = $data->id;

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

        Tindakans::findOrFail($this->tindakanId)->delete();

        $this->alert('success', 'Succesfully delete tindakan', [
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
            'kode' => 'required',
            'nama' => 'required',
            'tindakan_oleh' => 'required',
            'poli' => 'required',
        ]);
    }
}
