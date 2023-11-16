<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where("role", "administrator")->whereNotIn("id", [0])->orderBy('id', 'ASC')->get();
        return view('admin.content.admin', compact('data'));
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $dupe = User::where('email', $request->name)->count();
        if ($dupe != 0) {
            return response()->json([
                'success' => false,
                'type' => 'error',
                'message' => 'Gagal, username sudah dipakai.'
            ]);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'administrator'
        ]);

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => 'Data user admin berhasil disimpan',
            'data' => User::where("role", "administrator")->orderBy('id', 'ASC')->get()
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
     * Update password.
     */

    public function password(Request $request, string $id)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $user = User::where('id', $id)->first();
        if ($user) {
            $user->update(["password" => Hash::make($request->password)]);
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

        $user = User::where('id', $id)->first();
        if ($user) {
            if ($field == 'email') {
                $d = User::where('email', $value);
                if ($d->count() != 0) {
                    return response()->json([
                        'status' => 'fail',
                        'type' => 'error',
                        'message' => 'Gagal, nama user sudah dipakai.'
                    ]);
                }
            }
            $user->update([$field => $value]);
            return response()->json([
                'status' => 'success',
                'type' => 'success',
                'message' => 'Data user berhasil diupdate',
                'data' => User::where("role", "administrator")->orderBy('id', 'ASC')->get()
            ]);
        }
        return response()->json([
            'status' => 'fail',
            'type' => 'error',
            'message' => 'Gagal, user admin tidak ditemukan.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            DB::beginTransaction();
            try {
                $user->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
            return response()->json([
                'status' => true,
                'type' => 'success',
                'message' => 'Data user berhasil dihapus',
                'data' => User::where("role", "administrator")->orderBy('id', 'ASC')->get()
            ]);
        }
    }
}
