<?php

namespace App\Http\Controllers\operator;
use App\Http\Controllers\Controller;
use App\Models\Cabub;
use App\Models\Cagub;
use App\Models\Caleg;
use App\Models\Capres;
use App\Models\Dpd;
use App\Models\Partai;
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
    public function dpd(){
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $kirim['dpd']=Dpd::with('suaradpd')->orderBy('no_urut','ASC')->get();
        return view('operator.conten.v_dpd',$kirim);    
    }
    public function caleg(){
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $dapil_id=1;
        $kirim['partai']=Partai::with(['caleg' =>
        function ($query) use ($dapil_id)  {
            $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut','ASC');
        } ])->orderBy('no_urut','ASC')->get();
        return view('operator.conten.v_caleg',$kirim);    
    }
    public function calegprov(){
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $dapil_id=2;
        $kirim['partai']=Partai::with(['caleg' =>
        function ($query) use ($dapil_id)  {
            $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut','ASC');
        } ])->orderBy('no_urut','ASC')->get();
        return view('operator.conten.v_calegprov',$kirim);    
    }
    public function calegkab(){
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $dapil_id=3;
        $kirim['partai']=Partai::with(['caleg' =>
        function ($query) use ($dapil_id)  {
            $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut','ASC');
        } ])->orderBy('no_urut','ASC')->get();
        return view('operator.conten.v_calegkab',$kirim);    
    }
    public function capres_tps(Tps $id)
    {
        $kirim['pilih_tps']=$id;
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $tps_id=$id->id;
        $kirim['capres']=Capres::with(['suaracapres' =>
        function ($query) use ($tps_id) {
            $query->where('tps_id', '=', $tps_id);
        } ])->orderBy('no_urut','ASC')->get();
        return view('operator.conten.v_capres',$kirim);    
    }
    public function pilgub_tps(Tps $id)
    {
        $kirim['pilih_tps']=$id;
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $tps_id=$id->id;
        $kirim['cagub']=Cagub::with(['suaracagub' =>
        function ($query) use ($tps_id) {
            $query->where('tps_id', '=', $tps_id);
        } ])->orderBy('no_urut','ASC')->get();

        return view('operator.conten.v_cagub',$kirim);    
    }
    public function pilbub_tps(Tps $id)
    {
        $kirim['pilih_tps']=$id;
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $tps_id=$id->id;
        $kirim['cabub']=Cabub::with(['suaracabub' =>
        function ($query) use ($tps_id) {
            $query->where('tps_id', '=', $tps_id);
        } ])->orderBy('no_urut','ASC')->get();

        return view('operator.conten.v_cabub',$kirim);    
    }
        public function dpd_tps(Tps $id)
    {
        $kirim['pilih_tps']=$id;
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $tps_id=$id->id;
        $kirim['dpd']=Dpd::with(['suaradpd' =>
        function ($query) use ($tps_id) {
            $query->where('tps_id', '=', $tps_id);
        } ])->orderBy('no_urut','ASC')->get();

        return view('operator.conten.v_dpd',$kirim);    
    }

        public function caleg_tps(Tps $id)
    {
        $kirim['pilih_tps']=$id;
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $dapil_id=1;
        $tps_id=$id->id;
        $kirim['partai']=Partai::with(['caleg' =>
        function ($query) use ($dapil_id,$tps_id)  {
            $tps=$tps_id;
            $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut','ASC')->with(['suaracaleg'=>
            function ($query) use ($tps)  {
                $query->where('tps_id', '=', $tps);
            }]);
        } ])->orderBy('no_urut','ASC')->get();
        return view('operator.conten.v_caleg',$kirim);    
    }
        public function calegprov_tps(Tps $id)
    {
        $kirim['pilih_tps']=$id;
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $dapil_id=2;
        $tps_id=$id->id;
        $kirim['partai']=Partai::with(['caleg' =>
        function ($query) use ($dapil_id,$tps_id)  {
            $tps=$tps_id;
            $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut','ASC')->with(['suaracalegprov'=>
            function ($query) use ($tps)  {
                $query->where('tps_id', '=', $tps);
            }]);
        } ])->orderBy('no_urut','ASC')->get();
        return view('operator.conten.v_calegprov',$kirim);    
    }

        public function calegkab_tps(Tps $id)
    {
        $kirim['pilih_tps']=$id;
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $dapil_id=3;
        $tps_id=$id->id;
        $kirim['partai']=Partai::with(['caleg' =>
        function ($query) use ($dapil_id,$tps_id)  {
            $tps=$tps_id;
            $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut','ASC')->with(['suaracalegprov'=>
            function ($query) use ($tps)  {
                $query->where('tps_id', '=', $tps);
            }]);
        } ])->orderBy('no_urut','ASC')->get();
        return view('operator.conten.v_calegkab',$kirim);    
    }


}
