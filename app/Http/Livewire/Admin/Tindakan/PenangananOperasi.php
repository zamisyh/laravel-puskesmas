<?php

namespace App\Http\Livewire\Admin\Tindakan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pasien;
use App\Models\PenangananOperasi as Operasi;

class PenangananOperasi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate, $details, $showDataPasien;
    public $data_pasien, $penangananOperasiId;

    public $pasien, $no_bpjs, $status_pasien, $biaya, $kembalian, $dibayar, $keterangan,
        $ditangani_oleh, $tanggal_operasi, $nama_operasi;

    public $getIdPasien, $formBpjs, $freeBpjs;


    public function render()
    {

        $this->data_pasien = Pasien::orderBy('created_at', 'DESC')->get();

        if ($this->search) {
            $penanganan_operasi = Operasi::whereHas('pasien', function ($q) {
                $q->where('nama_pasien', 'LIKE', '%' . $this->search . '%');
            })->orWhere('status_pasien', 'LIKE', '%' . $this->search . '%')
                ->with('pasien')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $penanganan_operasi = Operasi::with('pasien')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }


        return view('livewire.admin.tindakan.penanganan-operasi', compact('penanganan_operasi'))->extends('layouts.app')->section('content');
    }

    public function openFormCreatePenangananOperasi()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreatePenangananOperasi()
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

    public function openDetailPasien()
    {
        $this->showDataPasien = true;
    }

    public function closeDetailPasien()
    {
        $this->showDataPasien = false;
    }

    public function openFormUpdatePenangananOperasi($id)
    {
        $user = Operasi::findOrFail($id);

        $this->pasien = $user->id_pasien;
        $this->status_pasien = $user->status_pasien;
        $this->nama_operasi = $user->nama_operasi;
        $this->ditangani_oleh = $user->ditangani_oleh;
        $this->tanggal_operasi = $user->tanggal_operasi;

        if ($user->status_pasien == 'bpjs') {
            $this->biaya = 0;
            $this->dibayar = 0;
            $this->kembalian = 0;
            $this->keterangan = 'Gratis';
        } else {
            $this->dibayar = $user->dibayar;
            $this->biaya = $user->biaya;
            $this->kembalian = $user->kembalian;
            $this->keterangan = $user->keterangan;
        }

        $this->penangananOperasiId = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdatePenangananOperasi()
    {
        $this->openFormUpdate = false;
    }


    public function updatedPasien()
    {
        $getData = Pasien::findOrFail($this->pasien);
        $this->getIdPasien = $getData->id;
    }

    public function updatedStatusPasien()
    {
        if (!$this->penangananOperasiId) {
            Pasien::findOrFail($this->getIdPasien);
            $this->checkBiaya();
        }
    }

    public function updatedBiaya()
    {
        if (!is_null($this->dibayar)) {
            $this->kembalian =  $this->dibayar - $this->biaya;
        } else {
            $this->biaya;
        }
    }

    public function updatedDibayar()
    {
        $this->kembalian =  $this->dibayar - $this->biaya;
    }

    public function savePenangananOperasi()
    {

        $this->validasi();

        try {

            Operasi::create([
                'id_pasien' => $this->pasien,
                'status_pasien' => $this->status_pasien,
                'nama_operasi' => $this->nama_operasi,
                'ditangani_oleh' => $this->ditangani_oleh,
                'tanggal_operasi' => $this->tanggal_operasi,
                'dibayar' => $this->dibayar,
                'biaya' => $this->biaya,
                'kembalian' => $this->kembalian,
                'keterangan' => $this->keterangan,
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

    public function updatePenangananOperasi($id)
    {

        $this->validasi();
        $data = Operasi::findOrFail($id);

        $data->id_pasien = $this->pasien;
        $data->status_pasien = $this->status_pasien;
        $data->nama_operasi = $this->nama_operasi;
        $data->ditangani_oleh = $this->ditangani_oleh;
        $data->tanggal_operasi = $this->tanggal_operasi;
        $data->dibayar = $this->dibayar;
        $data->biaya = $this->biaya;
        $data->kembalian = $this->kembalian;
        $data->keterangan = $this->keterangan;


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


    public function deletePenangananOperasi($id)
    {
        $data = Operasi::findOrFail($id);
        $this->penangananOperasiId = $data->id;



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

        Operasi::findOrFail($this->penangananOperasiId)->delete();

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


    public function noRawat()
    {

        $no = Operasi::where('tanggal_daftar', date('ymd'))->count();
        $id = sprintf("%05s", abs($no + 1));


        return date('Y-m-d') . '-' . $id;
    }

    public function checkBiaya()
    {
        if ($this->status_pasien == 'bpjs') {
            $this->formBpjs = true;
            $this->freeBpjs = true;
            $this->biaya = 0;
            $this->dibayar = 0;
            $this->kembalian = 0;
            $this->keterangan = 'Gratis';
        } else {
            $this->formBpjs = false;
            $this->freeBpjs = false;
            $this->dibayar = null;
            $this->kembalian = null;
            $this->keterangan = null;
            $this->biaya = null;
        }
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
            'pasien' => 'required',
            'status_pasien' => 'required',
            'nama_operasi' => 'required',
            'ditangani_oleh' => 'required',
            'tanggal_operasi' => 'required',
            'dibayar' => 'required|numeric',
            'biaya' => 'required|numeric',
            'keterangan' => 'required',
        ]);
    }
}
