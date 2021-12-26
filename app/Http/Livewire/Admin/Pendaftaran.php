<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Poli;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Pendaftaran as ModelsPendaftaran;

class Pendaftaran extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['confirmed'];

    public $search, $from, $to;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate, $details, $showDataPasien, $printPendaftaran;
    public $data_dokter, $data_poli, $data_pasien, $pendaftaranId, $dataPrint, $dataPrintPoli;

    public $no_rawat, $dokter, $poli, $no_rekamedis, $pasien, $no_kk, $tanggal_lahir,
        $nama_penanggung_jawab, $status_pasien, $no_jaminan, $wilayah, $alamat,
        $alamat_penanggung_jawab, $hubungan, $no_antrian;

    public function render()
    {

        $this->data_dokter = Dokter::orderBy('created_at', 'DESC')->get();
        $this->data_poli = Poli::orderBy('created_at', 'DESC')->get();
        $this->data_pasien = Pasien::orderBy('created_at', 'DESC')->get();


        // is_null($this->pendaftaranId) ?  $this->no_rawat = $this->noRawat() : null;


        if ($this->search) {
            $pendaftarans = ModelsPendaftaran::whereHas('pasien', function ($q) {
                $q->where('nama_pasien', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('no_rawat', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('no_rekammedis', 'LIKE', '%' . $this->search . '%');
            })
                ->with('pasien', 'poli:id,nama_poli', 'dokter:id,nama_dokter')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }else if(!is_null($this->from) && !is_null($this->to)){
            if (!is_null($this->search)) {
                $pendaftarans = ModelsPendaftaran::whereHas('pasien', function ($q) {
                    $q->where('nama_pasien', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('no_rawat', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('no_rekammedis', 'LIKE', '%' . $this->search . '%');
                })
                    ->whereRaw(
                        "(created_at >= ? AND created_at <= ?)",
                        [$this->from." 00:00:00", $this->to." 23:59:59"])
                        ->with('pasien', 'poli:id,nama_poli', 'dokter:id,nama_dokter')
                        ->orderBy('created_at', 'DESC')
                        ->paginate($this->rows);
            }else{
                $pendaftarans =  ModelsPendaftaran::whereRaw(
                    "(created_at >= ? AND created_at <= ?)",
                    [$this->from." 00:00:00", $this->to." 23:59:59"])
                    ->with('pasien', 'poli:id,nama_poli', 'dokter:id,nama_dokter')
                    ->orderBy('created_at', 'DESC')
                    ->paginate($this->rows);
            }
        }else {
            $pendaftarans = ModelsPendaftaran::with('pasien', 'poli:id,nama_poli', 'dokter:id,nama_dokter')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }


        return view('livewire.admin.pendaftaran', compact('pendaftarans'))->extends('layouts.app')->section('content');
    }

    public function openFormCreatePendaftaran()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreatePendaftaran()
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

    public function openFormUpdatePendaftaran($id)
    {
        $user = ModelsPendaftaran::findOrFail($id);

        // $this->no_rawat = $user->no_rawat;
        $this->dokter = $user->id_dokter;
        $this->poli = $user->id_poli;
        $this->pasien = $user->id_pasien;
        $this->nama_penanggung_jawab = $user->nama_penanggung_jawab;
        $this->hubungan = $user->hubungan_dengan_penanggung_jawab;
        $this->alamat = $user->alamat;
        $this->nama_penanggung_jawab = $user->nama_penanggung_jawab;
        $this->hubungan = $user->hubungan_dengan_penanggung_jawab;

        $this->pendaftaranId = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdatePendaftaran()
    {
        $this->openFormUpdate = false;
    }


    public function updatedPasien()
    {
        $getData = Pasien::findOrFail($this->pasien);
        $this->no_kk = $getData->no_kk;
        $this->tanggal_lahir = $getData->tanggal_lahir;
        $this->status_pasien = $getData->status_pasien;
        $this->no_jaminan = $getData->no_jaminan;
        $this->wilayah = $getData->wilayah;
        $this->alamat = $getData->alamat;
        $this->no_rekamedis = $getData->kode_paramedis;
        $this->hubungan = $getData->hubungan_dengan_penanggung_jawab;
        $this->nama_penanggung_jawab = $getData->nama_penanggung_jawab;
        $this->no_antrian = $getData->no_antrian;
    }

    public function savePendaftaran()
    {

        $this->validasi();

        try {

            ModelsPendaftaran::create([
                'no_rawat' => $this->noRawat(),
                'no_rekammedis' => $this->no_rekamedis,
                'tanggal_daftar' => date('Y-m-d'),
                'id_dokter' => $this->dokter,
                'id_poli' => $this->poli,
                'id_pasien' => $this->pasien,
                'status_pasien' => $this->status_pasien,
                'no_jaminan' => $this->no_jaminan
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

    public function updatePendaftaran($id)
    {

        $this->validasi();
        $data = ModelsPendaftaran::findOrFail($id);


        // $data->no_rawat = $this->no_rawat;
        $data->id_dokter = $this->dokter;
        $data->id_poli = $this->poli;
        $data->id_pasien = $this->pasien;



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


    public function deletePendaftaran($id)
    {
        $data = ModelsPendaftaran::findOrFail($id);
        $this->pendaftaranId = $data->id;



        $this->triggerConfirm();
    }

    public function printStructPendaftaran($id)
    {
        $this->printPendaftaran = true;
        $this->dataPrint = Pasien::where('id', $id)->first();
        $this->dataPrintPoli = ModelsPendaftaran::with('poli')->where('id_pasien', $id)->first('id_poli');

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

        ModelsPendaftaran::findOrFail($this->pendaftaranId)->delete();

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

        $no = ModelsPendaftaran::where('tanggal_daftar', date('ymd'))->count();
        $id = sprintf("%05s", abs($no + 1));


        return date('Ymd') . $id;
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
            'dokter' => 'required',
            'poli' => 'required',
            'pasien' => 'required',
            'hubungan' => 'required',
        ]);
    }
}
