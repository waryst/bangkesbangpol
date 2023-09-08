<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Partai;
use App\Models\Dpd;

class CalegDpdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Dpd::orderBy('no_urut', 'ASC')->get();
        return view('admin.content.calegdpd', compact('data'));
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
            'no_urut' => 'required|numeric|min:1',
        ]);

        //check dobel nomor urut
        $u = Dpd::where('no_urut', $request->no_urut);
        if ($u->count() != 0) {
            $u->first()->update(['no_urut' => null]);
        }

        Dpd::create([
            'no_urut' => $request->no_urut,
            'nama' => $request->nama
        ]);

        return response()->json([
            'success' => true,
            'type' => 'success',
            'message' => 'Data caleg berhasil disimpan',
            'data'=> Dpd::orderBy('no_urut', 'ASC')->get()
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
        $message = "Data caleg tidak ditemukan";
        $data = null;
        
        $caleg = Dpd::where('id', $id)->first();
        // dd($partai);
        if ($caleg) {
            if ($field == 'no_urut') {
                $d = Dpd::where('no_urut', $value);
                if ($d->count() != 0) {
                    $d->first()->update(['no_urut' => null]);
                }
                $caleg->update([$field => $value]);
                $data =  Dpd::orderBy('no_urut', 'ASC')->get();
                $status = "success";
                $type = "success";
                $message = "Data caleg berhasil diperbarui";
            } else {
                $caleg->update([$field => $value]);
                $status = "success";
                $type = "success";
                $message = "Data caleg berhasil diperbarui";
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
        $caleg=Dpd::where('id', $id)->first();
        DB::beginTransaction();
        try {
            $caleg->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => 'Caleg berhasil dihapus',
            'data'=> Dpd::orderBy('no_urut', 'ASC')->get()
        ]);
    }
}
