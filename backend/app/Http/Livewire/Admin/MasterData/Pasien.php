<?php

namespace App\Http\Livewire\Admin\MasterData;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pasien as Pasiens;
use App\Models\Jaminan;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Carbon;

class Pasien extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate, $details, $openForm;
    public $data_jaminan, $pasienId;
    public $printPage, $dataPrintWithId;

    public $no_rekamedis, $nama_pasien, $jenis_kelamin, $no_ktp, $no_kk,
        $no_antrian, $jaminan, $no_jaminan, $tanggal_lahir, $alamat,
        $wilayah, $status_pasien, $keterangan, $nama_penanggung_jawab, $hubungan, $nama_kk;

    public function render()
    {

        $this->data_jaminan = Jaminan::orderBy('created_at', 'DESC')->get();

        if ($this->search) {
            $pasiens = Pasiens::where('nama_pasien', 'LIKE', '%' . $this->search . '%')
                ->orWhere('kode_paramedis', 'LIKE', '%' . $this->search . '%')
                ->with('jaminan')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $pasiens = Pasiens::orderBy('created_at', 'DESC')
                ->with('jaminan')
                ->paginate($this->rows);
        }

        return view('livewire.admin.master-data.pasien', compact('pasiens'))->extends('layouts.app')->section('content');
    }

    public function openFormCreatePasien()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreatePasien()
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
    public function openLoadForm()
    {
        $this->openForm = true;
    }

    public function openFormUpdatePasien($id)
    {
        $user = Pasiens::findOrFail($id);

        $this->no_rekamedis = $user->kode_paramedis;
        $this->nama_pasien = $user->nama_pasien;
        $this->jenis_kelamin = $user->jenis_kelamin;
        $this->no_kk = $user->no_kk;
        $this->no_ktp = $user->no_ktp;
        $this->no_antrian = $user->no_antrian;
        $this->jaminan = $user->id_jaminan;
        $this->no_jaminan = $user->no_jaminan;
        $this->tanggal_lahir = $user->tanggal_lahir;
        $this->alamat = $user->alamat;
        $this->wilayah = $user->wilayah;
        $this->keterangan = $user->keterangan;
        $this->nama_penanggung_jawab = $user->nama_penanggung_jawab;
        $this->hubungan = $user->hubungan_dengan_penanggung_jawab;
        $this->nama_kk = $user->nama_kk;

        $this->pasienId = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdatePasien()
    {
        $this->openFormUpdate = false;
    }

    public function savePasien()
    {
        $this->validasi();

        $findJaminan = Jaminan::findOrFail($this->jaminan);
        $age = \Carbon\Carbon::parse($this->tanggal_lahir)->age;


        try {

            Pasiens::create([
                'kode_paramedis' => strtoupper($this->no_rekamedis),
                'nama_pasien' => $this->nama_pasien,
                'jenis_kelamin' => $this->jenis_kelamin,
                'no_kk' => $this->no_kk,
                'no_ktp' => !empty($this->no_ktp) ? $this->no_ktp : '-',
                'no_antrian' => !empty($this->no_antrian) ? $this->no_antrian : '-',
                'id_jaminan' => $this->jaminan,
                'keterangan' => !empty($this->keterangan) ? $this->keterangan : '-',
                'no_jaminan' => $this->no_jaminan,
                'tanggal_lahir' => $this->tanggal_lahir,
                'alamat' => $this->alamat,
                'wilayah' => $this->wilayah,
                'status_pasien' => $findJaminan->nama_jaminan,
                'usia' => $age,
                'hubungan_dengan_penanggung_jawab' => $this->hubungan,
                'nama_penanggung_jawab' => $this->nama_penanggung_jawab,
                'nama_kk' => $this->nama_kk
            ]);


            $this->alert('success', 'Succesfully create pasien', [
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

    public function updatePasien($id)
    {

        $this->validasi();
        $data = Pasiens::findOrFail($id);

        $findJaminan = Jaminan::findOrFail($this->jaminan);


        $data->kode_paramedis = $this->no_rekamedis;
        $data->nama_pasien = $this->nama_pasien;
        $data->jenis_kelamin = $this->jenis_kelamin;
        $data->no_kk = $this->no_kk;
        $data->no_ktp = $this->no_ktp;
        $data->no_antrian = $this->no_antrian;
        $data->id_jaminan = $this->jaminan;
        $data->no_jaminan = $this->no_jaminan;
        $data->tanggal_lahir = $this->tanggal_lahir;
        $data->alamat = $this->alamat;
        $data->status_pasien = $findJaminan->nama_jaminan;
        $data->wilayah = $this->wilayah;
        $data->usia = \Carbon\Carbon::parse($this->tanggal_lahir)->age;
        $data->keterangan = $this->keterangan;
        $data->nama_penanggung_jawab = $this->nama_penanggung_jawab;
        $data->hubungan_dengan_penanggung_jawab = $this->hubungan;
        $data->nama_kk = $this->nama_kk;

        $data->save();

        $this->alert('success', 'Succesfully update pasien', [
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

    public function printStrukAntrian($id)
    {
        $this->dataPrintWithId = Pasiens::where('id', $id)->get();
        $this->printPage = true;
    }


    public function deletePasien($id)
    {
        $data = Pasiens::findOrFail($id);
        $this->pasienId = $data->id;

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

        Pasiens::findOrFail($this->pasienId)->delete();

        $this->alert('success', 'Succesfully delete pasien', [
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


    public function noIzinPasien()
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
            'no_rekamedis' => 'required',
            'nama_pasien' => 'required|min:4',
            'jenis_kelamin' => 'required',
            'no_kk' => 'required|numeric',
            'no_ktp' => 'nullable|numeric',
            'no_antrian' => 'nullable',
            'keterangan' => 'nullable',
            'jaminan' => 'required',
            'no_jaminan' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'wilayah' => 'required',
            'nama_penanggung_jawab' => 'required',
            'hubungan' => 'required',
            'nama_kk' => 'required'

        ]);
    }
}
