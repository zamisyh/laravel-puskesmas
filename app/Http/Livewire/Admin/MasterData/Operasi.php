<?php

namespace App\Http\Livewire\Admin\MasterData;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Operasi as Operasis;

class Operasi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate;
    public $data_poli, $operasiId;

    public $kode, $nama, $tindakan_oleh, $biaya;

    public function render()
    {

        if ($this->search) {
            $operasis = Operasis::where('nama_operasi', 'LIKE', '%' . $this->search . '%')
                ->orWhere('kode_operasi', 'LIKE', '%' . $this->search . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $operasis = Operasis::orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }

        return view('livewire.admin.master-data.operasi', compact('operasis'))->extends('layouts.app')->section('content');
    }

    public function openFormCreateOperasi()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreateOperasi()
    {
        $this->openFormCreate = false;
        $this->resetForm();
    }

    public function openFormUpdateOperasi($id)
    {
        $user = Operasis::findOrFail($id);

        $this->kode = $user->kode_operasi;
        $this->nama = $user->nama_operasi;
        $this->tindakan_oleh = $user->tindakan_oleh;
        $this->biaya = $user->biaya;

        $this->operasiId     = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdateOperasi()
    {
        $this->openFormUpdate = false;
    }

    public function saveOperasi()
    {
        $this->validasi();

        try {

            Operasis::create([
                'kode_operasi' => strtoupper($this->kode),
                'nama_operasi' => $this->nama,
                'tindakan_oleh' => $this->tindakan_oleh,
                'biaya' => $this->biaya,
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

    public function updateOperasi($id)
    {

        $this->validasi();
        $data = Operasis::findOrFail($id);

        $data->kode_operasi = $this->kode;
        $data->nama_operasi = $this->nama;
        $data->tindakan_oleh = $this->tindakan_oleh;
        $data->biaya = $this->biaya;


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


    public function deleteOperasi($id)
    {
        $data = Operasis::findOrFail($id);
        $this->operasiId     = $data->id;

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

        Operasis::findOrFail($this->operasiId)->delete();

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
            'biaya' => 'required|numeric',
        ]);
    }
}
