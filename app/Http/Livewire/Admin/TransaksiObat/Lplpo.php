<?php

namespace App\Http\Livewire\Admin\TransaksiObat;

use App\Models\lplpo as ModelsLplpo;
use Livewire\Component;
use App\Models\Obat;
use App\Models\PengadaanObat;
use App\Models\PengeluaranObat;
use Livewire\WithPagination;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LplpoExport;


class Lplpo extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search, $rows = 5;
    public $openFormUpdate, $getDataObat, $openDetailObat, $id_obat;
    public $nama_obat, $satuan, $stock_awal, $penerimaan, $persediaan, $pemakaian, $rusak,
        $recal, $stok_akhir, $rko, $stok_opt, $permintaan, $pemberian, $ket, $jenis_obat,
        $dosis, $kode_obat;

    public function render()
    {
        if ($this->search) {
            $obats = Obat::where('nama_obat', 'LIKE', '%' . $this->search . '%')
                ->orderBy('created_at', 'DESC')->paginate($this->rows);
        } else {
            $obats = Obat::orderBy('created_at', 'DESC')->paginate($this->rows);
        }

        return view('livewire.admin.transaksi-obat.lplpo', compact('obats'))->extends('layouts.app')->section('content');
    }


    public function updateForm($id)
    {
        $this->openFormUpdate = true;
        $obat = Obat::where('id', $id)->with('stock')->first();
        $pengadaan = PengadaanObat::where('id_obat', $id)->pluck('jumlah')->sum();
        $pengeluaran = PengeluaranObat::where('id_obat', $id)->pluck('jumlah')->sum();
        $lplpo = ModelsLplpo::where('id_obat', $id)->first();


        $this->id_obat = $id;
        $this->kode_obat = $obat->kode_obat;
        $this->nama_obat = $obat->nama_obat;
        $this->dosis = $obat->dosis_aturan_obat;
        $this->jenis_obat = $obat->jenis_obat;
        $this->satuan = $obat->satuan;
        $this->stock_awal = $obat->stock->stock_awal;
        $this->penerimaan = $pengadaan;
        $this->persediaan = $this->stock_awal + $this->penerimaan;
        $this->pemakaian = $pengeluaran;
        $this->stok_akhir = $this->countingObat();
        $this->rko = !empty($lplpo->rko) ? $lplpo->rko : 0;
        $this->rusak = !empty($lplpo->rusak) ? $lplpo->rusak : 0;
        $this->recal = !empty($lplpo->recal) ? $lplpo->recal : 0;
        $this->stok_opt = !empty($lplpo->stock_opt) ? $lplpo->stock_opt : 0;
        $this->permintaan = !empty($lplpo->permintaan) ? $lplpo->permintaan : 0;
        $this->pemberian = !empty($lplpo->pemberian) ? $lplpo->pemberian : 0;
        $this->ket = !empty($lplpo->keterangan) ? $lplpo->keterangan : '-';
    }

    public function openDetail()
    {
        $this->openDetailObat = true;
    }

    public function closeDetail()
    {
        $this->openDetailObat = false;
    }

    public function countingObat()
    {
        if (!empty($this->rusak) && !empty($this->recal)) {
            return $this->persediaan - $this->pemakaian - $this->rusak + $this->recal;
        } else if (!empty($this->rusak)) {
            return $this->persediaan - $this->pemakaian - $this->rusak;
        } else if (!empty($this->recal)) {
            return $this->persediaan - $this->pemakaian + $this->recal;
        } else {
            return $this->persediaan - $this->pemakaian;
        }
    }

    public function updatedRusak()
    {
        $this->stok_akhir = $this->countingObat();
    }

    public function updatedRecal()
    {
        $this->stok_akhir = $this->countingObat();
    }


    public function save()
    {
        try {

            $data = ModelsLplpo::updateOrCreate(
                ['id_obat' => $this->id_obat],
                [
                    'penerimaan' => $this->penerimaan,
                    'persediaan' => $this->persediaan,
                    'pemakaian' => $this->pemakaian,
                    'rusak' => !empty($this->rusak) ? $this->rusak : 0,
                    'recal' => !empty($this->recal) ? $this->recal : 0,
                    'stock_akhir' => $this->stok_akhir,
                    'rko' => !empty($this->rko) ? $this->rko : 0,
                    'stock_opt' => !empty($this->stock_opt) ? $this->stock_opt : 0,
                    'permintaan' => !empty($this->permintaan) ? $this->permintaan : 0,
                    'pemberian' => !empty($this->pemberian) ? $this->pemberian : 0,
                    'keterangan' => !empty($this->ket) ? $this->ket : '-',

                ]
            );


            $this->alert('success', 'Succesfully update or edit data', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);

            $this->openFormUpdate = false;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function exportLplpo()
    {
        return Excel::download(new LplpoExport, 'lplpo.xlsx');
    }
}
