<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\Capres;
use App\Models\Desa;
use App\Models\Tps;
use Illuminate\Http\Request;

class CapresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $desa_id="999054d7-54af-44d6-acff-9e88b8992001";
        $kirim['tps']=Tps::where('desa_id',$desa_id)->orderBy('title','ASC')->get();
        $kirim['capres']=Capres::orderBy('no_urut','ASC')->get();
        return view('operator.conten.v_capres',$kirim);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show($capre)
    {
        // $data = Capres::orderBy('no_urut','ASC')->whereRelation('suaracapres', 'tps_id', $)->get();
        // return response()->json(['isi'=>$data]);

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
