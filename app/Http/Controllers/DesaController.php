<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Tps;
use App\Models\User;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'kecamatan_id' => 'required|exists:App\Models\Kecamatan,id',
        ]);

        $ada=Desa::where('title', $request->title)->where('kecamatan_id', $request->kecamatan_id)->count();

        if ($ada==0) {
            $nama_kecamatan = Kecamatan::where("id", $request->kecamatan_id)->first();

            $desa = Desa::create(['title'=> ucwords($request->title), 'kecamatan_id'=>$request->kecamatan_id]);

            User::create([
                'name' => "Operator ".$desa->title,
                'desa_id' =>$desa->id,
                'email' => str_replace(" ", "", (strtolower($desa->title).".".strtolower($nama_kecamatan->title))),
                'role'=>'operator',
                'password'=>Hash::make(str_replace(" ", "", (strtolower($nama_kecamatan->title).".".strtolower($desa->title)))),
            ]);

            return response()->json([
                'success' => true,
                'type' => 'success',
                'message' => "Desa berhasil ditambahkan",
                'desa_count' => Desa::jumlahDesa($request->kecamatan_id),
                'data'    => Desa::tabel($request->kecamatan_id)
            ]);
        }
        return response()->json([
            'success' => false,
            'type' => 'error',
            'message' => "Gagal, desa sudah ada"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kecamatan=Kecamatan::where('id', $id)->first();

        return response()->json([
                'success' => true,
                'type' => 'success',
                'kecamatan' => $kecamatan->title,
                'data'    => Desa::tabel($id)
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $old = Desa::where('id', $id);
        $desa = $old->first();

        if ($old->count()!=1) {
            return response()->json([
                'success' => false,
                'type' => 'error',
                'message' => 'Gagal, tidak ditemukan',
                'data'    => $desa->title
                ]);
        }

        if ($desa->title==$request->title) {
            return response()->json([
                'success' => 'duplicate',
            ]);
        }

        $duplicate=Desa::where('title', $request->title)->where('kecamatan_id', $desa->kecamatan_id);
        if ($duplicate->count()==1) {
            return response()->json([
                'success' => false,
                'type' => 'error',
                'message' => 'Gagal, desa sudah ada',
                'data'    => $desa->title
            ]);
        }

        $old_title = $desa->title;
        if ($old_title!=$request->title) {
            $desa->update(['title' => ucwords($request->title)]);
            return response()->json([
                'success' => true,
                'type' => 'success',
                'message' => 'Desa berhasil diedit',
                'data'    => $desa->title
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $old=Desa::where('id', $id)->first();

        DB::beginTransaction();
        try {
            Tps::where('desa_id', $old->id)->delete();
            User::where('desa_id', $old->id)->delete();
            Desa::where('id', $id)->first()->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        return response()->json([
                'success' => true,
                'type' => 'success',
                'message' => 'Desa berhasil dihapus',
                'desa_count' => Desa::jumlahDesa($old->kecamatan_id),
                'data'    => Desa::tabel($old->kecamatan_id)
            ]);
    }
}
