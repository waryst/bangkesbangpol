<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kecamatan;
use App\Models\Desa;

class UserDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = User::where("role", "operator")->where("email", "like", "%.kauman%")->orderBy('id', 'ASC')->get();
        $kecamatan = Kecamatan::withCount('desa')->orderBy('title', 'ASC')->get();
        $desa = Desa::with("kecamatan")->with("user")->orderBy("title", "ASC")->get()->sortBy("kecamatan.title");
        return view('admin.content.desa', compact('kecamatan', 'desa'));
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
        $kecamatan = Kecamatan::withCount('desa')->orderBy('title', 'ASC')->get();
        $desa = Desa::where("kecamatan_id", $id)->with("kecamatan")->with("user")->orderBy("title", "ASC")->get()->sortBy("user.name");
        return response()->json([
            'status' => true,
            'kecamatan' => $desa->first()->kecamatan->title,
            'data' => $desa->values()
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
            'password' => 'required|confirmed',
        ]);

        $user = User::where('id', $id)->first();

        // dd($user);
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password),
                'status' => 0
            ]);
            return response()->json([
                'status' => true,
                'type' => 'success',
                'message' => 'Password berhasil diupdate.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'type' => 'error',
                'message' => 'Gagal, user tidak ditemukan.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
