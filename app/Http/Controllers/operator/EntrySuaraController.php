<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\Cabub;
use App\Models\Cagub;
use App\Models\Caleg;
use App\Models\Capres;
use App\Models\Dpd;
use App\Models\Partai;
use App\Models\Status;
use App\Models\Suaratidaksah;
use App\Models\Tps;
use Illuminate\Http\Request;

class EntrySuaraController extends Controller
{
    public function capres()
    {
        $cek_status = Status::first();
        if ($cek_status->status == 0) {
            return view('operator.conten.v_error');
        } else if ($cek_status->status == 1) {
            $desa_id = auth()->user()->desa_id;
            $kirim['tps'] = Tps::where('desa_id', $desa_id)->orderBy('title', 'ASC')->get();
            $kirim['capres'] = Capres::with('suaracapres')->orderBy('no_urut', 'ASC')->get();
            return view('operator.conten.v_capres', $kirim);
        }
    }
    public function pilgub()
    {
        $cek_status = Status::first();
        if ($cek_status->status == 0) {
            return view('operator.conten.v_error');
        } else if ($cek_status->status == 1) {
            $desa_id = auth()->user()->desa_id;
            $kirim['tps'] = Tps::where('desa_id', $desa_id)->orderBy('title', 'ASC')->get();
            $kirim['cagub'] = Cagub::with('suaracagub')->orderBy('no_urut', 'ASC')->get();
            return view('operator.conten.v_cagub', $kirim);
        }
    }
    public function pilbub()
    {
        $cek_status = Status::first();
        if ($cek_status->status == 0) {
            return view('operator.conten.v_error');
        } else if ($cek_status->status == 1) {
            $desa_id = auth()->user()->desa_id;
            $kirim['tps'] = Tps::where('desa_id', $desa_id)->orderBy('title', 'ASC')->get();
            $kirim['cabub'] = Cabub::with('suaracabub')->orderBy('no_urut', 'ASC')->get();
            return view('operator.conten.v_cabub', $kirim);
        }
    }
    public function dpd()
    {
        $cek_status = Status::first();
        if ($cek_status->status == 0) {
            return view('operator.conten.v_error');
        } else if ($cek_status->status == 1) {
            $desa_id = auth()->user()->desa_id;
            $kirim['tps'] = Tps::where('desa_id', $desa_id)->orderBy('title', 'ASC')->get();
            $kirim['dpd'] = Dpd::with('suaradpd')->orderBy('no_urut', 'ASC')->get();
            return view('operator.conten.v_dpd', $kirim);
        }
    }
    public function caleg()
    {
        $cek_status = Status::first();
        if ($cek_status->status == 0) {
            return view('operator.conten.v_error');
        } else if ($cek_status->status == 1) {
            $desa_id = auth()->user()->desa_id;
            $kirim['tps'] = Tps::where('desa_id', $desa_id)->orderBy('title', 'ASC')->get();
            $dapil_id = 1;
            $kirim['partai'] = Partai::with(['caleg' =>
            function ($query) use ($dapil_id) {
                $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut', 'ASC');
            }])->orderBy('no_urut', 'ASC')->get();
            return view('operator.conten.v_caleg', $kirim);
        }
    }
    public function calegprov()
    {
        $cek_status = Status::first();
        if ($cek_status->status == 0) {
            return view('operator.conten.v_error');
        } else if ($cek_status->status == 1) {
            $desa_id = auth()->user()->desa_id;
            $kirim['tps'] = Tps::where('desa_id', $desa_id)->orderBy('title', 'ASC')->get();
            $dapil_id = 2;
            $kirim['partai'] = Partai::with(['caleg' =>
            function ($query) use ($dapil_id) {
                $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut', 'ASC');
            }])->orderBy('no_urut', 'ASC')->get();
            return view('operator.conten.v_calegprov', $kirim);
        }
    }
    public function calegkab()
    {
        $cek_status = Status::first();
        if ($cek_status->status == 0) {
            return view('operator.conten.v_error');
        } else if ($cek_status->status == 1) {
            $desa_id = auth()->user()->desa_id;
            $kirim['tps'] = Tps::where('desa_id', $desa_id)->orderBy('title', 'ASC')->get();
            $dapil_id = auth()->user()->desa->kecamatan->dapil_id;
            $kirim['partai'] = Partai::with(['caleg' =>
            function ($query) use ($dapil_id) {
                $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut', 'ASC');
            }])->orderBy('no_urut', 'ASC')->get();
            return view('operator.conten.v_calegkab', $kirim);
        }
    }
    public function capres_tps(Tps $id)
    {
        $cek_status = Status::first();
        if ($cek_status->status == 0) {
            return view('operator.conten.v_error');
        } else if ($cek_status->status == 1) {
            $kirim['pilih_tps'] = $id;
            $desa_id = auth()->user()->desa_id;
            $kirim['tps'] = Tps::with('suaratidaksah')->where('desa_id', $desa_id)->orderBy('title', 'ASC')->get();
            $kirim['suaratidaksah'] = $id->suaratidaksah->presiden ?? 0;
            $tps_id = $id->id;
            $kirim['capres'] = Capres::with(['suaracapres' =>
            function ($query) use ($tps_id) {
                $query->where('tps_id', '=', $tps_id);
            }])->orderBy('no_urut', 'ASC')->get();
            return view('operator.conten.v_capres', $kirim);
        }
    }
    public function pilgub_tps(Tps $id)
    {
        $cek_status = Status::first();
        if ($cek_status->status == 0) {
            return view('operator.conten.v_error');
        } else if ($cek_status->status == 1) {
            $kirim['pilih_tps'] = $id;
            $desa_id = auth()->user()->desa_id;
            $kirim['tps'] = Tps::with('suaratidaksah')->where('desa_id', $desa_id)->orderBy('title', 'ASC')->get();
            $kirim['suaratidaksah'] = $id->suaratidaksah->gubernur ?? 0;

            $tps_id = $id->id;
            $kirim['cagub'] = Cagub::with(['suaracagub' =>
            function ($query) use ($tps_id) {
                $query->where('tps_id', '=', $tps_id);
            }])->orderBy('no_urut', 'ASC')->get();
            return view('operator.conten.v_cagub', $kirim);
        }
    }
    public function pilbub_tps(Tps $id)
    {
        $cek_status = Status::first();
        if ($cek_status->status == 0) {
            return view('operator.conten.v_error');
        } else if ($cek_status->status == 1) {
            $kirim['pilih_tps'] = $id;
            $desa_id = auth()->user()->desa_id;
            $kirim['tps'] = Tps::with('suaratidaksah')->where('desa_id', $desa_id)->orderBy('title', 'ASC')->get();
            $kirim['suaratidaksah'] = $id->suaratidaksah->bupati ?? 0;

            $tps_id = $id->id;
            $kirim['cabub'] = Cabub::with(['suaracabub' =>
            function ($query) use ($tps_id) {
                $query->where('tps_id', '=', $tps_id);
            }])->orderBy('no_urut', 'ASC')->get();

            return view('operator.conten.v_cabub', $kirim);
        }
    }
    public function dpd_tps(Tps $id)
    {
        $cek_status = Status::first();
        if ($cek_status->status == 0) {
            return view('operator.conten.v_error');
        } else if ($cek_status->status == 1) {
            $kirim['pilih_tps'] = $id;
            $desa_id = auth()->user()->desa_id;
            $kirim['tps'] = Tps::with('suaratidaksah')->where('desa_id', $desa_id)->orderBy('title', 'ASC')->get();
            $kirim['suaratidaksah'] = $id->suaratidaksah->dpd ?? 0;
            $tps_id = $id->id;
            $kirim['dpd'] = Dpd::with(['suaradpd' =>
            function ($query) use ($tps_id) {
                $query->where('tps_id', '=', $tps_id);
            }])->orderBy('no_urut', 'ASC')->get();
            return view('operator.conten.v_dpd', $kirim);
        }
    }

