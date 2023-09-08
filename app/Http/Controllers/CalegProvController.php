<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Partai;
use App\Models\Caleg;

class CalegProvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Partai::withCount([
            'caleg as jumlah_caleg' => function ($query) {
                $query->where('dapil_id', 2);
            }])->orderBy('no_urut', 'ASC')->get();
        return view('admin.content.calegprov', compact('data'));
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
            'partai_id' => 'required|exists:App\Models\Partai,id',
            'no_urut' => 'required|numeric|min:1',
        ]);

        // $nama = Caleg::where('partai_id', $request->partai_id)->where('dapil_id', 2)->where('nama', $request->nama)->count();
        $urut = Caleg::where('partai_id', $request->partai_id)->where('dapil_id', 2)->where('no_urut', $request->no_urut)->count();

        // if ($nama>0 || $urut>0) {
        if ($urut>0) {
            $message = "Gagal, nomor urut sudah terpakai";
            // }
            // if ($nama>0) {
            //     $message = "Gagal, nama caleg sudah ada";
            // }
            return response()->json([
                'success' => false,
                'type' => 'error',
                'message' =>  $message
            ]);
        }

        Caleg::create([
            'partai_id' => $request->partai_id,
            'dapil_id' => 2,
            'nama' => $request->nama,
            'no_urut' => $request->no_urut
        ]);

        return response()->json([
            'success' => true,
            'type' => 'success',
            'message' => 'Data caleg berhasil disimpan',
            'data'    => Caleg::where('partai_id', $request->partai_id)->where('dapil_id', 2)->orderBy('no_urut', 'ASC')->get()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Caleg::where('partai_id', $id)->where('dapil_id', 2)->orderBy('no_urut', 'ASC')->get();
        return response()->json([
            'status' => true,
            'data'=> $data
        ]);
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
            'field' => 'required',
            'value' => 'required'
        ]);

        $field = $request->field;
        $value = $request->value;

        $status = "fail";
        $type = "error";
        $message = "Data caleg tidak ditemukan";
        $data = null;
        
        $caleg = Caleg::where('id', $id)->first();
        // dd($partai);
        if ($caleg) {
            if ($field=='no_urut') {
                $other = Caleg::where('partai_id', $caleg->partai_id)->where('dapil_id', 2)->where('no_urut', $value);
                if ($other->count()!=0) {
                    $other->first()->update(['no_urut' => null]);
                }
                $caleg->update([$field => $value]);
                $data =  Caleg::where('partai_id', $caleg->partai_id)->where('dapil_id', 2)->orderBy('no_urut', 'ASC')->get();
                $status = "success";
                $type = "success";
                $message = "Data caleg berhasil diperbarui";
            } else {
                // $other = Caleg::where($field, $value)->first();
                // if ($other) {
                //     if ($other->id != $caleg->id) {
                //         $status = "duplicate";
                //         $message = "Gagal, caleg sudah ada";
                //     } else {
                //         $caleg->update([$field=>$value]);
                //         $status = "success";
                //         $type = "success";
                //         $message = "Data caleg berhasil diperbarui";
                //     }
                // } else {
                $caleg->update([$field=>$value]);
                $status = "success";
                $type = "success";
                $message = "Data caleg berhasil diperbarui";
                // }
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
        $caleg=Caleg::where('id', $id)->first();
        // TO DO > Get all relationship
        // $caleg_ri=Caledri::where('kecamatan_id', $kecamatan->id)->get();
        DB::beginTransaction();
        try {
            // foreach ($desa as $d) {
            //     Tps::where('desa_id', $d->id)->delete();
            //     $d->delete();
            // }
            $caleg->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => 'Caleg berhasil dihapus',
            'data'=> Caleg::where('partai_id', $caleg->partai_id)->where('dapil_id', 2)->orderBy('no_urut', 'ASC')->get()
        ]);
    }
}
