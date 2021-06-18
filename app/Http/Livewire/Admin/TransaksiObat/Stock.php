<?php

namespace App\Http\Livewire\Admin\TransaksiObat;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StokObat;
use App\Models\Obat;

class Stock extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate;
    public $data_obat, $obatId;

    public $nama, $jumlah;

    public function render()
    {

        $this->data_obat = Obat::orderBy('created_at', 'DESC')->get();

        if ($this->search) {
            $stokobats = StokObat::whereHas('obat', function ($query) {
                $query->where('kode_obat', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('nama_obat', 'LIKE', '%' . $this->search . '%');
            })

                ->with('obat')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $stokobats = StokObat::orderBy('created_at', 'DESC')
                ->with('obat')
                ->paginate($this->rows);
        }

        return view('livewire.admin.transaksi-obat.stock', compact('stokobats'))->extends('layouts.app')->section('content');
    }

    public function openFormCreateStokObat()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreateStokObat()
    {
        $this->openFormCreate = false;
        $this->resetForm();
    }

    public function openFormUpdateStokObat($id)
    {
        $user = StokObat::findOrFail($id);

        $this->nama = $user->id_obat;
        $this->jumlah = $user->jumlah;

        $this->obatId = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdateStokObat()
    {
        $this->openFormUpdate = false;
    }

    public function saveStokObat()
    {
        $this->validasi();

        try {

            StokObat::create([
                'id_obat' => $this->nama,
                'jumlah' => $this->jumlah
            ]);


            $this->alert('success', 'Succesfully create obat', [
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

    public function updateStokObat($id)
    {

        $this->validasi();
        $data = StokObat::findOrFail($id);

        $data->id_obat = $this->nama;
        $data->jumlah = $this->jumlah;

        $data->save();

        $this->alert('success', 'Succesfully update obat', [
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


    public function deleteStokObat($id)
    {
        $data = StokObat::findOrFail($id);
        $this->obatId = $data->id;

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

        StokObat::findOrFail($this->obatId)->delete();

        $this->alert('success', 'Succesfully delete obat', [
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
            'nama' => 'required',
            'jumlah' => 'required|numeric'
        ]);
    }
}
