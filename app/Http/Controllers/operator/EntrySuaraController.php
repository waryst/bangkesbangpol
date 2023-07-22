<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\Cabub;
use App\Models\Cagub;
use App\Models\Capres;
use App\Models\Tps;
use Illuminate\Http\Request;

class EntrySuaraController extends Controller
{
    public function capres(){
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $kirim['capres']=Capres::with('suaracapres')->orderBy('no_urut','ASC')->get();
        return view('operator.conten.v_capres',$kirim);    
    }
    public function pilgub(){
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $kirim['cagub']=Cagub::with('suaracagub')->orderBy('no_urut','ASC')->get();
        return view('operator.conten.v_cagub',$kirim);    
    }
    public function pilbub(){
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $kirim['cabub']=Cabub::with('suaracabub')->orderBy('no_urut','ASC')->get();
        return view('operator.conten.v_cabub',$kirim);    
    }
    public function capres_tps(Tps $id)
    {
        $kirim['pilih_tps']=$id;
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $kirim['capres']=Capres::with('suaracapres')->orderBy('no_urut','ASC')->get();
        return view('operator.conten.v_capres',$kirim);    
    }
    public function pilgub_tps(Tps $id)
    {
        $kirim['pilih_tps']=$id;
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $kirim['cagub']=Cagub::with('suaracagub')->orderBy('no_urut','ASC')->get();
        return view('operator.conten.v_cagub',$kirim);    
    }
    public function pilbub_tps(Tps $id)
    {
        $kirim['pilih_tps']=$id;
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $kirim['cabub']=Cabub::with('suaracabub')->orderBy('no_urut','ASC')->get();
        return view('operator.conten.v_cabub',$kirim);    
    }

}