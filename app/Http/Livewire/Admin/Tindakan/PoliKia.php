<?php

namespace App\Http\Livewire\Admin\Tindakan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\KesehatanIbuAnak as PoliKias;
use App\Models\Pasien;

class PoliKia extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate, $details, $showDataPasien;
    public $data_pasien, $poliKiaId;

    public $pasien, $no_bpjs, $nama_tindakan, $status_pasien, $biaya, $kembalian,
        $dibayar, $keterangan, $ditangani_oleh, $tanggal_tindakan;

    public $getIdPasien, $formBpjs, $freeBpjs, $no_kia;

    public function render()
    {

        $this->data_pasien = Pasien::orderBy('created_at', 'DESC')->get();
        $this->no_kia = $this->noKia();

        if ($this->search) {
            $poli_kia = PoliKias::whereHas('pasien', function ($q) {
                $q->where('nama_pasien', 'LIKE', '%' . $this->search . '%');
            })->orWhere('status_pasien', 'LIKE', '%' . $this->search . '%')
                ->orWhere('no_kia',  'LIKE', '%' . $this->search . '%')
                ->with('pasien')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $poli_kia = PoliKias::with('pasien')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }


        return view('livewire.admin.tindakan.poli-kia', compact('poli_kia'))->extends('layouts.app')->section('content');
    }


    public function openFormCreatePoliKia()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreatePoliKia()
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

    public function openFormUpdatePoliKia($id)
    {
        $user = PoliKias::findOrFail($id);

        $this->pasien = $user->id_pasien;
        $this->status_pasien = $user->status_pasien;
        $this->nama_tindakan = $user->nama_tindakan;
        $this->ditangani_oleh = $user->ditangani_oleh;
        $this->tanggal_tindakan = $user->tanggal_tindakan;

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

        $this->poliKiaId

            = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdatePoliKia()
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
        if (!$this->poliKiaId) {
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

    public function savePoliKia()
    {

        $this->validasi();

        try {

            PoliKias::create([
                'id_pasien' => $this->pasien,
                'no_kia' => $this->noKia(),
                'no_bpjs' => !is_null($this->no_bpjs) ? $this->no_bpjs : '-',
                'status_pasien' => $this->status_pasien,
                'nama_tindakan' => $this->nama_tindakan,
                'ditangani_oleh' => $this->ditangani_oleh,
                'tanggal_tindakan' => $this->tanggal_tindakan,
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

    public function updatePoliKia($id)
    {

        $this->validasi();
        $data = PoliKias::findOrFail($id);

        $data->id_pasien = $this->pasien;
        $data->status_pasien = $this->status_pasien;
        $data->nama_tindakan = $this->nama_tindakan;
        $data->ditangani_oleh = $this->ditangani_oleh;
        $data->tanggal_tindakan = $this->tanggal_tindakan;
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


    public function deletePoliKia($id)
    {
        $data = PoliKias::findOrFail($id);
        $this->poliKiaId

            = $data->id;



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

        PoliKias::findOrFail($this->poliKiaId)

            ->delete();

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


    public function noKia()
    {

        $no = PoliKias::where('tanggal_tindakan', date('ymd'))->count() + 1;
        $id = sprintf("%05s", abs($no + 1));


        return 'K-' . date('Ymd') . '-' . $id;
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
            'no_bpjs' => 'nullable|min:4',
            'status_pasien' => 'required',
            'nama_tindakan' => 'required',
            'ditangani_oleh' => 'required',
            'tanggal_tindakan' => 'required',
            'dibayar' => 'required|numeric',
            'biaya' => 'required|numeric',
            'keterangan' => 'required',
        ]);
    }
}
