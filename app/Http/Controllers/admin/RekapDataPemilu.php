<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Dapil;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Tps;
use Illuminate\Http\Request;

class RekapDataPemilu extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kirim['kecamatan']=Kecamatan::all()->count();
        $kirim['desa']=Desa::all()->count();
        $kirim['tps']=Tps::all()->count();
        $kirim['dapil']=Dapil::all()->count();

        $kirim['detail_dapil']=Dapil::withCount(['kecamatan','desa'])->get();
        
        return view('admin.conten.v_home',$kirim);
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
