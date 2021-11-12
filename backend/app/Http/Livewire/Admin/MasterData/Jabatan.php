<?php

namespace App\Http\Livewire\Admin\MasterData;

use Livewire\Component;
use App\Models\Jabatan as Jabatans;
use Livewire\WithPagination;

class Jabatan extends Component
{

    use WithPagination;

    protected $listeners = ['confirmed'];
    protected $paginationTheme = 'bootstrap';

    public $openFormCreate;
    public $nama_jabatan, $jabatanId;

    public $search;
    public $rows = 5;

    public function render()
    {

        if ($this->search) {
            $data_jabatan = Jabatans::where('nama_jabatan', 'LIKE', '%' . $this->search . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $data_jabatan = Jabatans::orderBy('created_at', 'DESC')->paginate($this->rows);
        }

        return view('livewire.admin.master-data.jabatan', compact('data_jabatan'))->extends('layouts.app')->section('content');
    }

    public function openFormCreateJabatan()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreateJabatan()
    {
        $this->openFormCreate = false;
    }


    public function saveJabatan()
    {
        $data = $this->validate([
            'nama_jabatan' => 'required|unique:jabatan,nama_jabatan',
        ]);

        try {
            Jabatans::create($data);

            $this->alert('success', 'Succesfully create Jabatan', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);

            $this->openFormCreate = false;
            $this->resetForm();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function deleteJabatan($id)
    {
        $data = Jabatans::findOrFail($id);
        $this->jabatanId = $data->id;
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

        Jabatans::findOrFail($this->jabatanId)->delete();

        $this->alert('success', 'Succesfully delete Jabatan', [
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
}
