<?php

namespace App\Http\Livewire\Admin\MasterData;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Poli;
use App\Models\Paramedis as Paramedic;
use Carbon\Carbon;

class Paramedis extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate, $details;
    public $data_poli, $paramedisId;

    public $nama, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat_tinggal, $poli;

    public function render()
    {

        $this->data_poli = Poli::orderBy('created_at', 'DESC')->get();

        if($this->search){
            $paramedis = Paramedic::where('nama_paramedis', 'LIKE', '%' . $this->search . '%')
            ->with('poli')
            ->orderBy('created_at', 'DESC')
            ->paginate($this->rows);
        }else{
            $paramedis = Paramedic::with('poli')
            ->orderBy('created_at', 'DESC')
            ->paginate($this->rows);
        }



        return view('livewire.admin.master-data.paramedis', compact('paramedis'))->extends('layouts.app')->section('content');
    }


    public function openFormCreateParamedis() { $this->openFormCreate = true; }
    public function closeFormCreateParamedis() { $this->openFormCreate = false;  $this->resetForm(); }
    public function openDetails() { $this->details = true; }
    public function closeDetails() { $this->details = false; }
    public function openFormUpdateParamedis($id)
    {
        $user = Paramedic::findOrFail($id);
        $this->nama = $user->nama_paramedis;
        $this->jenis_kelamin = $user->jenis_kelamin;
        $this->tempat_lahir = $user->tempat_lahir;
        $this->tanggal_lahir = $user->tanggal_lahir;
        $this->alamat_tinggal = $user->alamat;
        $this->poli = $user->id_poli;
        $this->paramedisId = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdateParamedis() { $this->openFormUpdate = false; }

    public function saveParamedis()
    {
       $this->validasi();

        try {

            Paramedic::create([
                'nama_paramedis' => $this->nama,
                'jenis_kelamin' => $this->jenis_kelamin,
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'alamat' => $this->alamat_tinggal,
                'no_izin_paramedis' => $this->noIzinParamedis(),
                'id_poli' => $this->poli,
            ]);


            $this->alert('success', 'Succesfully create paramedis', [
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

    public function updateParamedis($id)
    {

        $this->validasi();
        $data = Paramedic::findOrFail($id);

        $data->nama_paramedis = $this->nama;
        $data->jenis_kelamin = $this->jenis_kelamin;
        $data->tempat_lahir = $this->tempat_lahir;
        $data->tanggal_lahir = $this->tanggal_lahir;
        $data->alamat =  $this->alamat_tinggal;
        $data->id_poli =  $this->poli;

        $data->save();

        $this->alert('success', 'Succesfully update paramedis', [
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


    public function deleteParamedis($id)
    {
        $data = Paramedic::findOrFail($id);
        $this->paramedisId = $data->id;

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

        Paramedic::findOrFail($this->paramedisId)->delete();

        $this->alert('success', 'Succesfully delete paramedis', [
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


    public function noIzinParamedis()
    {
        return 'NIP-' . date('His') . '-' . rand(10000, 100000);
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();

    }

    public function validasi()
    {
        return $this->validate([
            'nama' => 'required|min:3',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat_tinggal' => 'required',
            'poli' => 'required'
        ]);
    }
}
