<?php

namespace App\Http\Livewire\Admin\MasterData;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pasien as Pasiens;
use App\Models\Jaminan;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Pasien extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate, $details, $openForm;
    public $data_jaminan, $pasienId;
    public $printPage, $dataPrintWithId, $getLastNoAntrian;

    public $no_rekamedis, $nama_pasien, $jenis_kelamin, $jenis_kelamin_kk, $no_ktp, $no_kk,
        $no_antrian, $jaminan, $no_jaminan, $tanggal_lahir, $alamat,
        $wilayah, $status_pasien, $keterangan, $nama_faskes, $hubungan, $nama_kk, $tanggal_lahir_kk;

    public $searchRekammedis, $data_rekammedis, $cari_rekammedis;
    public $from, $to;

    public function render()
    {

        $this->data_jaminan = Jaminan::orderBy('created_at', 'DESC')->get();
        if ($this->search) {
            $pasiens = Pasiens::where('nama_pasien', 'LIKE', '%' . $this->search . '%')
                ->orWhere('kode_paramedis', 'LIKE', '%' . $this->search . '%')
                ->orWhere('nama_kk', 'LIKE', '%' . $this->search . '%')
                ->with('jaminan')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);

        }else if(!is_null($this->from) && !is_null($this->to)){
            $pasiens = Pasiens::whereRaw(
                "(created_at >= ? AND created_at <= ?)",
                [$this->from." 00:00:00", $this->to." 23:59:59"])
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

        $p = Pasiens::orderBy('created_at', 'DESC')->pluck('no_antrian')->first();
        $data = (int) substr($p, 1) + 1;
        $res = substr($p, 0, 1);
        $this->no_antrian =  $res . $data;
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

    public function openFormSearchRekammedis()
    {
        $this->data_rekammedis = Pasiens::distinct()->select('kode_paramedis', 'nama_kk')->orderBy('created_at', 'DESC')->get();
        $this->searchRekammedis = true;
    }

    public function closeFormSearchRekammedis()
    {
        $this->searchRekammedis = false;
    }

    public function updatedCariRekammedis($id){

        if ($this->cari_rekammedis == 'kosong') {
            $this->no_kk = null;
            $this->alamat = null;
            $this->nama_kk = '';
            $this->hubungan = null;
            $this->jenis_kelamin_kk = null;
            $this->tanggal_lahir_kk = null;
            $this->wilayah = null;
            $this->nama_faskes = null;
            $this->kode_paramedis = null;
        }else{
            $data = Pasiens::where('kode_paramedis', $id)->first();
            $this->no_kk = $data->no_kk;
            $this->alamat = $data->alamat;
            $this->nama_kk = $data->nama_kk;
            $this->hubungan = $data->hubungan_dengan_penanggung_jawab;
            $this->jenis_kelamin_kk = $data->jenis_kelamin_kk;
            $this->tanggal_lahir_kk = $data->tanggal_lahir_kk;
            $this->wilayah = $data->wilayah;
            $this->nama_faskes = $data->nama_faskes;
            $this->no_rekamedis = $data->kode_paramedis;

        }

    }

    public function openFormUpdatePasien($id)
    {
        $user = Pasiens::findOrFail($id);

        $this->no_rekamedis = $user->kode_paramedis;
        $this->nama_pasien = $user->nama_pasien;
        $this->jenis_kelamin = $user->jenis_kelamin;
        $this->jenis_kelamin_kk = $user->jenis_kelamin_kk;
        $this->no_kk = $user->no_kk;
        $this->no_ktp = $user->no_ktp;
        $this->no_antrian = $user->no_antrian;
        $this->jaminan = $user->id_jaminan;
        $this->no_jaminan = $user->no_jaminan;
        $this->tanggal_lahir = $user->tanggal_lahir;
        $this->alamat = $user->alamat;
        $this->wilayah = $user->wilayah;
        $this->keterangan = $user->keterangan;
        $this->nama_faskes = $user->nama_faskes;
        $this->hubungan = $user->hubungan_dengan_penanggung_jawab;
        $this->nama_kk = $user->nama_kk;
        $this->tanggal_lahir_kk = $user->tanggal_lahir_kk;

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
                'kode_paramedis' =>  is_null($this->no_rekamedis) || $this->cari_rekammedis == 'kosong'
                                    ? $this->getNameRekamMedis()
                                    : $this->no_rekamedis,
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
                'nama_faskes' => $this->nama_faskes,
                'nama_kk' => $this->nama_kk,
                'tanggal_lahir_kk' => $this->tanggal_lahir_kk,
                'jenis_kelamin_kk' => $this->jenis_kelamin_kk
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
        $data->nama_faskes = $this->nama_faskes;
        $data->hubungan_dengan_penanggung_jawab = $this->hubungan;
        $data->nama_kk = $this->nama_kk;
        $data->tanggal_lahir_kk = $this->tanggal_lahir_kk;
        $data->jenis_kelamin_kk = $this->jenis_kelamin_kk;

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

    public function getNameRekamMedis()
    {
        // $words = explode(" ", $this->nama_kk);
        // $name = "";

        // foreach ($words as $w) {
        //     $name .= $w[0];
        // }

        // $date = date('dmY', strtotime($this->tanggal_lahir_kk));
        $p = Pasiens::distinct()
        ->where('kode_paramedis', 'LIKE', substr($this->nama_kk, 0, 1) . '%')
        ->orderBy('created_at', 'DESC')
        ->pluck('kode_paramedis')
        ->first();

        $data = substr($p, 1, 10);
        $res = $data + 1;

        return ucwords(substr($this->nama_kk, 0, 1)) . $res;
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
            // 'no_rekamedis' => 'required',
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
            'nama_faskes' => 'required',
            'hubungan' => 'required',
            'nama_kk' => 'required',
            'tanggal_lahir_kk' => 'required',
            'jenis_kelamin_kk' => 'required'

        ]);
    }
}
