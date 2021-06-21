<?php

namespace App\Http\Livewire\Admin\Tindakan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pendaftaran;
use App\Models\Poli;
use App\Models\Tindakan;
use App\Models\Diagnosa;
use App\Models\RiwayatTindakan;

class DataBerobat extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openDataDetails, $details;
    public $dataBerobatId, $dataRiwayatTindakanId, $formId;

    public $nama_pasien, $no_rawat, $no_rekamedis;

    //tindakan
    public $poli_tujuan, $keluhan, $pemeriksaan_fisik, $temperatur, $tinggi_badan,
        $tekanan_darah, $tekanan_nadi, $hr, $rr, $bb, $lp, $pemeriksaan_penunjang,
        $diagnosa, $nama_tindakan, $rencana_pengobatan, $hasil_periksa;

    public $data_diagnosa, $data_tindakan, $poliId;

    public $i_lab, $i_tindakan, $i_resep_obat, $i_rujukan;

    public function render()
    {


        if ($this->openDataDetails) {
            $pasien = Pendaftaran::with('pasien', 'poli')->findOrFail($this->formId);


            $this->no_rawat = $pasien->no_rawat;
            $this->no_rekamedis = $pasien->no_rekammedis;
            $this->nama_pasien = $pasien->pasien->nama_pasien;




            //tindakan 
            if ($this->i_tindakan) {
                $this->poli_tujuan = $pasien->poli->nama_poli;
                $this->poliId = $pasien->poli->id;
                $this->data_diagnosa = Diagnosa::orderBy('created_at', 'DESC')->get();
                $this->data_tindakan = Tindakan::orderBy('created_at', 'DESC')->get();
            }
        }


        $data_riwayat = RiwayatTindakan::where('no_rawat', $this->no_rawat)
            ->with('poli', 'tindakan', 'diagnosa')
            ->paginate(5);

        if ($this->search) {
            $data_berobat = Pendaftaran::whereHas('pasien', function ($q) {
                $q->where('nama_pasien', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('no_rawat', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('no_rekammedis', 'LIKE', '%' . $this->search . '%');
            })
                ->with('pasien', 'poli:id,nama_poli', 'dokter:id,nama_dokter')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $data_berobat = Pendaftaran::with('pasien', 'poli:id,nama_poli', 'dokter:id,nama_dokter')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }

        return view('livewire.admin.tindakan.data-berobat', compact('data_berobat', 'data_riwayat'))->extends('layouts.app')->section('content');
    }

    public function openDetails()
    {
        $this->details = true;
    }
    public function closeDetails()
    {
        $this->details = false;
    }

    public function openFormDetails($id)
    {
        $pasien = Pendaftaran::findOrFail($id);
        $this->formId = $pasien->id;
        $this->openDataDetails = true;
    }

    public function openFormInputRujukanLab()
    {
        $this->i_lab = true;
        $this->i_tindakan = false;
        $this->i_resep_obat = false;
        $this->i_rujukan = false;
    }

    public function openFormInputTindakan()
    {
        $this->i_tindakan = true;
        $this->i_lab = false;
        $this->i_resep_obat = false;
        $this->i_rujukan = false;
    }

    public function openFormInputResepObat()
    {
        $this->i_resep_obat = true;
        $this->i_tindakan = false;
        $this->i_lab = false;
        $this->i_rujukan = false;
    }

    public function openFormInputRujujan()
    {
        $this->i_rujukan = true;
        $this->i_tindakan = false;
        $this->i_resep_obat = false;
        $this->i_lab = false;
    }

    public function saveTindakan()
    {
        $this->validateTindakan();

        try {
            RiwayatTindakan::create([
                'id_poli' => $this->poliId,
                'id_diagnosa' => $this->diagnosa,
                'id_tindakan' => $this->nama_tindakan,
                'no_rawat' => $this->no_rawat,
                'hasil_periksa' => $this->hasil_periksa,
                'keluhan' => $this->keluhan,
                'cek_fisik' => $this->pemeriksaan_fisik,
                'temperatur' => !empty($this->temperatur) ? $this->temperatur : '-',
                'tekanan_darah' => !empty($this->tekanan_darah) ? $this->tekanan_darah : '-',
                'tekanan_nadi' => !empty($this->tekanan_nadi) ? $this->tekanan_nadi : '-',
                'tinggi_badan' => !empty($this->tinggi_badan) ? $this->tinggi_badan : '-',
                'hr' => !empty($this->hr) ? $this->hr : 0,
                'rr' => !empty($this->rr) ? $this->rr : 0,
                'bb' => !empty($this->bb) ? $this->bb : 0,
                'lp' => !empty($this->lp) ? $this->lp : 0,
                'penunjang' => $this->pemeriksaan_penunjang,
                'no_rekamedis' => $this->no_rekamedis,
                'rencana_pengobatan' => $this->rencana_pengobatan
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

            $this->i_tindakan = false;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function deleteDataRiwayatTindakan($id)
    {
        $data = RiwayatTindakan::findOrFail($id);
        $this->dataRiwayatTindakanId = $data->id;
        $this->triggerConfirm();
    }


    public function deleteDataBerobat($id)
    {
        $data = Pendaftaran::findOrFail($id);
        $this->dataBerobatId = $data->id;

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

        if ($this->dataRiwayatTindakanId) {
            RiwayatTindakan::findOrFail($this->dataRiwayatTindakanId)->delete();
        } else {
            Pendaftaran::findOrFail($this->dataBerobatId)->delete();
        }

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
        return $this->validate([
            'dokter' => 'required',
            'poli' => 'required',
            'pasien' => 'required',
            'nama_penanggung_jawab' => 'required|min:4',
            'hubungan' => 'required',
            'alamat_penanggung_jawab' => 'required'
        ]);
    }


    public function validateTindakan()
    {
        return $this->validate([
            'keluhan' => 'required',
            'pemeriksaan_fisik' => 'required',
            'temperatur' => 'nullable|',
            'tinggi_badan' => 'nullable|numeric',
            'tekanan_darah' => 'nullable',
            'tekanan_nadi' => 'nullable',
            'hr' => 'nullable',
            'rr' => 'nullable',
            'bb' => 'nullable',
            'lp' => 'nullable',
            'pemeriksaan_penunjang' => 'required',
            'diagnosa' => 'required',
            'nama_tindakan' => 'required',
            'rencana_pengobatan' => 'required'
        ]);
    }
}
