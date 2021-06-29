<?php

namespace App\Http\Livewire\Admin\Tindakan;

use App\Http\Livewire\Admin\TransaksiObat\Stock;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pendaftaran;
use App\Models\Poli;
use App\Models\Tindakan;
use App\Models\Diagnosa;
use App\Models\RiwayatTindakan;
use App\Models\ResepObat;
use App\Models\StokObat;
use App\Models\Rujukan;
use App\Models\JenisLaboratorium;
use App\Models\Laboratorium;

class DataBerobat extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openDataDetails, $details;
    public $dataBerobatId, $dataRiwayatTindakanId, $dataResepObatId,  $formId;

    public $nama_pasien, $no_rawat, $no_rekamedis, $id_pasien;

    //tindakan
    public $poli_tujuan, $keluhan, $pemeriksaan_fisik, $temperatur, $tinggi_badan,
        $tekanan_darah, $tekanan_nadi, $hr, $rr, $bb, $lp, $pemeriksaan_penunjang,
        $diagnosa, $nama_tindakan, $rencana_pengobatan, $hasil_periksa;


    //resep obat
    public $nama_obat, $kode_obat, $jenis_obat, $dosis, $stock_obat, $jumlah_obat;

    //rujukan
    public $nama_diagnosa, $nama_rumah_sakit, $poli_rujukan_tujuan;

    //lab
    public $data_lab;

    public $lab_keterangan = [];

    public $data_diagnosa, $data_tindakan, $data_obat, $poliId;

    public $i_lab, $i_tindakan, $i_resep_obat, $i_rujukan;


    public function render()
    {


        if ($this->openDataDetails) {
            $pasien = Pendaftaran::with('pasien', 'poli')->findOrFail($this->formId);


            $this->no_rawat = $pasien->no_rawat;
            $this->no_rekamedis = $pasien->no_rekammedis;
            $this->nama_pasien = $pasien->pasien->nama_pasien;
            $this->id_pasien = $pasien->pasien->id;




            //tindakan 
            if ($this->i_tindakan) {
                $this->poli_tujuan = $pasien->poli->nama_poli;
                $this->poliId = $pasien->poli->id;
                $this->data_diagnosa = Diagnosa::orderBy('created_at', 'DESC')->get();
              
            } else if ($this->i_resep_obat) {
                $this->data_obat = StokObat::with('obat')
                    ->orderBy('created_at', 'DESC')
                    ->get();
            } else if ($this->i_rujukan) {
                $data_rujukan = RiwayatTindakan::where('no_rawat', $this->no_rawat)
                    ->with('diagnosa')->orderBy('created_at', 'DESC')->first();

                if (is_null($data_rujukan)) {
                    $this->nama_diagnosa = 'Silahkan input tindakan terlebih dahulu';
                } else {
                    $this->nama_diagnosa = RiwayatTindakan::where('no_rawat', $this->no_rawat)->first();
                }
            } else if ($this->i_lab) {
                $this->data_lab = JenisLaboratorium::all('id', 'keterangan');
            }
        }


        $data_riwayat = RiwayatTindakan::where('no_rawat', $this->no_rawat)
            ->with('poli', 'tindakan', 'diagnosa')
            ->paginate(5);

        $data_resep_obat = ResepObat::where('no_rawat', $this->no_rawat)
            ->with('obat')
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

        return view(
            'livewire.admin.tindakan.data-berobat',
            compact('data_berobat', 'data_riwayat', 'data_resep_obat')
        )
            ->extends('layouts.app')->section('content');
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


        // $this->validateTindakan();



        try {
            $data = RiwayatTindakan::create([
                'id_poli' => $this->poliId,
                'nama_tindakan' => $this->nama_tindakan,
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

            $data->diagnosaMany()->attach($this->diagnosa);

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

    // Management data save Obat

    public function updatedNamaObat()
    {
        $data = StokObat::where('id_obat', $this->nama_obat)->with('obat')->first();
        $this->kode_obat = $data->obat->kode_obat;
        $this->jenis_obat = $data->obat->jenis_obat;
        $this->dosis = $data->obat->dosis_aturan_obat;
        $this->stock_obat = $data->jumlah;
    }


    public function saveResepObat()
    {
        $this->validateResepObat();

        try {

            ResepObat::create([
                'id_obat' => $this->nama_obat,
                'jenis_obat' => $this->jenis_obat,
                'dosis' => $this->dosis,
                'jumlah_obat' => $this->jumlah_obat,
                'no_rawat' => $this->no_rawat,
                'no_rekammedis' => $this->no_rekamedis
            ]);

            $stok = StokObat::where('id_obat', $this->nama_obat)->first();
            $stok->jumlah = $stok->jumlah - $this->jumlah_obat;

            $stok->jumlah <= 0 ? $stok->jumlah = 0 : $stok->jumlah;
            $this->reset(['nama_obat', 'jenis_obat', 'dosis', 'jumlah_obat', 'kode_obat', 'stock_obat']);
            
          

            $stok->save();



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

            $this->i_resep_obat = false;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function saveRujukan()
    {
        $this->validateRujukan();

        try {
            Rujukan::create([
                'no_rujukan' => $this->noRujukan(),
                'id_pasien' => $this->id_pasien,
                'nama_penyakit' => '-',
                'nama_rumah_sakit' => $this->nama_rumah_sakit,
                'poli_tujuan' => $this->poli_rujukan_tujuan,
                'tanggal_rujukan' => date('Y-m-d'),
                'no_rawat' => $this->no_rawat,
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

            $this->i_rujukan = false;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function saveRujukanLab()
    {
        $find = Laboratorium::where('no_rawat', $this->no_rawat)->first();
        if (is_null($find)) {
            $lab = Laboratorium::create([
                'id_pasien' => $this->id_pasien,
                'no_rawat' => $this->no_rawat,
                'no_rekammedis' => $this->no_rekamedis,
            ]);

            $lab->jenis_laboratorium()->attach($this->lab_keterangan);
        } else {
            $find->jenis_laboratorium()->sync($this->lab_keterangan);
        }



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

        $this->i_lab = false;
        $this->resetForm();
    }

    public function deleteDataResepObat($id)
    {
        $data = ResepObat::findOrFail($id);
        $this->dataResepObatId = $data->id;
        $this->triggerConfirm();
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
        } elseif ($this->dataResepObatId) {
            ResepObat::findOrFail($this->dataResepObatId)->delete();
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


    public function noRujukan()
    {



        $no = Rujukan::where('tanggal_rujukan', date('ymd'))->count();
        $id = sprintf("%05s", abs($no + 1));


        return 'R-' . date('Ymd') . '-' . $id;
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

    public function validateResepObat()
    {
        return $this->validate([
            'nama_obat' => 'required',
            'jenis_obat' => 'required',
            'dosis' => 'required',
            'jumlah_obat' => 'required|numeric'
        ]);
    }

    public function validateRujukan()
    {
        return $this->validate([
            'nama_rumah_sakit' => 'required',
            'poli_rujukan_tujuan' => 'required'
        ]);
    }
}
