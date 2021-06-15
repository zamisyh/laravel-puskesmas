<?php

namespace App\Http\Livewire\Admin\MasterData;

use Livewire\Component;
use App\Models\Dokter;
use App\Models\JadwalPraktekDokter as JadwalPraktekDokters;
use Livewire\WithPagination;
use App\Models\Poli;

class JadwalPraktekDokter extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['confirmed'];


    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate, $details;
    public $data_dokter, $data_poli, $jadwalPraktekDokterId;

    public $dokter, $jam_mulai, $jam_selesai, $hari, $poli;

    public function render()
    {
        $this->data_dokter = Dokter::orderBy('created_at', 'DESC')->get();
        $this->data_poli = Poli::orderBy('created_at', 'DESC')->get();

        if ($this->search) {
            $jadwalPraktekDokters = JadwalPraktekDokters::whereHas('dokter', function ($query) {
                $query->where('nama_dokter', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('hari', 'LIKE', '%' . $this->search . '%');
            })

                ->with('dokter', 'poli')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $jadwalPraktekDokters = JadwalPraktekDokters::with('dokter', 'poli')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }

        return view('livewire.admin.master-data.jadwal-praktek-dokter', compact('jadwalPraktekDokters'))->extends('layouts.app')->section('content');
    }

    public function openFormCreateJadwalPraktekDokter()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreateJadwalPraktekDokter()
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
    public function openFormUpdateJadwalPraktekDokter($id)
    {
        $user = JadwalPraktekDokters::findOrFail($id);

        $this->dokter = $user->id_dokter;
        $this->hari = $user->hari;
        $this->jam_mulai = $user->jam_mulai;
        $this->jam_selesai = $user->jam_selesai;
        $this->poli = $user->id_poli;

        $this->jadwalPraktekDokterId = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdateJadwalPraktekDokter()
    {
        $this->openFormUpdate = false;
    }

    public function saveJadwalPraktekDokter()
    {
        $this->validasi();

        try {

            JadwalPraktekDokters::create([
                'id_dokter' => $this->dokter,
                'hari' => $this->hari,
                'jam_mulai' => $this->jam_mulai,
                'jam_selesai' => $this->jam_selesai,
                'id_poli' => $this->poli
            ]);


            $this->alert('success', 'Succesfully create dokter', [
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

    public function updateJadwalPraktekDokter($id)
    {

        $this->validasi();
        $data = JadwalPraktekDokters::findOrFail($id);

        $data->id_dokter = $this->dokter;
        $data->hari = $this->hari;
        $data->jam_mulai = $this->jam_mulai;
        $data->jam_selesai = $this->jam_selesai;
        $data->id_poli = $this->poli;

        $data->save();

        $this->alert('success', 'Succesfully update dokter', [
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


    public function deleteJadwalPraktekDokter($id)
    {
        $data = JadwalPraktekDokters::findOrFail($id);
        $this->jadwalPraktekDokterId = $data->id;

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

        JadwalPraktekDokters::findOrFail($this->jadwalPraktekDokterId)->delete();

        $this->alert('success', 'Succesfully delete dokter', [
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
            'dokter' => 'required',
            'poli' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'

        ]);
    }
}
