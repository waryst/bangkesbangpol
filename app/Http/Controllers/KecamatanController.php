<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Dapil;
use App\Models\Tps;
use App\Models\User;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kecamatan::withCount('desa')->orderBy('dapil_id', 'ASC')->orderBy('created_at', 'DESC')->get();
        return view('admin.content.kecamatan', compact('data'));
    }

    public function create()
    {
        //
    }


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
                'data'    => Kecamatan::withCount('desa')->with('dapil')->orderBy('dapil_id', 'ASC')->orderBy('created_at', 'DESC')->get()
            ]);
        }

        return response()->json([
            'success' => false,
            'type' => 'error',
            'message' => 'Gagal, kecamatan sudah ada',
        ]);
    }


    public function show(string $id)
    {
        // show kecamatan belong to dapil dapil.blade
        $dapil=Dapil::where('id', $id)->first();

        return response()->json([
                'success' => true,
                'type' => 'success',
                'dapil' => $dapil->title,
                'data'    => Kecamatan::where('dapil_id', $id)->orderBy('title', 'ASC')->get()
            ]);
    }


    public function edit(string $id)
    {
        // remove dapil_id from kecamatan dapil.blade
        $find=Kecamatan::where('id', $id);

        if ($find->count()==1) {
            $old=$find->first();
            $dapil_id = $old->dapil_id;
            $old->update(['dapil_id' => null]);

            return response()->json([
                'success' => true,
                'type' => 'success',
                'message' => 'Kecamatan berhasil dihapus',
                'kecamatan_count' => Kecamatan::jumlahDalamDapil($dapil_id),
                'data'    => Kecamatan::where('dapil_id', $dapil_id)->orderBy('title', 'ASC')->get()
            ]);
        }
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
                'message' => 'Kecamatan berhasil diedit',
                'data'    => $kecamatan->title
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kecamatan=Kecamatan::where('id', $id)->first();
        $desa=Desa::where('kecamatan_id', $kecamatan->id)->get();
        DB::beginTransaction();
        try {
            foreach ($desa as $d) {
                Tps::where('desa_id', $d->id)->delete();
                User::where('desa_id', $d->id)->delete();
                $d->delete();
            }
            $kecamatan->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        return response()->json([
            'success' => true,
            'type' => 'success',
            'message' => 'Kecamatan berhasil dihapus',
            'data'    => Kecamatan::withCount('desa')->with('dapil')->orderBy('dapil_id', 'ASC')->orderBy('created_at', 'DESC')->get()
        ]);
    }
}
