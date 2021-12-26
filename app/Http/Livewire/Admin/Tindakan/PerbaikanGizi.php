<?php

namespace App\Http\Livewire\Admin\Tindakan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PerbaikanGizi as PerbaikanGizis;
use App\Models\Pasien;

class PerbaikanGizi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate;
    public $data_obat, $perbaikanGiziId;

    public $hasil, $data_pasien, $nama_pasien, $terapi, $tanggal;

    public function render()
    {

        $this->data_pasien = Pasien::orderBy('created_at', 'DESC')->get(['id', 'nama_pasien', 'kode_paramedis']);

        if ($this->search) {
            $perbaikan_gizis = PerbaikanGizis::whereHas('pasien', function ($q) {
                $q->where('nama_pasien',  'LIKE', '%' . $this->search . '%')
                    ->orWhere('hasil',  'LIKE', '%' . $this->search . '%')
                    ->orWhere('terapi',  'LIKE', '%' . $this->search . '%')
                    ->orWhere('tanggal', 'LIKE', '%' . $this->search . '%');
            })
                ->with('pasien')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $perbaikan_gizis = PerbaikanGizis::orderBy('created_at', 'DESC')
                ->with('pasien')
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

        $this->nama_pasien = $user->id_pasien;
        $this->hasil = $user->hasil;
        $this->terapi = $user->terapi;
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
                'id_pasien' => $this->nama_pasien,
                'hasil' => $this->hasil,
                'terapi' => $this->terapi,
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

        $data->id_pasien = $this->nama_pasien;
        $data->hasil = $this->hasil;
        $data->terapi = $this->terapi;
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
            'nama_pasien' => 'required',
            'terapi' => 'required',
            'hasil' => 'required',

        ]);
    }
}
