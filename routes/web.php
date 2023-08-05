<?php

use App\Http\Controllers\Beranda;
use App\Http\Controllers\Wartawan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TvController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RadioController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HarianController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RekapanController;
use App\Http\Controllers\MingguanController;
use App\Http\Controllers\WartawanController;
use App\Http\Controllers\InfotorialController;
use App\Http\Controllers\KonfirmasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenyerahanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LayoutController::class,'index'])->middleware('auth');
Route::get('/home', [LayoutController::class,'index'])->middleware('auth');
Route::get('/dashboard', [LayoutController::class,'add'])->middleware('auth');

Route::post('/dashboard', 'LayoutController@calculateInfotorialTransfer');


Route::controller(LoginController::class)->group(function(){
    Route::get('login','index')->name('login');
    Route::post('login/proses','proses');
    Route::get('logout','logout');
});


//halaman Index untuk kepala bidang
Route::get('/infotorials/add', [InfotorialController::class, 'add'])->name('infotorials.add');
Route::get('/galeris/add', [GaleriController::class, 'add'])->name('galeris.add');
Route::get('/harians/add', [HarianController::class, 'add'])->name('harians.add');
Route::get('/mingguans/add', [MingguanController::class, 'add'])->name('mingguans.add');
Route::get('/radios/add', [RadioController::class, 'add'])->name('radios.add');
Route::get('/tvs/add', [TvController::class, 'add'])->name('tvs.add');
Route::get('/surats/add', [SuratController::class, 'add'])->name('surats.add');

