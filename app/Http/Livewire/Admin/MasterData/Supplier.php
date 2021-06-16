<?php

namespace App\Http\Livewire\Admin\MasterData;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Supplier as Suppliers;

class Supplier extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate;
    public $supplierId;

    public $nama_supplier, $no_telp, $alamat;

    public function render()
    {
        if ($this->search) {
            $suppliers = Suppliers::where('nama', 'LIKE', '%' . $this->search . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $suppliers = Suppliers::orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }

        return view('livewire.admin.master-data.supplier', compact('suppliers'))->extends('layouts.app')->section('content');
    }


    public function openFormCreateSupplier()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreateSupplier()
    {
        $this->openFormCreate = false;
        $this->resetForm();
    }

    public function openFormUpdateSupplier($id)
    {
        $user = Suppliers::findOrFail($id);

        $this->nama_supplier = $user->nama;
        $this->no_telp = $user->no_telp;
        $this->alamat = $user->alamat;

        $this->supplierId = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdateSupplier()
    {
        $this->openFormUpdate = false;
    }

    public function saveSupplier()
    {
        $this->validasi();

        try {

            Suppliers::create([
                'nama' => $this->nama_supplier,
                'no_telp' => $this->no_telp,
                'alamat' => $this->alamat,
            ]);


            $this->alert('success', 'Succesfully create supplier', [
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

    public function updateSupplier($id)
    {

        $this->validasi();
        $data = Suppliers::findOrFail($id);

        $data->nama = $this->nama_supplier;
        $data->no_telp = $this->no_telp;
        $data->alamat = $this->alamat;

        $data->save();

        $this->alert('success', 'Succesfully update supplier', [
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


    public function deleteSupplier($id)
    {
        $data = Suppliers::findOrFail($id);
        $this->supplierId = $data->id;

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

        Suppliers::findOrFail($this->supplierId)->delete();

        $this->alert('success', 'Succesfully delete supplier', [
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
            'nama_supplier' => 'required|min:4',
            'no_telp' => 'required|min:9|numeric',
            'alamat' => 'required'
        ]);
    }
}
