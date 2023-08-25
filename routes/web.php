<?php

use App\Http\Controllers\operator\CapresController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\TpsController;
use App\Http\Controllers\DapilController;
use App\Http\Controllers\PartaiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RekapSuaraController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\operator\SavesuaraController;
use App\Http\Controllers\operator\EntrySuaraController;

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


Route::get('/', function () {
    return view('operator.layout.main');
});




Route::get('/', [AuthController::class,'index'])->name('login')->middleware('revalidate');
Route::post('/', [AuthController::class,'postlogin']);


Route::get('/logout', [AuthController::class,'logout']);
Route::group(['middleware' => ['auth', 'checkRole:administrator', 'revalidate']], function () {

    Route::resource('capres', CapresController::class);
    Route::resource('kecamatan', KecamatanController::class);
    Route::resource('desa', DesaController::class);
    Route::resource('tps', TpsController::class);
    Route::resource('dapil', DapilController::class);
    Route::resource('partai', PartaiController::class);




    Route::get('/dashboard', function () {
        return view('admin.layout.main');
    })->name('dashboard');
    Route::get('rekapcapres/{tipe}/{id}', [RekapSuaraController::class,'rekapcapres']);
    Route::get('rekapcagub/{tipe}/{id}', [RekapSuaraController::class,'rekapcagub']);
    Route::get('rekapcabub/{tipe}/{id}', [RekapSuaraController::class,'rekapcabub']);
    Route::get('rekapdpd/{tipe}/{id}', [RekapSuaraController::class,'rekapdpd']);
    Route::get('rekapcalegri/{tipe}/{id}', [RekapSuaraController::class,'rekapcalegri']);
    Route::get('rekapcalegprov/{tipe}/{id}', [RekapSuaraController::class,'rekapcalegprov']);
    Route::get('rekapcalegkab/{tipe}/{id}', [RekapSuaraController::class,'rekapcalegkab']);
});


Route::group(['middleware' => ['auth', 'checkRole:operator', 'revalidate']], function () {
    Route::get('/home', function () {
        return view('operator.layout.main');
    })->name('home');
    Route::get('capres', [EntrySuaraController::class,'capres']);
    Route::get('capres/{id}', [EntrySuaraController::class,'capres_tps']);
    Route::get('pilgub', [EntrySuaraController::class,'pilgub']);
    Route::get('pilgub/{id}', [EntrySuaraController::class,'pilgub_tps']);
    Route::get('pilbub', [EntrySuaraController::class,'pilbub']);
    Route::get('pilbub/{id}', [EntrySuaraController::class,'pilbub_tps']);
    Route::get('dpd', [EntrySuaraController::class,'dpd']);
    Route::get('dpd/{id}', [EntrySuaraController::class,'dpd_tps']);
    Route::get('caleg', [EntrySuaraController::class,'caleg']);
    Route::get('caleg/{id}', [EntrySuaraController::class,'caleg_tps']);
    Route::get('calegprov', [EntrySuaraController::class,'calegprov']);
    Route::get('calegprov/{id}', [EntrySuaraController::class,'calegprov_tps']);
    Route::get('calegkab', [EntrySuaraController::class,'calegkab']);
    Route::get('calegkab/{id}', [EntrySuaraController::class,'calegkab_tps']);
    Route::post('savesuara/{tipe}', [SavesuaraController::class,'suara']);
});
