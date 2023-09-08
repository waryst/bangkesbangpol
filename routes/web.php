<?php

use App\Http\Controllers\admin\RekapDataPemilu;
use App\Http\Controllers\operator\CapresController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\TpsController;
use App\Http\Controllers\DapilController;
use App\Http\Controllers\PartaiController;
use App\Http\Controllers\CalegRIController;
use App\Http\Controllers\CalegProvController;
use App\Http\Controllers\CalegKabController;
use App\Http\Controllers\CalegDpdController;
use App\Http\Controllers\CalonPresidenController;
use App\Http\Controllers\CalonGubernurController;
use App\Http\Controllers\CalonBupatiController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserDesaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RekapSuaraController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\operator\SavesuaraController;
use App\Http\Controllers\operator\EntrySuaraController;
use App\Http\Controllers\operator\Home;
use App\Http\Controllers\operator\HomeController;

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

Route::resource('capres', CapresController::class);
Route::resource('kecamatan', KecamatanController::class);
Route::resource('desa', DesaController::class);
Route::resource('tps', TpsController::class);
Route::resource('dapil', DapilController::class);
Route::resource('partai', PartaiController::class);
Route::resource('caleg-dpr', CalegRIController::class);
Route::resource('caleg-dprd1', CalegProvController::class);
Route::resource('caleg-dprd2', CalegKabController::class);
Route::get('caleg-dprd2/show/{pid}/{did}', [CalegKabController::class,'show2']);
Route::resource('caleg-dpd', CalegDpdController::class);
Route::resource('calon-presiden', CalonPresidenController::class);
Route::post('calon-presiden/foto/{id}', [CalonPresidenController::class,'foto']);
Route::resource('calon-gubernur', CalonGubernurController::class);
Route::post('calon-gubernur/foto/{id}', [CalonGubernurController::class,'foto']);
Route::resource('calon-bupati', CalonBupatiController::class);
Route::post('calon-bupati/foto/{id}', [CalonBupatiController::class,'foto']);
Route::resource('user-admin', UserAdminController::class);
Route::post('user-admin/password/{id}', [UserAdminController::class,'password']);
Route::resource('user-desa', UserDesaController::class);



Route::get('/', [AuthController::class,'index'])->name('login')->middleware('revalidate');
Route::post('/', [AuthController::class,'postlogin']);


Route::get('/logout', [AuthController::class,'logout']);
Route::group(['middleware' => ['auth', 'checkRole:administrator', 'revalidate']], function () {
    Route::get('/dashboard', [RekapDataPemilu::class,'index'])->name('dashboard');
    Route::get('rekapcapres/{tipe}/{id}', [RekapSuaraController::class,'rekapcapres']);
    Route::get('rekapcagub/{tipe}/{id}', [RekapSuaraController::class,'rekapcagub']);
    Route::get('rekapcabub/{tipe}/{id}', [RekapSuaraController::class,'rekapcabub']);
    Route::get('rekapdpd/{tipe}/{id}', [RekapSuaraController::class,'rekapdpd']);
    Route::get('rekapcalegri/{tipe}/{id}', [RekapSuaraController::class,'rekapcalegri']);
    Route::get('rekapcalegprov/{tipe}/{id}', [RekapSuaraController::class,'rekapcalegprov']);
    Route::get('rekapcalegkab/{tipe}/{id}', [RekapSuaraController::class,'rekapcalegkab']);
});


Route::group(['middleware' => ['auth', 'checkRole:operator', 'revalidate']], function () {
    Route::get('/home', [HomeController::class,'index'])->name('home');
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
