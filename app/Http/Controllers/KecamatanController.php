<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Kecamatan;
use App\Models\Desa;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kecamatan::withCount('desa')->orderBy('created_at', 'DESC')->get();
        return view('admin.content.kecamatan', compact('data'));
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
        if (Kecamatan::where('title', $input['title'])->count()==0) {
            Kecamatan::create(['title'=> ucwords($input['title'])]);
            return response()->json([
                'success' => true,
                'type' => 'success',
                'message' => 'Kecamatan berhasil ditambahkan',
                'data'    => Kecamatan::tabel()
            ]);
        }

        return response()->json([
            'success' => false,
            'type' => 'error',
            'message' => 'Gagal, kecamatan sudah ada',
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        
        $input = $request->all();
        $old=Kecamatan::where('id', $id);
        $kecamatan = $old->first();

        if ($old->count()!=1) {
            return response()->json([
            'success' => false,
            'type' => 'error',
            'message' => 'Gagal, tidak ditemukan',
            'data'    => $kecamatan->title
        ]);
        }

        if ($kecamatan->title==$input['title']) {
            return response()->json([
                'success' => 'duplicate',
            ]);
        }

        $duplicate=Kecamatan::where('title', $input['title']);
        if ($duplicate->count()==1) {
            return response()->json([
            'success' => false,
            'type' => 'error',
            'message' => 'Gagal, kecamatan sudah ada',
            'data'    => $kecamatan->title
        ]);
        }

        $old_title = $kecamatan->title;
        if ($old_title!=$input['title']) {
            $kecamatan->update(['title' => ucwords($input['title'])]);
            return response()->json([
                'success' => true,
                'type' => 'success',
                'message' => $old_title.' berhasil diedit menjadi '.$kecamatan->title,
                'data'    => $kecamatan->title
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $find=Kecamatan::where('id', $id);

        if ($find->count()==1) {
            $old=$find->first();
            $old->delete();

            return response()->json([
                'success' => true,
                'type' => 'success',
                'message' => 'Kecamatan '.$old->title.' berhasil dihapus',
                'data'    => Kecamatan::tabel()
            ]);
        }
    }
}
