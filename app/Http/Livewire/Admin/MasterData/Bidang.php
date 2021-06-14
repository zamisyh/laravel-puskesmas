<?php

namespace App\Http\Livewire\Admin\MasterData;

use Livewire\Component;
use App\Models\Bidang as Bidangs;
use Livewire\WithPagination;

class Bidang extends Component
{

    use WithPagination;

    protected $listeners = ['confirmed'];
    protected $paginationTheme = 'bootstrap';

    public $openFormCreate;
    public $nama_bidang, $bidangId;

    public $search;
    public $rows = 5;


    public function render()
    {
        if ($this->search) {
            $data_bidang = Bidangs::where('nama_bidang', 'LIKE', '%' . $this->search . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $data_bidang = Bidangs::orderBy('created_at', 'DESC')->paginate($this->rows);
        }


        return view('livewire.admin.master-data.bidang', compact('data_bidang'))->extends('layouts.app')->section('content');
    }

    public function openFormCreateBidang()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreateBidang()
    {
        $this->openFormCreate = false;
    }


    public function saveBidang()
    {
        $data = $this->validate([
            'nama_bidang' => 'required|unique:bidang,nama_bidang',
        ]);

        try {
            Bidangs::create($data);

            $this->alert('success', 'Succesfully create Bidang', [
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

    public function deleteBidang($id)
    {
        $data = Bidangs::findOrFail($id);
        $this->bidangId = $data->id;
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

        Bidangs::findOrFail($this->bidangId)->delete();

        $this->alert('success', 'Succesfully delete Bidang', [
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
