<?php

namespace App\Http\Livewire\Admin;

use App\Models\Dokter;
use App\Models\Laboratorium;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use Livewire\Component;
use Livewire\WithPagination;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DokterExport;
use App\Exports\LaboratoriumExport;
use App\Exports\ObatExport;
use App\Exports\PasienExport;
use App\Exports\PendaftaranExport;



class Reports extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $title = 'Dokter';
    public $choice = 'dokter';
    public $details;
    public $rows = 5;
    public $search;
    public $filter, $resFilter;
    public $idLabReport;
    public $from, $to;


    public function render()
    {

        $data = null;

        if ($this->choice == 'pasien') {
            $this->title = 'Pasien';

            if ($this->search) {
                $data = Pasien::where('nama_pasien', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('kode_paramedis', 'LIKE', '%' . $this->search . '%')
                    ->with('jaminan')
                    ->orderBy('created_at', 'DESC')
                    ->paginate($this->rows);
            } else {
                $data = Pasien::orderBy('created_at', 'DESC')
                    ->with('jaminan')
                    ->paginate($this->rows);
            }
        } else if ($this->choice == 'pendaftaran') {
            $this->title = 'Pendaftaran';

            if ($this->search) {
                $data = Pendaftaran::whereHas('pasien', function ($q) {
                    $q->where('nama_pasien', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('no_rawat', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('no_rekammedis', 'LIKE', '%' . $this->search . '%');
                })
                    ->with('pasien', 'poli:id,nama_poli', 'dokter:id,nama_dokter')
                    ->orderBy('created_at', 'DESC')
                    ->paginate($this->rows);
            } else {
                $data = Pendaftaran::with('pasien', 'poli:id,nama_poli', 'dokter:id,nama_dokter')
                    ->orderBy('created_at', 'DESC')
                    ->paginate($this->rows);
            }
        } else if ($this->choice == 'dokter') {
            $this->title = 'Dokter';

            if ($this->search) {
                $data = Dokter::where('nama_dokter', 'LIKE', '%' . $this->search . '%')
                    ->with('poli')
                    ->orderBy('created_at', 'DESC')
                    ->paginate($this->rows);
            } else {
                $data = Dokter::with('poli')
                    ->orderBy('created_at', 'DESC')
                    ->paginate($this->rows);
            }
        } else if ($this->choice == 'obat') {
            $this->title = 'Obat-obatan';

            if ($this->search) {
                $data = Obat::where('nama_obat', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('kode_obat', 'LIKE', '%' . $this->search . '%')
                    ->orderBy('created_at', 'DESC')
                    ->paginate($this->rows);
            } else {
                $data = Obat::orderBy('created_at', 'DESC')
                    ->paginate($this->rows);
            }
        } else if ($this->choice == 'lab') {
            $this->title = 'Laboratorium';

            if ($this->search) {

                $data = Laboratorium::whereHas('pasien', function ($q) {
                    $q->where('nama_pasien', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('no_rawat', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('no_rekammedis', 'LIKE', '%' . $this->search . '%');
                })->with('pasien')->paginate($this->rows);
            } else {
                $data = Laboratorium::with('pasien')->orderBy('created_at', 'DESC')->paginate($this->rows);
            }
        }

        return view('livewire.admin.reports', compact('data'))->extends('layouts.app')->section('content');
    }



    public function openDetails()
    {
        $this->details = true;
    }

    public function closeDetails()
    {
        $this->details = false;
    }

    public function openFormFilter()
    {
        $this->filter = true;
    }

    public function closeFormFilter()
    {
        $this->filter = false;
    }

    //Exporting
    public function dokterExportAll()
    {
        return Excel::download(new DokterExport, 'dokter.xlsx');
    }

    public function obatExportAll()
    {
        return Excel::download(new ObatExport, 'obat.xlsx');
    }

    public function labsExportAll()
    {
        return Excel::download(new LaboratoriumExport(null), 'labs.xlsx');
    }

    public function labsExportWithId($id)
    {

        $data = Laboratorium::where('id', $id)->with('pasien')->first();
        $this->idLabReport = $data->id;
        $randomName = strtolower($data->no_rekammedis . '-' . str_replace(' ', '-', $data->pasien->nama_pasien));
        return Excel::download(new LaboratoriumExport($id), 'labs-' . $randomName . '.xlsx');
    }

    public function pasienExportAll()
    {
        return Excel::download(new PasienExport(null, null), 'pasien.xlsx');
    }

    public function pasienExportByDate()
    {
        return Excel::download(new PasienExport($this->from, $this->to), 'pasien-' . $this->from . '-to-' . $this->to . '.xlsx');
    }


    public function pendaftaranExportAll()
    {
        return Excel::download(new PendaftaranExport(null, null), 'pendaftaran.xlsx');
    }

    public function pendaftaranExportByDate()
    {
        return Excel::download(new PendaftaranExport($this->from, $this->to), 'pendaftaran-' . $this->from . '-to-' . $this->to . '.xlsx');
    }
}
