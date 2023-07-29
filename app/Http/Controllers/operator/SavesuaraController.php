<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\Suaracabub;
use App\Models\Suaracagub;
use App\Models\Suaracaleg;
use App\Models\Suaracalegkab;
use App\Models\Suaracalegprov;
use App\Models\Suaracapres;
use App\Models\Suaradpd;
use Illuminate\Http\Request;

class SavesuaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function suara(Request $request,$tipe)
    {

        if($tipe=='capres'){
            $capres_id = $request->capres_id;
            $request->validate([
                $capres_id  => 'required|numeric|gt:-1|max:500',
            ]); 
            
            $tps_id = $request->tps_id ;
            $jumlah_suara = $request->jumlah_suara;
            $suara_id=Suaracapres::where([['capres_id',$capres_id],['tps_id',$tps_id]])->first();
            $suara_id = $suara_id->id ?? '';
                Suaracapres::updateOrCreate(
                    ['id' => $suara_id],
                    [
                        'capres_id' => $capres_id,
                        'tps_id' => $tps_id,
                        'jumlah' =>$jumlah_suara,
                    ]
                );
            $kirim['capres_id']=$capres_id;
            $kirim['jumlah_suara']=$jumlah_suara;
            return response()->json($kirim);    
        }
        if($tipe=='cagub'){
            $cagub_id = $request->cagub_id;
            $request->validate([
                $cagub_id  => 'required|numeric|gt:-1|max:500',
            ]); 
            
            $tps_id = $request->tps_id ;
            $jumlah_suara = $request->jumlah_suara;
            $suara_id=Suaracagub::where([['cagub_id',$cagub_id],['tps_id',$tps_id]])->first();
            $suara_id = $suara_id->id ?? '';
            
            Suaracagub::updateOrCreate(
                ['id' => $suara_id],
                [
                    'cagub_id' => $cagub_id,
                    'tps_id' => $tps_id,
                    'jumlah' =>$jumlah_suara,
                ]
            );
            $kirim['cagub_id']=$cagub_id;
            $kirim['jumlah_suara']=$jumlah_suara;
            return response()->json($kirim);    
        }
        if($tipe=='cabub'){
            $cabub_id = $request->cabub_id;
            $request->validate([
                $cabub_id  => 'required|numeric|gt:-1|max:500',
            ]); 
            
            $tps_id = $request->tps_id ;
            $jumlah_suara = $request->jumlah_suara;
            $suara_id=Suaracabub::where([['cabub_id',$cabub_id],['tps_id',$tps_id]])->first();
            $suara_id = $suara_id->id ?? '';
            
            Suaracabub::updateOrCreate(
                ['id' => $suara_id],
                [
                    'cabub_id' => $cabub_id,
                    'tps_id' => $tps_id,
                    'jumlah' =>$jumlah_suara,
                ]
            );
            $kirim['cabub_id']=$cabub_id;
            $kirim['jumlah_suara']=$jumlah_suara;
            return response()->json($kirim);    
        }
        if($tipe=='dpd'){
            $dpd_id = $request->dpd_id;
            $request->validate([
                $dpd_id  => 'required|numeric|gt:-1|max:500',
            ]); 
            
            $tps_id = $request->tps_id ;
            $jumlah_suara = $request->jumlah_suara;
            $suara_id=Suaradpd::where([['dpd_id',$dpd_id],['tps_id',$tps_id]])->first();
            $suara_id = $suara_id->id ?? '';
            
            Suaradpd::updateOrCreate(
                ['id' => $suara_id],
                [
                    'dpd_id' => $dpd_id,
                    'tps_id' => $tps_id,
                    'jumlah' =>$jumlah_suara,
                ]
            );
            $kirim['dpd_id']=$dpd_id;
            $kirim['jumlah_suara']=$jumlah_suara;
            return response()->json($kirim);    
        }
        if($tipe=='calegri'){
            $caleg_id = $request->caleg_id;
            $request->validate([
                $caleg_id  => 'required|numeric|gt:-1|max:500',
            ]); 
            
            $tps_id = $request->tps_id ;
            $jumlah_suara = $request->jumlah_suara;
            $suara_id=Suaracaleg::where([['caleg_id',$caleg_id],['tps_id',$tps_id]])->first();
            $suara_id = $suara_id->id ?? '';
                Suaracaleg::updateOrCreate(
                    ['id' => $suara_id],
                    [
                        'caleg_id' => $caleg_id,
                        'tps_id' => $tps_id,
                        'jumlah' =>$jumlah_suara,
                    ]
                );      
            $kirim['caleg_id']=$caleg_id;
            $kirim['jumlah_suara']=$jumlah_suara;
            return response()->json($kirim);    
        }
        if($tipe=='calegprov'){
            $caleg_id = $request->caleg_id;
            $request->validate([
                $caleg_id  => 'required|numeric|gt:-1|max:500',
            ]); 
            
            $tps_id = $request->tps_id ;
            $jumlah_suara = $request->jumlah_suara;
            $suara_id=Suaracalegprov::where([['caleg_id',$caleg_id],['tps_id',$tps_id]])->first();
            $suara_id = $suara_id->id ?? '';
                Suaracalegprov::updateOrCreate(
                    ['id' => $suara_id],
                    [
                        'caleg_id' => $caleg_id,
                        'tps_id' => $tps_id,
                        'jumlah' =>$jumlah_suara,
                    ]
                );

            $kirim['caleg_id']=$caleg_id;
            $kirim['jumlah_suara']=$jumlah_suara;
            return response()->json($kirim);    
        }
        if($tipe=='calegkab'){
            $caleg_id = $request->caleg_id;
            $request->validate([
                $caleg_id  => 'required|numeric|gt:-1|max:500',
            ]); 
            
            $tps_id = $request->tps_id ;
            $jumlah_suara = $request->jumlah_suara;
            $suara_id=Suaracalegkab::where([['caleg_id',$caleg_id],['tps_id',$tps_id]])->first();
            $suara_id = $suara_id->id ?? '';
                Suaracalegkab::updateOrCreate(
                    ['id' => $suara_id],
                    [
                        'caleg_id' => $caleg_id,
                        'tps_id' => $tps_id,
                        'jumlah' =>$jumlah_suara,
                    ]
                ); 
            $kirim['caleg_id']=$caleg_id;
            $kirim['jumlah_suara']=$jumlah_suara;
            return response()->json($kirim);    
        }





    }


}
