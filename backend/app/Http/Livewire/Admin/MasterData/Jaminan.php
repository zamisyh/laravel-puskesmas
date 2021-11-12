<?php

namespace App\Http\Livewire\Admin\MasterData;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Jaminan as Jaminans;

class Jaminan extends Component
{

    use WithPagination;

    protected $listeners = ['confirmed'];
    protected $paginationTheme = 'bootstrap';

    public $openFormCreate;
    public $nama_jaminan, $jaminanId;

    public $search;
    public $rows = 5;

    public function render()
    {
        if ($this->search) {
            $data_jaminan = Jaminans::where('nama_jaminan', 'LIKE', '%' . $this->search . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $data_jaminan = Jaminans::orderBy('created_at', 'DESC')->paginate($this->rows);
        }

        return view('livewire.admin.master-data.jaminan', compact('data_jaminan'))->extends('layouts.app')->section('content');
    }

    public function openFormCreateJaminan()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreateJaminan()
    {
        $this->openFormCreate = false;
    }


    public function saveJaminan()
    {
        $data = $this->validate([
            'nama_jaminan' => 'required|unique:jaminan,nama_jaminan',
        ]);

        try {
            Jaminans::create($data);

            $this->alert('success', 'Succesfully create jaminan', [
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

    public function deleteJaminan($id)
    {
        $data = Jaminans::findOrFail($id);
        $this->jaminanId = $data->id;
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

        Jaminans::findOrFail($this->jaminanId)->delete();

        $this->alert('success', 'Succesfully delete jaminan', [
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
