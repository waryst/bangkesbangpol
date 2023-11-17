<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cek_status = Status::first();
        if ($cek_status->status == 0) {
            return view('operator.conten.v_error');
        } else if ($cek_status->status == 1) {
            $kirim['data'] = User::with(['desa' => function ($query) {
                $query->withCount('tps');
            }, 'desa.kecamatan', 'desa.kecamatan.dapil'])->where('id', auth()->user()->id)->first();
            return view('operator.conten.v_home', $kirim);
        }
    }
}
