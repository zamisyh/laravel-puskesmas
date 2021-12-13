<?php

namespace App\Http\Livewire\Admin\MasterData;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Diagnosa as Diagnosas;
use App\Imports\DiagnosaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class Diagnosa extends Component
{

    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['confirmed'];

    public $search;
    public $rows = 5;

    public $openFormCreate, $openFormUpdate, $openFormUpload;
    public $diagnosaId;

    public $kode, $nama_penyakit, $file_excel;

    public function render()
    {
        if ($this->search) {
            $diagnosas = Diagnosas::where('nama_penyakit', 'LIKE', '%' . $this->search . '%')
                ->orWhere('code', 'LIKE', '%' . $this->search . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        } else {
            $diagnosas = Diagnosas::orderBy('created_at', 'DESC')
                ->paginate($this->rows);
        }

        return view('livewire.admin.master-data.diagnosa', compact('diagnosas'))->extends('layouts.app')->section('content');
    }

    public function openFormCreateDiagnosa()
    {
        $this->openFormCreate = true;
    }
    public function closeFormCreateDiagnosa()
    {
        $this->openFormCreate = false;
        $this->resetForm();
    }

    public function openFormUploadExcel()
    {
        $this->openFormUpload = true;
    }

    public function openFormUpdateDiagnosa($id)
    {
        $user = Diagnosas::findOrFail($id);

        $this->kode = $user->code;
        $this->nama_penyakit = $user->nama_penyakit;


        $this->diagnosaId = $user->id;
        $this->openFormCreate = true;
        $this->openUpdate = true;
    }
    public function closeFormUpdateDiagnosa()
    {
        $this->openFormUpdate = false;
    }

    public function saveDiagnosa()
    {
        $this->validasi();

        try {

            Diagnosas::create([
                'code' => strtoupper($this->kode),
                'nama_penyakit' => $this->nama_penyakit,


            ]);


            $this->alert('success', 'Succesfully create diagnosa', [
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

    public function updateDiagnosa($id)
    {

        $this->validasi();
        $data = Diagnosas::findOrFail($id);

        $data->code  = $this->kode;
        $data->nama_penyakit = $this->nama_penyakit;


        $data->save();

        $this->alert('success', 'Succesfully update diagnosa', [
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


    public function deleteDiagnosa($id)
    {
        $data = Diagnosas::findOrFail($id);
        $this->diagnosaId = $data->id;

        $this->triggerConfirm();
    }

    public function uploadExcel()
    {
        $this->validate([
            'file_excel' => 'required|mimes:xlsx, xls'
        ]);

        try {
            DB::table('diagnosa')->delete();
            Excel::import(new DiagnosaImport, $this->file_excel);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $this->alert('success', 'Succesfully upload file', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);

        $this->openFormUpload = false;
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

        Diagnosas::findOrFail($this->diagnosaId)->delete();

        $this->alert('success', 'Succesfully delete diagnosa', [
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


    public function noIzinDiagnosa()
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
            'kode' =>  'required',
            'nama_penyakit' => 'required|min:3'
        ]);
    }
}
