<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $kirim['data']=User::with(['desa'=> function ($query){
            $query->withCount('tps');
        },'desa.kecamatan','desa.kecamatan.dapil'])->where('id',auth()->user()->id)->first();
        // dd($kirim['data']);
        return view('operator.conten.v_home',$kirim);
    }
}
