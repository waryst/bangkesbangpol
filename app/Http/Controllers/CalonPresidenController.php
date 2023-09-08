<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use File;
use App\Models\Capres;

class CalonPresidenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Capres::orderBy('no_urut', 'ASC')->get();
        return view('admin.content.capres', compact('data'));
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
            'no_urut' => 'required|numeric|min:1',
            'nama_capres' => 'required',
            'nama_cawapres' => 'required',
            'foto' => 'required|mimetypes:image/png,image/jpeg',
        ]);

        $nomor = Capres::where("no_urut", $request->no_urut)->count();

        if ($nomor!=0) {
            return response()->json([
                'success' => false,
                'type' => 'error',
                'message' => 'Gagal, nomor urut sudah ada.'
            ]);
        }

        $mime=$request->foto->getClientMimeType();
        $file=$request->file("foto");
        // $ext = $file->getClientOriginalExtension();
        if (!($mime=="image/png" || $mime=="image/jpeg")) {
            return response()->json([
                'success' => false,
                'type' => 'error',
                'message' => 'Gagal, file tidak sesuai.'
            ]);
        }
        $input=$request->all();

        switch ($mime) {
            case "image/png":
              $ext = ".png";
              break;
            case "image/jpeg":
                $ext = ".jpg";
              break;
            default:
            return response()->json([
                'success' => false,
                'type' => 'error',
                'message' => 'Gagal, file tidak sesuai.'
            ]);
          }

        $input['foto'] = str_replace(" ", "-", $input['nama_capres']).'-'.str_replace(" ", "-", $input['nama_cawapres']).'-'.date("Ymdhis").$ext;

        DB::beginTransaction();
        try {
            Capres::create($input);
            DB::commit();
            $file->move('foto', $input['foto']);
        } catch (\Exception $e) {
            DB::rollback();
        }
       
        
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => 'Data pasangan capres berhasil disimpan',
            'data'=> Capres::orderBy('no_urut', 'ASC')->get()
        ]);
    }
    
    public function foto(Request $request, string $id)
    {
        $request->validate([
            'foto' => 'required|mimetypes:image/png,image/jpeg',
        ]);

        $mime=$request->foto->getClientMimeType();
        $file=$request->file("foto");
        // $ext = $file->getClientOriginalExtension();
        if (!($mime=="image/png" || $mime=="image/jpeg")) {
            return response()->json([
                'success' => false,
                'type' => 'error',
                'message' => 'Gagal, file tidak sesuai.'
            ]);
        }

        $input=$request->all();

        switch ($mime) {
            case "image/png":
              $ext = ".png";
              break;
            case "image/jpeg":
                $ext = ".jpg";
              break;
            default:
            return response()->json([
                'success' => false,
                'type' => 'error',
                'message' => 'Gagal, file tidak sesuai.'
            ]);
          }

        $capres = Capres::where("id", $id)->first();
        $oldFoto="foto/".$capres->foto;
        $input['foto'] = str_replace(" ", "-", $capres->nama_capres).'-'.str_replace(" ", "-", $capres->nama_cawapres).'-'.date("Ymdhis").$ext;

        DB::beginTransaction();
        try {
            $capres->update(['foto' => $input['foto']]);
            DB::commit();
            if (File::exists(public_path($oldFoto))) {
                File::delete(public_path($oldFoto));
            }
            $file->move('foto', $input['foto']);
        } catch (\Exception $e) {
            DB::rollback();
        }
        
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => 'Foto pasangan capres berhasil disimpan',
            'data'=> Capres::orderBy('no_urut', 'ASC')->get()
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
            'field' => 'required',
            'value' => 'required'
        ]);

        $field = $request->field;
        $value = $request->value;

        $status = "fail";
        $type = "error";
        $message = "Data capres tidak ditemukan";
        $data = null;
        
        $caleg = Capres::where('id', $id)->first();
        // dd($partai);
        if ($caleg) {
            if ($field == 'no_urut') {
                $d = Capres::where('no_urut', $value);
                if ($d->count() != 0) {
                    $d->first()->update(['no_urut' => null]);
                }
                $caleg->update([$field => $value]);
                $data =  Capres::orderBy('no_urut', 'ASC')->get();
                $status = "success";
                $type = "success";
                $message = "Data capres berhasil diperbarui";
            } else {
                $caleg->update([$field => $value]);
                $status = "success";
                $type = "success";
                $message = "Data capres berhasil diperbarui";
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
        $capres=Capres::where('id', $id)->first();
        if ($capres) {
            $file = "foto/".$capres->foto;
            DB::beginTransaction();
            try {
                $capres->delete();
                DB::commit();
                if (File::exists(public_path($file))) {
                    File::delete(public_path($file));
                }
            } catch (\Exception $e) {
                DB::rollback();
            }
            return response()->json([
                'status' => true,
                'type' => 'success',
                'message' => 'Data capres berhasil dihapus',
                'data'=> Capres::orderBy('no_urut', 'ASC')->get()
            ]);
        }
    }
}
