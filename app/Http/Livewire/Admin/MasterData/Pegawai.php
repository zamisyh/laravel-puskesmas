<?php

namespace App\Http\Livewire\Admin\MasterData;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Bidang;
use App\Models\Pegawai as Pegawais;
use App\Models\Jabatan;


class Pegawai extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate, $details;
    public $data_jabatan, $data_bidang, $pegawaiId;

    public $nama_pegawai, $jenis_kelamin, $tanggal_lahir, $tempat_lahir, $npwp, $bidang, $jabatan;

    public function render()
    {

        $this->data_jabatan = Jabatan::orderBy('created_at', 'DESC')->get();
        $this->data_bidang = Bidang::orderBy('created_at', 'DESC')->get();

        if ($this->search) {
            $pegawais = Pegawais::where('nama_pegawai', 'LIKE', '%' . $this->search . '%')
                ->with('bidang', 'jabatan')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $pegawais = Pegawais::with('bidang', 'jabatan')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }

        return view('livewire.admin.master-data.pegawai', compact('pegawais'))->extends('layouts.app')->section('content');
    }

    public function openFormCreatePegawai()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreatePegawai()
    {
        $this->openFormCreate = false;
        $this->resetForm();
    }
    public function openDetails()
    {
        $this->details = true;
    }
    public function closeDetails()
    {
        $this->details = false;
    }
    public function openFormUpdatePegawai($id)
    {
        $user = Pegawais::findOrFail($id);
        $this->nama_pegawai = $user->nama_pegawai;
        $this->jenis_kelamin = $user->jenis_kelamin;
        $this->tempat_lahir = $user->tempat_lahir;
        $this->tanggal_lahir = $user->tanggal_lahir;
        $this->npwp = $user->npwp;
        $this->bidang = $user->id_bidang;
        $this->jabatan = $user->id_jabatan;

        $this->pegawaiId = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdatePegawai()
    {
        $this->openFormUpdate = false;
    }

    public function savePegawai()
    {
        $this->validasi();

        try {

            Pegawais::create([
                'nama_pegawai' => $this->nama_pegawai,
                'jenis_kelamin' => $this->jenis_kelamin,
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'npwp' => $this->npwp,
                'id_bidang' => $this->bidang,
                'id_jabatan' => $this->jabatan
            ]);


            $this->alert('success', 'Succesfully create pegawai', [
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

    public function updatePegawai($id)
    {

        $this->validasi();
        $data = Pegawais::findOrFail($id);

        $data->nama_pegawai = $this->nama_pegawai;
        $data->jenis_kelamin = $this->jenis_kelamin;
        $data->tempat_lahir = $this->tempat_lahir;
        $data->tanggal_lahir = $this->tanggal_lahir;
        $data->npwp = $this->npwp;
        $data->id_bidang = $this->bidang;
        $data->id_jabatan = $this->jabatan;

        $data->save();

        $this->alert('success', 'Succesfully update pegawai', [
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


    public function deletePegawai($id)
    {
        $data = Pegawais::findOrFail($id);
        $this->pegawaiId = $data->id;

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

        Pegawais::findOrFail($this->pegawaiId)->delete();

        $this->alert('success', 'Succesfully delete pegawai', [
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
            'nama_pegawai' => 'required|min:4',
            'jenis_kelamin' => 'required',
            'npwp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'bidang' => 'required',
            'jabatan' => 'required'
        ]);
    }
}