//halaman untuk admin
Route::group(['middleware' => ['auth']],function(){
    Route::group(['middleware' => ['cekUserLogin:1']],function(){
        Route::resource('beranda', Beranda::class);
        Route::resource('infotorial', InfotorialController::class);
        Route::resource('galeris', GaleriController::class);
        Route::resource('harians', HarianController::class);
        Route::resource('mingguans', MingguanController::class);
        Route::resource('radios', RadioController::class);
        Route::resource('tvs', TvController::class);
    });
        Route::get('/pesanans', [PesananController::class, 'index']);
        Route::post('/pesanans', [PesananController::class, 'store']);
        Route::get('/pesanans/{id}/detail', [PesananController::class, 'detail'])->name('pesanan.detail');
        Route::delete('/pesanans/{id}', [PesananController::class,'destroy'])->name('pesanans.destroy');

        Route::get('penyerahans', [PenyerahanController::class, 'index'])->name('penyerahans.index');
        Route::get('penyerahans/create', [PenyerahanController::class, 'create'])->name('penyerahans.create');
        Route::post('penyerahans', [PenyerahanController::class, 'store'])->name('penyerahans.store');
        Route::delete('penyerahans/{penyerahan}', [PenyerahanController::class, 'destroy'])->name('penyerahans.destroy');
        
        Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit',[UserController::class,'edit']);
        Route::put('/users/{id}',[UserController::class,'update']);
        Route::delete('/users/{id}',[UserController::class,'destroy']);

        Route::get('/infotorials', [InfotorialController::class, 'index'])->name('infotorials.index');
        Route::get('/infotorials/create', [InfotorialController::class, 'create'])->name('infotorials.create');
        Route::post('/infotorials', [InfotorialController::class, 'store'])->name('infotorials.store');
        Route::get('/infotorials/{id}/edit', [InfotorialController::class, 'edit'])->name('infotorials.edit');
        Route::put('/infotorials/{id}', [InfotorialController::class, 'update'])->name('infotorials.update');
        Route::get('/infotorials/{id}', [InfotorialController::class, 'show'])->name('infotorials.show');
        Route::delete('/infotorials/{id}', [InfotorialController::class, 'destroy'])->name('infotorials.destroy');
        Route::get('/infotorials/search', [InfotorialController::class, 'search'])->name('infotorials.search');
        
        Route::get('/galeris', [GaleriController::class, 'index'])->name('galeris.index');
        Route::get('/galeris/create', [GaleriController::class, 'create'])->name('galeris.create');
        Route::post('/galeris', [GaleriController::class, 'store'])->name('galeris.store');
        Route::get('/galeris/{id}/edit', [GaleriController::class, 'edit'])->name('galeris.edit');
        Route::put('/galeris/{id}', [GaleriController::class, 'update'])->name('galeris.update');
        Route::get('/galeris/{id}', [GaleriController::class, 'show'])->name('galeris.show');
        Route::delete('/galeris/{id}', [GaleriController::class, 'destroy'])->name('galeris.destroy');
        Route::get('/galeris/search', [GaleriController::class, 'search'])->name('galeris.search');

// route untuk  media online harian        
Route::get('/harians', [HarianController::class, 'index'])->name('harians.index');
Route::get('/harians/create', [HarianController::class, 'create'])->name('harians.create');
Route::post('/harians', [HarianController::class, 'store'])->name('harians.store');
Route::get('/harians/{id}/edit', [HarianController::class, 'edit'])->name('harians.edit');
Route::put('/harians/{id}', [HarianController::class, 'update'])->name('harians.update');
Route::get('/harians/{id}', [HarianController::class, 'show'])->name('harians.show');
Route::delete('/harians/{id}', [HarianController::class, 'destroy'])->name('harians.destroy');
Route::get('/harians/search', [HarianController::class, 'search'])->name('harians.search');

        
Route::get('/mingguans', [MingguanController::class, 'index'])->name('mingguans.index');
Route::get('/mingguans/create', [MingguanController::class, 'create'])->name('mingguans.create');
Route::post('/mingguans', [MingguanController::class, 'store'])->name('mingguans.store');
Route::get('/mingguans/{id}/edit', [MingguanController::class, 'edit'])->name('mingguans.edit');
Route::put('/mingguans/{id}', [MingguanController::class, 'update'])->name('mingguans.update');
Route::get('/mingguans/{id}', [MingguanController::class, 'show'])->name('mingguans.show');
Route::delete('/mingguans/{id}', [MingguanController::class, 'destroy'])->name('mingguans.destroy');
Route::get('/mingguans/search', [MingguanController::class, 'search'])->name('mingguans.search');
        
Route::get('/radios', [RadioController::class, 'index'])->name('radios.index');
Route::get('/radios/create', [RadioController::class, 'create'])->name('radios.create');
Route::post('/radios', [RadioController::class, 'store'])->name('radios.store');
Route::get('/radios/{id}/edit', [RadioController::class, 'edit'])->name('radios.edit');
Route::put('/radios/{id}', [RadioController::class, 'update'])->name('radios.update');
Route::get('/radios/{id}', [RadioController::class, 'show'])->name('radios.show');
Route::delete('/radios/{id}', [RadioController::class, 'destroy'])->name('radios.destroy');
Route::get('/radios/search', [RadioController::class, 'search'])->name('radios.search');
        
Route::get('/tvs', [TvController::class, 'index'])->name('tvs.index');
Route::get('/tvs/create', [TvController::class, 'create'])->name('tvs.create');
Route::post('/tvs', [TvController::class, 'store'])->name('tvs.store');
Route::get('/tvs/{id}/edit', [TvController::class, 'edit'])->name('tvs.edit');
Route::put('/tvs/{id}', [TvController::class, 'update'])->name('tvs.update');
Route::get('/tvs/{id}', [TvController::class, 'show'])->name('tvs.show');
Route::delete('/tvs/{id}', [TvController::class, 'destroy'])->name('tvs.destroy');
Route::get('/tvs/search', [TvController::class, 'search'])->name('tvs.search');
        
Route::get('surats/create', [SuratController::class, 'create'])->name('surats.create');
Route::post('surats', [SuratController::class, 'store'])->name('surats.store');
Route::get('surats', [SuratController::class, 'index'])->name('surats.index');
Route::delete('surats/{surat}', [SuratController::class, 'destroy'])->name('surats.destroy');

// pdf
Route::get('/report', [RekapanController::class, 'getAllReport'])->name('report.all');
Route::get('/report/form', [RekapanController::class, 'showForm'])->name('report.form');
Route::get('/report/download', [RekapanController::class, 'downloadPDFReport'])->name('report.download');

    Route::get('/konfirmasis/create', [KonfirmasiController::class, 'create'])->name('konfirmasis.create');
    Route::post('/konfirmasis', [KonfirmasiController::class, 'store']);

// halaman untuk users
    Route::group(['middleware' => ['cekUserLogin:2']],function(){
        Route::resource('wartawan', Wartawan::class);
        Route::get('/wartawan/harians/index', [Wartawan::class, 'index'])->name('wartawan.harians.index');
        Route::get('/wartawan/galeris/add', [Wartawan::class, 'add'])->name('wartawan.galeris.add');
        Route::get('/wartawan/infotorials/addd', [Wartawan::class, 'addd'])->name('wartawan.infotorials.addd');
        Route::get('/wartawan/mingguans/ad', [Wartawan::class, 'ad'])->name('wartawan.mingguans.ad');
        Route::get('/wartawan/radios/aa', [Wartawan::class, 'aa'])->name('wartawan.radios.aa');
        Route::get('/wartawan/tvs/ab', [Wartawan::class, 'ab'])->name('wartawan.tvs.ab');
        Route::get('/wartawan/surats/aad', [Wartawan::class, 'aad'])->name('wartawan.surats.aad');

        Route::get('/pesanans/create', [PesananController::class, 'create']);
        Route::get('/penyerahans/create', [PenyerahanController::class, 'create']);
        

         // Mengkonfirmasi surat oleh wartawan (user) yang dituju
        Route::get('/surats/konfirmasi/{id}', [SuratController::class, 'konfirmasiSurat'])->name('surats.konfirmasi');
        Route::delete('/konfirmasis/{id}', [WartawanController::class, 'destroy'])->name('konfirmasis.destroy');
         // Menampilkan detail surat
        Route::get('/surats/{id}/detail', [SuratController::class, 'detail'])->name('surats.detail');
 
        
        Route::get('/konfirmasis/wartawan', [WartawanController::class, 'index'])->name('konfirmasis.wartawan');
    });
        Route::get('/pembayarans/index', [PembayaranController::class, 'index'])->name('pembayarans.index');
        Route::delete('/pembayarans/{id}', [PembayaranController::class, 'destroy'])->name('pembayarans.destroy');

        // halaman untuk kepala bidang
    Route::group(['middleware' => ['cekUserLogin:3']],function(){
        
        
    });

});