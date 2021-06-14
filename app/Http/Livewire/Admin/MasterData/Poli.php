<?php

namespace App\Http\Livewire\Admin\MasterData;

use Livewire\Component;
use App\Models\Poli as Polis;
use Livewire\WithPagination;

class Poli extends Component
{
    use WithPagination;

    protected $listeners = ['confirmed'];
    protected $paginationTheme = 'bootstrap';

    public $openFormCreate;
    public $nama_poli, $ruang_poli, $poliId;

    public $search;
    public $rows = 5;

    public function render()
    {



        if ($this->search) {
            $data_poli = Polis::where('nama_poli', 'LIKE', '%' . $this->search . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $data_poli = Polis::orderBy('created_at', 'DESC')->paginate($this->rows);
        }

        return view('livewire.admin.master-data.poli', compact('data_poli'))->extends('layouts.app')->section('content');
    }

    public function openFormCreatePoli()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreatePoli()
    {
        $this->openFormCreate = false;
    }


    public function savePoli()
    {
        $data = $this->validate([
            'nama_poli' => 'required',
            'ruang_poli' => 'required'
        ]);

        try {
            Polis::create($data);

            $this->alert('success', 'Succesfully create poli', [
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
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function deletePoli($id)
    {
        $data = Polis::findOrFail($id);
        $this->poliId = $data->id;
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

        Polis::findOrFail($this->poliId)->delete();

        $this->alert('success', 'Succesfully delete poli', [
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
}
