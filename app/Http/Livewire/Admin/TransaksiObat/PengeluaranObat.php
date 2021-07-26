<?php

namespace App\Http\Livewire\Admin\TransaksiObat;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\PengeluaranObat as PengeluaranObats;
use App\Models\StokObat;

class PengeluaranObat extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate, $details, $showObat;
    public $data_pasien, $data_obat, $pengeluaranObatId;

    public $nama_pasien, $obat, $kode_obat, $jenis_obat, $satuan, $dosis,
        $jumlah, $tanggal_serah_obat, $keterangan;

    public function render()
    {

        $this->data_pasien = Pasien::orderBy('created_at', 'DESC')->get();
        $this->data_obat = Obat::orderBy('created_at', 'DESC')->get();

        if ($this->search) {
            $pengeluaran_obat = PengeluaranObats::whereHas('pasien', function ($q) {
                $q->where('nama_pasien', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('no_terima_obat', 'LIKE', '%' . $this->search . '%');
            })->orWhereHas('obat', function ($x) {
                $x->where('nama_obat', 'LIKE', '%' . $this->search . '%');
            })
                ->with('pasien', 'obat')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $pengeluaran_obat = PengeluaranObats::with('pasien', 'obat')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }


        return view('livewire.admin.transaksi-obat.pengeluaran-obat', compact('pengeluaran_obat'))->extends('layouts.app')->section('content');
    }

    public function openFormCreatePengeluaranObat()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreatePengeluaranObat()
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

    public function openDetailObat()
    {
        $this->showObat = true;
    }

    public function closeDetailObat()
    {
        $this->showObat = false;
    }

    public function openFormUpdatePengeluaranObat($id)
    {
        $user = PengeluaranObats::findOrFail($id);

        $this->nama_pasien = $user->id_pasien;
        $this->obat = $user->id_obat;
        $this->jumlah = $user->jumlah;
        $this->keterangan = $user->keterangan;



        $this->pengeluaranObatId = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdatePengeluaranObat()
    {
        $this->openFormUpdate = false;
    }


    public function updatedObat()
    {
        $getData = Obat::findOrFail($this->obat);
        $this->dosis = $getData->dosis_aturan_obat;
        $this->kode_obat = $getData->kode_obat;
        $this->jenis_obat = $getData->jenis_obat;
        $this->satuan = $getData->satuan;
    }

    public function savePengeluaranObat()
    {

        $this->validasi();

        try {

            PengeluaranObats::create([
                'no_terima_obat' => $this->noPengeluaran(),
                'id_pasien' => $this->nama_pasien,
                'id_obat' => $this->obat,
                'jumlah' => $this->jumlah,
                'tanggal_serah_obat' => date('Ymd'),
                'keterangan' => !is_null($this->keterangan) ? $this->keterangan : '-',
            ]);

            $data = StokObat::where('id_obat', $this->obat)->first();
            $data->jumlah = $data->jumlah - $this->jumlah;

            $data->save();


            $this->alert('success', 'Succesfully create pengeluaran obat', [
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

    public function updatePengeluaranObat($id)
    {

        $this->validasi();
        $data = PengeluaranObats::findOrFail($id);
        $stok =  StokObat::where('id_obat', $this->obat)->first();



        if ($data->jumlah != $this->jumlah) {
            $stok->jumlah = $stok->jumlah - $this->jumlah + $data->jumlah;
        } else {
            $stok->jumlah = $data->jumlah;
        }


        $stok->save();

        $data->id_pasien = $this->nama_pasien;
        $data->id_obat = $this->obat;
        $data->jumlah = $this->jumlah;
        $data->keterangan = $this->keterangan;


        $data->save();


        $this->alert('success', 'Succesfully update pengeluaran obat', [
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


    public function deletePengeluaranObat($id)
    {
        $data = PengeluaranObats::findOrFail($id);
        $this->pengeluaranObatId = $data->id;



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

        PengeluaranObats::findOrFail($this->pengeluaranObatId)->delete();

        $this->alert('success', 'Succesfully delete pengeluaran obat', [
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


    public function noPengeluaran()
    {

        $no = PengeluaranObats::where('tanggal_serah_obat', date('ymd'))->count() + 1;
        $id = sprintf("%05s", abs($no + 1));


        return 'S-' . date('ymd') . '-' . $id;
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
            'nama_pasien' => 'required',
            'obat' => 'required',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|min:4'
        ]);
    }
}
