<?php

use Illuminate\Support\Facades\Route;
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

Route::get('capres',[EntrySuaraController::class,'capres']);
Route::get('capres/{id}',[EntrySuaraController::class,'capres_tps']);

Route::get('pilgub',[EntrySuaraController::class,'pilgub']);
Route::get('pilgub/{id}',[EntrySuaraController::class,'pilgub_tps']);

Route::get('pilbub',[EntrySuaraController::class,'pilbub']);
Route::get('pilbub/{id}',[EntrySuaraController::class,'pilbub_tps']);
Route::post('savesuara/{tipe}',[SavesuaraController::class,'suara']);
