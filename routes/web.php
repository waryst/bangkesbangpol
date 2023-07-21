<?php

use App\Http\Controllers\operator\CapresController;
use App\Http\Controllers\operator\SavesuaraController;
use Illuminate\Support\Facades\Route;

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

Route::resource('capres',CapresController::class);
Route::POST('savesuara/{tipe}',[SavesuaraController::class,'suaracapres']);
