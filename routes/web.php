<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Admin\ManagementUsers\Roles;
use App\Http\Livewire\Admin\Components\Header;
use App\Http\Livewire\Admin\ManagementUsers\Users;
use App\Http\Livewire\Admin\MasterData\Paramedis;
use App\Http\Livewire\Admin\MasterData\Poli;
use App\Http\Livewire\Admin\MasterData\Jabatan;
use App\Http\Livewire\Admin\MasterData\Bidang;
use App\Http\Livewire\Admin\MasterData\Pegawai;
use App\Http\Livewire\Admin\MasterData\Dokter;
use App\Http\Livewire\Admin\MasterData\JadwalPraktekDokter;
use App\Http\Livewire\Admin\MasterData\Jaminan;
use App\Http\Livewire\Admin\MasterData\Supplier;
use App\Http\Livewire\Admin\MasterData\Obat;
use App\Http\Livewire\Admin\MasterData\Tindakan;
use App\Http\Livewire\Admin\MasterData\Operasi;
use App\Http\Livewire\Admin\MasterData\Diagnosa;
use App\Http\Livewire\Admin\MasterData\Pasien;
use App\Http\Livewire\Admin\TransaksiObat\Stock;
use App\Http\Livewire\Admin\TransaksiObat\PengadaanObat;
use App\Http\Livewire\Admin\TransaksiObat\PengeluaranObat;
use App\Http\Livewire\Admin\Pendaftaran;
use App\Http\Livewire\Admin\Tindakan\PenangananOperasi;
use App\Http\Livewire\Admin\Tindakan\PoliKia;
use App\Http\Livewire\Admin\Tindakan\PerbaikanGizi;
use App\Http\Livewire\Admin\Tindakan\DataBerobat;

use App\Http\Livewire\Admin\Home;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::get('signin', Login::class)->name('login');
});

Route::prefix('dash')->group(function () {
    Route::name('dash.')->group(function () {
        Route::middleware(['auth'])->group(function () {
            Route::get('/', Home::class)->name('home');
            Route::get('logout', Header::class)->name('logout');

            Route::middleware(['role:admin'])->group(function () {
                Route::prefix('management')->group(function () {
                    Route::get('role', Roles::class)->name('management.role');
                    Route::get('users', Users::class)->name('management.user');
                });

                Route::prefix('master-data')->group(function () {
                    Route::name('master-data.')->group(function () {
                        Route::get('paramedis', Paramedis::class)->name('paramedis');
                        Route::get('poli', Poli::class)->name('poli');
                        Route::get('jabatan', Jabatan::class)->name('jabatan');
                        Route::get('bidang', Bidang::class)->name('bidang');
                        Route::get('pegawai', Pegawai::class)->name('pegawai');
                        Route::get('dokter', Dokter::class)->name('dokter');
                        Route::get('jadwal-praktek-dokter', JadwalPraktekDokter::class)->name('jadwal-praktek-dokter');
                        Route::get('jaminan', Jaminan::class)->name('jaminan');
                        Route::get('supplier', Supplier::class)->name('supplier');
                        Route::get('obat', Obat::class)->name('obat');
                        Route::get('tindakan', Tindakan::class)->name('tindakan');
                        Route::get('operasi', Operasi::class)->name('operasi');
                        Route::get('diagnosa', Diagnosa::class)->name('diagnosa');
                        Route::get('pasien', Pasien::class)->name('pasien');
                    });
                });

                Route::prefix('transaksi')->group(function () {
                    Route::name('transaksi.')->group(function () {
                        Route::get('stock-obat', Stock::class)->name('stock-obat');
                        Route::get('pengadaan-obat', PengadaanObat::class)->name('pengadaan-obat');
                        Route::get('pengeluaran-obat', PengeluaranObat::class)->name('pengeluaran-obat');
                    });
                });

                Route::get('pendaftaran', Pendaftaran::class)->name('pendaftaran');

                Route::prefix('tindakan')->group(function () {
                    Route::name('tindakan.')->group(function () {
                        Route::get('penanganan-operasi', PenangananOperasi::class)->name('penanganan-operasi');
                        Route::get('poli-kia', PoliKia::class)->name('poli-kia');
                        Route::get('perbaikan-gizi', PerbaikanGizi::class)->name('perbaikan-gizi');
                        Route::get('data-tindakan-berobat', DataBerobat::class)->name('data-berobat');
                    });
                });
            });
        });
    });
});
