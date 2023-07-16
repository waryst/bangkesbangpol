<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\Capres;
use App\Models\Desa;
use Illuminate\Http\Request;

class CapresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $desa_id="998fdb13-98ab-4ddf-b6a3-9e1f60ad6889";
        $pencarian_data= Desa::find($desa_id);
        $kirim['capres']=Capres::orderBy('no_urut','ASC')->get();
        return view('operator.layout.conten.v_capres',$kirim);    
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
    public function show(Desa $capre)
    {
        

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
