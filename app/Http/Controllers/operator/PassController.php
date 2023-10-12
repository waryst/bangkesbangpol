<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class PassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ganti_password(Request $request)
    {
        // $password = $request->password;
        $validasi = $request->validate(
            [
                'password' => 'required',
                'password_confirmation' => 'required|required_with:password|same:password',
                'hp' => 'required',
            ],
            [
                'password.required' => "Password Baru Harus Di Isi",
                'password_confirmation.required' => "Password Konfirmasi Harus Di Isi",
                'password_confirmation.same' => "Password Konfirmasi Tidak sama",
                'hp.required' => "No. Whatapp Harus Di Isi",
            ]
        );
        User::where('id',  auth()->user()->id)->update([
            'status' => 1,
            'password' => Hash::make($request->password),
            'hp' => $request->hp,
        ]);

        return response()->json(['url' => url('home')]);
    }
    public function index()
    {
        //
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
        dd($request);
        // dd(auth()->user()->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
