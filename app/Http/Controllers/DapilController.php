<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Kecamatan;
use App\Models\Dapil;

class DapilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = Dapil::withCount('kecamatan')->orderBy('title', 'ASC')->get();
        $data = Dapil::withCount('kecamatan')->orderByRaw('title * 1 ASC')->get();
        $kec = Kecamatan::orderBy('created_at', 'DESC')->get();
        return view('admin.content.dapil', compact('data', 'kec'));
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
            'title' => 'required',
        ]);

        $input = $request->all();
        if (Dapil::where('title', $input['title'])->count()==0) {
            Dapil::create(['title'=> $input['title']]);
            return response()->json([
                'success' => true,
                'type' => 'success',
                'message' => 'Dapil berhasil ditambahkan',
                'data'    => Dapil::withCount('kecamatan')->orderByRaw('title * 1 ASC')->get()
            ]);
        }

        return response()->json([
            'success' => false,
            'type' => 'error',
            'message' => 'Gagal, dapil sudah ada',
        ]);
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
     * add dapil_id to kecamatan
     */
    public function update(Request $request, string $id)
    {
        //add dapil_id to kecamatan
        foreach ($request->kecamatan_id as $d) {
            Kecamatan::where('id', $d)->update(['dapil_id'=>$id]);
        }


        return response()->json([
                        'success' => true,
                        'type' => 'success',
                        'message' => 'Kecamatan berhasil dimasukkan ke dalam dapil',
                        // 'kecamatan_count' => Kecamatan::jumlahDalamDapil($id),
                        'kecamatan'    => Kecamatan::where('dapil_id', $id)->orderBy('title', 'ASC')->get(),
                        'dapil'    => Dapil::withCount('kecamatan')->orderByRaw('title * 1 ASC')->get()
                    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $find=Dapil::where('id', $id);

        if ($find->count()==1) {
            $old=$find->first();
            $old->delete();

            return response()->json([
                'success' => true,
                'type' => 'success',
                'message' => 'Dapil '.$old->title.' berhasil dihapus',
                'data'    => Dapil::withCount('kecamatan')->orderByRaw('title * 1 ASC')->get()
            ]);
        }
    }
}
