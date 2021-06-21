<?php

namespace App\Http\Livewire\Admin\Tindakan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PerbaikanGizi as PerbaikanGizis;

class PerbaikanGizi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate;
    public $data_obat, $perbaikanGiziId;

    public $nama_anak, $nama_tindakan, $nama_obat, $jumlah, $satuan, $tanggal;

    public function render()
    {

        if ($this->search) {
            $perbaikan_gizis = PerbaikanGizis::where('nama_obat', 'LIKE', '%' . $this->search . '%')
                ->orWhere('nama_anak', 'LIKE', '%' . $this->search . '%')
                ->orWhere('nama_tindakan', 'LIKE', '%' . $this->search . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $perbaikan_gizis = PerbaikanGizis::orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }


        return view('livewire.admin.tindakan.perbaikan-gizi', compact('perbaikan_gizis'))->extends('layouts.app')->section('content');
    }

    public function openFormCreatePerbaikanGizi()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreatePerbaikanGizi()
    {
        $this->openFormCreate = false;
        $this->resetForm();
    }

    public function openFormUpdatePerbaikanGizi($id)
    {
        $user = PerbaikanGizis::findOrFail($id);

        $this->nama_anak = $user->nama_anak;
        $this->nama_tindakan = $user->nama_tindakan;
        $this->nama_obat = $user->nama_obat;
        $this->jumlah = $user->jumlah;
        $this->satuan = $user->satuan;
        $this->tanggal = $user->tanggal;


        $this->perbaikanGiziId = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdatePerbaikanGizi()
    {
        $this->openFormUpdate = false;
    }

    public function savePerbaikanGizi()
    {
        $this->validasi();

        try {

            PerbaikanGizis::create([
                'nama_anak' => $this->nama_anak,
                'nama_tindakan' => $this->nama_tindakan,
                'nama_obat' => $this->nama_obat,
                'jumlah' => $this->jumlah,
                'satuan' => $this->satuan,
                'tanggal' => $this->tanggal
            ]);


            $this->alert('success', 'Succesfully create data', [
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

    public function updatePerbaikanGizi($id)
    {

        $this->validasi();
        $data = PerbaikanGizis::findOrFail($id);

        $data->nama_anak = $this->nama_anak;
        $data->nama_tindakan = $this->nama_tindakan;
        $data->nama_obat = $this->nama_obat;
        $data->satuan = $this->satuan;
        $data->jumlah = $this->jumlah;
        $data->tanggal = $this->tanggal;


        $data->save();

        $this->alert('success', 'Succesfully update data', [
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


    public function deletePerbaikanGizi($id)
    {
        $data = PerbaikanGizis::findOrFail($id);
        $this->perbaikanGiziId = $data->id;

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

        PerbaikanGizis::findOrFail($this->perbaikanGiziId)->delete();

        $this->alert('success', 'Succesfully delete data', [
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
            'nama_anak' => 'required',
            'nama_tindakan' => 'required',
            'nama_obat' => 'required',
            'jumlah' => 'required|numeric',
            'satuan' => 'required',
            'tanggal' => 'required'
        ]);
    }
}
