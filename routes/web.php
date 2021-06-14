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
                    Route::get('paramedis', Paramedis::class)->name('master-data.paramedis');
                    Route::get('poli', Poli::class)->name('master-data.poli');
                    Route::get('jabatan', Jabatan::class)->name('master-data.jabatan');
                    Route::get('bidang', Bidang::class)->name('master-data.bidang');
                    Route::get('pegawai', Pegawai::class)->name('master-data.pegawai');
                });
            });
        });
    });
});
