<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\Suaracapres;
use Illuminate\Http\Request;

class SavesuaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function suaracapres(Request $request,$tipe)
    {

        if($tipe=='capres'){
            $capres_id = $request->capres_id;
            $request->validate([
                $capres_id  => 'required|numeric|gt:-1',
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

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd();
        // if($tipe=='capres'){
        //     $capres_id = $request->capres_id;
        //     $tps_id = $request->tps_id ;
        //     $jumlah_suara = $request->jumlah_suara ?? 0;

        //     $suara_id=Suaracapres::where([['capres_id',$capres_id],['tps_id',$tps_id]])->first();
        //     $suara_id = $suara_id->id ?? '';
            
        //     Suaracapres::updateOrCreate(
        //         ['id' => $suara_id],
        //         [
        //             'capres_id' => $capres_id,
        //             'tps_id' => $tps_id,
        //             'jumlah' =>$jumlah_suara,
        //         ]
        //     );
        //     $kirim['capres_id']=$capres_id;
        //     $kirim['jumlah_suara']=$jumlah_suara;
        //     return response()->json($kirim);    
        // }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
