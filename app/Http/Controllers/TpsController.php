<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Tps;

class TpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kecamatan::withCount('desa')->orderBy('title', 'ASC')->get();
        return view('admin.content.tps', compact('data'));
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
        $request->validate([
            'jml' => 'required|numeric|min:1',
            'desa_id' => 'required|exists:App\Models\Desa,id',
        ]);

        $d=Tps::where('desa_id', $request->desa_id)->orderBy('id', 'DESC')->first();
        if ($d) {
            $last =  $d->title;
        } else {
            $last =  0;
        }

        $input = $request->jml;
        while ($input > 0) {
            $last++;
            $data = ['title'=>$last, 'desa_id'=>$request->desa_id];
            $input--;
            Tps::create($data);
        }

        return response()->json([
                'success' => true,
                'type' => 'success',
                'message' => "TPS berhasil ditambahkan",
                'tps_count' => Tps::where('desa_id', $request->desa_id)->count(),
                'data'=> Tps::where('desa_id', $request->desa_id)->orderBy('id', 'DESC')->get()
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $desa=Desa::where('id', $id)->first();

        return response()->json([
                'success' => true,
                'type' => 'success',
                'kecamatan' => $desa->title,
                'tps_count' => Tps::where('desa_id', $id)->count(),
                'data'=> Tps::where('desa_id', $id)->orderBy('id', 'DESC')->get()
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Tps::where('desa_id', $id)->delete();

        return response()->json([
            'success' => true,
            'type' => 'success',
            'message' => "TPS berhasil dihapus",
            'tps_count' => Tps::where('desa_id', $id)->count(),
            'data'=> Tps::where('desa_id', $id)->orderBy('id', 'DESC')->get()
        ]);
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
        $tps = Tps::where('id', $id);
        if ($tps->count()==1) {
            $old = $tps->first();
            $old->delete();
        }
        return response()->json([
                'success' => true,
                'type' => 'success',
                'message' => "TPS berhasil dihapus",
                'tps_count' => Tps::where('desa_id', $old->desa_id)->count(),
                'data'=> Tps::where('desa_id', $old->desa_id)->orderBy('id', 'DESC')->get()
            ]);
    }
}
