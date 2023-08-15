<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Partai;

class PartaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Partai::orderBy('no_urut', 'ASC')->get();
        return view('admin.content.partai', compact('data'));
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
            'nama' => 'required',
            'singkatan' => 'required',
            'no_urut' => 'required|numeric|min:1',
        ]);
        // $success = true;
        // $type = "success";
        // $message = "Data partai berhasil disimpan";

        //cek double nama dan singkatan
        $nama = Partai::where('nama', $request->nama)->count();
        $singkatan = Partai::where('singkatan', $request->singkatan)->count();


        if ($nama>0 || $singkatan>0) {
            if ($singkatan>0) {
                $message = "Gagal, singkatan partai sudah ada";
            }
            if ($nama>0) {
                $message = "Gagal, partai sudah ada";
            }
            return response()->json([
                'success' => false,
                'type' => 'error',
                'message' =>  $message
            ]);
        }

        //check dobel nomor urut
        $u = Partai::where('no_urut', $request->no_urut);
        if ($u->count() != 0) {
            $u->first()->update(['no_urut' => null]);
        }

        Partai::create([
            'no_urut' => $request->no_urut,
            'nama' => strtoupper($request->nama),
            'singkatan' => strtoupper($request->singkatan)
        ]);

        return response()->json([
            'success' => true,
            'type' => 'success',
            'message' => 'Data partai berhasil disimpan',
            'data'=> Partai::orderBy('no_urut', 'ASC')->get()
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'field' => 'required',
            'value' => 'required'
        ]);

        $field = $request->field;
        $value = $request->value;

        $status = "fail";
        $type = "error";
        $message = "Data partai tidak ditemukan";
        $data = null;
        
        $partai = Partai::where('id', $id)->first();
        // dd($partai);
        if ($partai) {
            if ($field == 'no_urut') {
                $d = Partai::where('no_urut', $value);
                if ($d->count() != 0) {
                    $d->first()->update(['no_urut' => null]);
                }
                $partai->update([$field => $value]);
                $data =  Partai::orderBy('no_urut', 'ASC')->get();
                $status = "success";
                $type = "success";
                $message = "Data partai berhasil diperbarui";
            } else {
                $other = Partai::where($field, $value)->first();
                if ($other) {
                    $status = "duplicate";
                    $message = "Gagal, nama partai sudah ada";
                    if ($field == "singkatan") {
                        $message = "Gagal, singkatan partai sudah ada";
                    }
                } else {
                    $partai->update([$field => strtoupper($value)]);
                    $status = "success";
                    $type = "success";
                    $message = "Data partai berhasil diperbarui";
                }
            }
        }
       
        return response()->json([
            'status' => $status, //success, fail, duplicate
            'type' => $type,
            'message' => $message,
            'data'=> $data, //if no_urut change, collection. if not, null
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $partai=Partai::where('id', $id)->first();
        // TO DO > Get all relationship
        // $caleg_ri=Caledri::where('kecamatan_id', $kecamatan->id)->get();
        DB::beginTransaction();
        try {
            // foreach ($desa as $d) {
            //     Tps::where('desa_id', $d->id)->delete();
            //     $d->delete();
            // }
            $partai->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => 'Partai berhasil dihapus',
            'data'=> Partai::orderBy('no_urut', 'ASC')->get()
        ]);
    }
}
