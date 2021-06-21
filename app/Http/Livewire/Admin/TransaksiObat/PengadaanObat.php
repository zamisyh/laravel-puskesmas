<?php

namespace App\Http\Livewire\Admin\TransaksiObat;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PengadaanObat as PengadaanObats;
use App\Models\Supplier;
use App\Models\Obat;
use Carbon\Carbon;

class PengadaanObat extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate, $details, $showObat;
    public $data_supplier, $data_obat, $pengadaanObatId;

    public $supplier, $obat, $kode_obat, $jenis_obat, $satuan,
        $harga_beli, $jumlah, $total, $keterangan;

    public function render()
    {
        $this->data_supplier = Supplier::orderBy('created_at', 'DESC')->get();
        $this->data_obat = Obat::orderBy('created_at', 'DESC')->get();

        if ($this->search) {
            $pengadaan_obat = PengadaanObats::whereHas('supplier', function ($q) {
                $q->where('no_trans', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('nama', 'LIKE', '%' . $this->search . '%');
            })->orWhereHas('obat', function ($x) {
                $x->where('nama_obat', 'LIKE', '%' . $this->search . '%');
            })
                ->with('supplier', 'obat')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $pengadaan_obat = PengadaanObats::with('supplier', 'obat')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }

        return view('livewire.admin.transaksi-obat.pengadaan-obat', compact('pengadaan_obat'))->extends('layouts.app')->section('content');
    }

    public function openFormCreatePengadaanObat()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreatePengadaanObat()
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

    public function openFormUpdatePengadaanObat($id)
    {
        $user = PengadaanObats::findOrFail($id);
        $this->supplier = $user->id_supplier;
        $this->obat = $user->id_obat;
        $this->harga_beli = $user->harga_beli;
        $this->jumlah = $user->jumlah;
        $this->total = $user->total;
        $this->keterangan = $user->keterangan;



        $this->pengadaanObatId = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdatePengadaanObat()
    {
        $this->openFormUpdate = false;
    }


    public function updatedObat()
    {
        $getData = Obat::findOrFail($this->obat);
        $this->kode_obat = $getData->kode_obat;
        $this->jenis_obat = $getData->jenis_obat;
        $this->satuan = $getData->satuan;
    }

    public function updatedHargaBeli()
    {
        if (!is_null($this->jumlah)) {
            $this->total = number_format($this->harga_beli * $this->jumlah);
        } else {
            $this->harga_beli;
        }
    }

    public function updatedJumlah()
    {
        $count = number_format($this->harga_beli * $this->jumlah);
        $this->total = $count;
    }

    public function savePengadaanObat()
    {

        $this->validasi();

        try {

            PengadaanObats::create([
                'no_trans' => $this->noTrans(),
                'id_supplier' => $this->supplier,
                'id_obat' => $this->obat,
                'harga_beli' => $this->harga_beli,
                'jumlah' => $this->jumlah,
                'total' => $this->total,
                'keterangan' => !is_null($this->keterangan) ? $this->keterangan : '-',
                'tanggal_transaksi' => date('Ymd'),

            ]);


            $this->alert('success', 'Succesfully create pengadaan obat', [
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

    public function updatePengadaanObat($id)
    {

        $this->validasi();
        $data = PengadaanObats::findOrFail($id);

        $data->id_obat = $this->obat;
        $data->harga_beli = $this->harga_beli;
        $data->jumlah = $this->jumlah;
        $data->total = $this->total;
        $data->keterangan = $this->keterangan;


        $data->save();

        $this->alert('success', 'Succesfully update pengadaan obat', [
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


    public function deletePengadaanObat($id)
    {
        $data = PengadaanObats::findOrFail($id);
        $this->pengadaanObatId = $data->id;



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

        PengadaanObats::findOrFail($this->pengadaanObatId)->delete();

        $this->alert('success', 'Succesfully delete pengadaan obat', [
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


    public function noTrans()
    {

        $no = PengadaanObats::where('tanggal_transaksi', date('ymd'))->count() + 1;
        $id = sprintf("%05s", abs($no + 1));


        return 'B-' . date('ymd') . '-' . $id;
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
            'supplier' => 'required',
            'obat' => 'required',
            'harga_beli' => 'required|numeric',
            'jumlah' => 'required|numeric',

        ]);
    }
}