    public function caleg_tps(Tps $id)
    {
        $cek_status = Status::first();
        if ($cek_status->status == 0) {
            return view('operator.conten.v_error');
        } else if ($cek_status->status == 1) {
            $kirim['pilih_tps'] = $id;
            $desa_id = auth()->user()->desa_id;
            $kirim['tps'] = Tps::with('suaratidaksah')->where('desa_id', $desa_id)->orderBy('title', 'ASC')->get();
            $kirim['suaratidaksah'] = $id->suaratidaksah->dpr_ri ?? 0;

            $dapil_id = 1;
            $tps_id = $id->id;
            $kirim['partai'] = Partai::with(
                [
                    'caleg' => function ($query) use ($dapil_id, $tps_id) {
                        $tps = $tps_id;
                        $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut', 'ASC')->with(
                            ['suaracaleg' => function ($query) use ($tps) {
                                $query->where('tps_id', '=', $tps);
                            }]
                        );
                    },
                    'suarapartai' => function ($query) use ($tps_id) {
                        $tps = $tps_id;
                        $query->where('tps_id', '=', $tps);
                    }
                ]
            )->orderBy('no_urut', 'ASC')->get();
            // dd($kirim['partai'][0]->suarapartai[0]->jumlah);
            return view('operator.conten.v_caleg', $kirim);
        }
    }
    public function calegprov_tps(Tps $id)
    {
        $cek_status = Status::first();
        if ($cek_status->status == 0) {
            return view('operator.conten.v_error');
        } else if ($cek_status->status == 1) {
            $kirim['pilih_tps'] = $id;
            $desa_id = auth()->user()->desa_id;
            $kirim['tps'] = Tps::with('suaratidaksah')->where('desa_id', $desa_id)->orderBy('title', 'ASC')->get();
            $kirim['suaratidaksah'] = $id->suaratidaksah->dpr_prov ?? 0;
            $dapil_id = 2;
            $tps_id = $id->id;
            $kirim['partai'] = Partai::with(
                [
                    'caleg' => function ($query) use ($dapil_id, $tps_id) {
                        $tps = $tps_id;
                        $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut', 'ASC')->with(
                            ['suaracalegprov' => function ($query) use ($tps) {
                                $query->where('tps_id', '=', $tps);
                            }]
                        );
                    },
                    'suarapartaiprov' => function ($query) use ($tps_id) {
                        $tps = $tps_id;
                        $query->where('tps_id', '=', $tps);
                    }
                ]
            )->orderBy('no_urut', 'ASC')->get();
            return view('operator.conten.v_calegprov', $kirim);
        }
    }

    public function calegkab_tps(Tps $id)
    {
        $cek_status = Status::first();
        if ($cek_status->status == 0) {
            return view('operator.conten.v_error');
        } else if ($cek_status->status == 1) {
            $kirim['pilih_tps'] = $id;
            $desa_id = auth()->user()->desa_id;
            $kirim['tps'] = Tps::with('suaratidaksah')->where('desa_id', $desa_id)->orderBy('title', 'ASC')->get();
            $kirim['suaratidaksah'] = $id->suaratidaksah->dpr_kab ?? 0;
            $dapil_id = auth()->user()->desa->kecamatan->dapil_id;
            $tps_id = $id->id;
            $kirim['partai'] = Partai::with(
                [
                    'caleg' => function ($query) use ($dapil_id, $tps_id) {
                        $tps = $tps_id;
                        $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut', 'ASC')->with(
                            ['suaracalegkab' =>
                            function ($query) use ($tps) {
                                $query->where('tps_id', '=', $tps);
                            }]
                        );
                    },
                    'suarapartaikab' => function ($query) use ($tps_id) {
                        $tps = $tps_id;
                        $query->where('tps_id', '=', $tps);
                    }
                ]
            )->orderBy('no_urut', 'ASC')->get();
            return view('operator.conten.v_calegkab', $kirim);
        }
    }
}
