<?php

namespace App\Http\Livewire\Admin\MasterData;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Obat as Obats;

class Obat extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate;
    public $obatId;

    public $kode, $nama, $jenis, $dosis, $satuan, $sediaan;

    public function render()
    {
        if ($this->search) {
            $obats = Obats::where('nama_obat', 'LIKE', '%' . $this->search . '%')
                ->orWhere('kode_obat', 'LIKE', '%' . $this->search . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $obats = Obats::orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }


        return view('livewire.admin.master-data.obat', compact('obats'))->extends('layouts.app')->section('content');
    }

    public function openFormCreateObat()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreateObat()
    {
        $this->openFormCreate = false;
        $this->resetForm();
    }

    public function openFormUpdateObat($id)
    {
        $user = Obats::findOrFail($id);

        $this->kode = $user->kode_obat;
        $this->nama = $user->nama_obat;
        $this->jenis = $user->jenis_obat;
        $this->dosis = $user->dosis_aturan_obat;
        $this->satuan = $user->satuan;
        $this->sediaan = $user->sediaan;

        $this->obatId = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdateObat()
    {
        $this->openFormUpdate = false;
    }

    public function saveObat()
    {
        $this->validasi();

        try {

            Obats::create([
                'kode_obat' => strtoupper($this->kode),
                'nama_obat' => $this->nama,
                'jenis_obat' => $this->jenis,
                'dosis_aturan_obat' => $this->dosis,
                'satuan' => $this->satuan,
                'sediaan' => $this->sediaan
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

    public function updateObat($id)
    {

        $this->validasi();
        $data = Obats::findOrFail($id);

        $data->kode_obat = $this->kode;
        $data->nama_obat = $this->nama;
        $data->jenis_obat = $this->jenis;
        $data->dosis_aturan_obat = $this->dosis;
        $data->satuan = $this->satuan;
        $data->sediaan = $this->sediaan;

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


    public function deleteObat($id)
    {
        $data = Obats::findOrFail($id);
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

        Obats::findOrFail($this->obatId)->delete();

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
            'kode' => 'required',
            'nama' => 'required',
            'jenis' => 'required',
            'dosis' => 'required',
            'satuan' => 'required',
            'sediaan' => 'required'
        ]);
    }
}
