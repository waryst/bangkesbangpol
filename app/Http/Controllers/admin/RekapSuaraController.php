<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cabub;
use App\Models\Cagub;
use App\Models\Capres;
use App\Models\Desa;
use App\Models\Dpd;
use App\Models\Kecamatan;
use App\Models\Partai;
use App\Models\Suaracabub;
use App\Models\Suaracagub;
use App\Models\Suaracaleg;
use App\Models\Suaracalegkab;
use App\Models\Suaracalegprov;
use App\Models\Suaracapres;
use App\Models\Suaradpd;
use App\Models\Suarapartaikab;
use App\Models\Suarapartaiprov;
use App\Models\Suarapartairi;
use App\Models\Suaratidaksah;
use App\Models\Tps;
use Illuminate\Http\Request;

class RekapSuaraController extends Controller
{
    public function rekapcapres($tipe, $id = '')
    {

        if ($tipe == 'kab') {
            $kirim['ket'] = "kab";
            $kirim['daerah_pemilihan'] = "KABUPATEN PONOROGO";
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per Kecamatan";
            $kirim['data'] = Kecamatan::with('suaracapres')->orderBy('title', 'ASC')->get();
            $kirim['data_capres'] = Capres::withSum('suaracapres', 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracapres::sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::sum('presiden');
        } else if ($tipe == 'kec') {
            $kirim['ket'] = "kec";
            $kecamatan = Kecamatan::where('id', '=', $id)->first();
            $kirim['daerah_pemilihan'] = "<a href='" . url('rekapcapres/kab/all') . "'>Kabupaten Ponorogo </a> - Kecamatan " . $kecamatan->title;
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per Desa";
            $kirim['data'] = Desa::with(['suaracapres' => function ($query) use ($id) {
                $query->where('kecamatan_id', '=', $id);
            }])->where('kecamatan_id', $id)->orderBy('title', 'ASC')->get();
            $kirim['data_capres'] = Capres::withSum(['suaracapres' => function ($query) use ($id) {
                $query->where('kecamatan_id', '=', $id);
            }], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracapres::where('kecamatan_id', '=', $id)->sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::where('kecamatan_id', '=', $id)->sum('presiden');
        } else if ($tipe == 'desa') {
            $kirim['ket'] = "desa";
            $desa = Desa::with('kecamatan')->where('id', '=', $id)->first();
            $kirim['daerah_pemilihan'] = "<a href='" . url('rekapcapres/kab/all') . "'>Kabupaten Ponorogo </a>- <a href='" . url('rekapcapres/kec/' . $desa->kecamatan->id) . "'>Kecamatan " . $desa->kecamatan->title . " </a> - Desa " . $desa->title;
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per TPS";
            $kirim['data'] = Tps::with(['suaracapres' => function ($query) use ($id) {
                $query->where('desa_id', '=', $id);
            }])->where('desa_id', $id)->orderBy('title', 'ASC')->get();
            $kirim['data_capres'] = Capres::withSum(['suaracapres' => function ($query) use ($id) {
                $query->where('desa_id', '=', $id);
            }], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracapres::where('desa_id', '=', $id)->sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::where('desa_id', '=', $id)->sum('presiden');
        }
        return view('admin.conten.v_rekapcapres', $kirim);
    }
    public function rekapcagub($tipe, $id = '')
    {
        if ($tipe == 'kab') {
            $kirim['ket'] = "kab";
            $kirim['daerah_pemilihan'] = "KABUPATEN PONOROGO";
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per Kecamatan";
            $kirim['data'] = Kecamatan::with('suaracagub')->orderBy('title', 'ASC')->get();
            $kirim['data_cagub'] = Cagub::withSum('suaracagub', 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracagub::sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::sum('gubernur');
        } else if ($tipe == 'kec') {
            $kirim['ket'] = "kec";
            $kecamatan = Kecamatan::where('id', '=', $id)->first();
            $kirim['daerah_pemilihan'] = "<a href='" . url('rekapcagub/kab/all') . "'>Kabupaten Ponorogo </a> - Kecamatan " . $kecamatan->title;
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per Desa";
            $kirim['data'] = Desa::with(['suaracagub' => function ($query) use ($id) {
                $query->where('kecamatan_id', '=', $id);
            }])->where('kecamatan_id', $id)->orderBy('title', 'ASC')->get();
            $kirim['data_cagub'] = Cagub::withSum(['suaracagub' => function ($query) use ($id) {
                $query->where('kecamatan_id', '=', $id);
            }], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracagub::where('kecamatan_id', '=', $id)->sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::where('kecamatan_id', '=', $id)->sum('gubernur');
        } else if ($tipe == 'desa') {
            $kirim['ket'] = "desa";
            $desa = Desa::with('kecamatan')->where('id', '=', $id)->first();
            $kirim['daerah_pemilihan'] = "<a href='" . url('rekapcagub/kab/all') . "'>Kabupaten Ponorogo </a>- <a href='" . url('rekapcagub/kec/' . $desa->kecamatan->id) . "'>Kecamatan " . $desa->kecamatan->title . " </a> - Desa " . $desa->title;
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per TPS";
            $kirim['data'] = Tps::with(['suaracagub' => function ($query) use ($id) {
                $query->where('desa_id', '=', $id);
            }])->where('desa_id', $id)->orderBy('title', 'ASC')->get();
            $kirim['data_cagub'] = Cagub::withSum(['suaracagub' => function ($query) use ($id) {
                $query->where('desa_id', '=', $id);
            }], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracagub::where('desa_id', '=', $id)->sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::where('desa_id', '=', $id)->sum('gubernur');
        }
        return view('admin.conten.v_rekapcagub', $kirim);
    }
    public function rekapcabub($tipe, $id)
    {
        if ($tipe == 'kab') {
            $kirim['daerah_pemilihan'] = "KABUPATEN PONOROGO";
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per Kecamatan";
            $kirim['ket'] = "kab";
            $kirim['data'] = Kecamatan::with('suaracabub')->orderBy('title', 'ASC')->get();
            $kirim['data_cabub'] = Cabub::withSum('suaracabub', 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracabub::sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::sum('bupati');
        } else if ($tipe == 'kec') {
            $kirim['ket'] = "kec";
            $kecamatan = Kecamatan::where('id', '=', $id)->first();
            $kirim['daerah_pemilihan'] = "<a href='" . url('rekapcabub/kab/all') . "'>Kabupaten Ponorogo </a> - Kecamatan " . $kecamatan->title;
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per Desa";
            $kirim['data'] = Desa::with(['suaracabub' => function ($query) use ($id) {
                $query->where('kecamatan_id', '=', $id);
            }])->where('kecamatan_id', $id)->orderBy('title', 'ASC')->get();
            $kirim['data_cabub'] = Cabub::withSum(['suaracabub' => function ($query) use ($id) {
                $query->where('kecamatan_id', '=', $id);
            }], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracabub::where('kecamatan_id', '=', $id)->sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::where('kecamatan_id', '=', $id)->sum('bupati');
        } else if ($tipe == 'desa') {
            $kirim['ket'] = "desa";
            $desa = Desa::with('kecamatan')->where('id', '=', $id)->first();
            $kirim['daerah_pemilihan'] = "<a href='" . url('rekapcabub/kab/all') . "'>Kabupaten Ponorogo </a>- <a href='" . url('rekapcabub/kec/' . $desa->kecamatan->id) . "'>Kecamatan " . $desa->kecamatan->title . " </a> - Desa " . $desa->title;
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per TPS";
            $kirim['data'] = Tps::with(['suaracabub' => function ($query) use ($id) {
                $query->where('desa_id', '=', $id);
            }])->where('desa_id', $id)->orderBy('title', 'ASC')->get();
            $kirim['data_cabub'] = Cabub::withSum(['suaracabub' => function ($query) use ($id) {
                $query->where('desa_id', '=', $id);
            }], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracabub::where('desa_id', '=', $id)->sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::where('desa_id', '=', $id)->sum('bupati');
        }
        return view('admin.conten.v_rekapcabub', $kirim);
    }
    public function rekapdpd($tipe, $id)
    {
        if ($tipe == 'kab') {
            $kirim['daerah_pemilihan'] = "KABUPATEN PONOROGO";
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per Kecamatan";
            $kirim['ket'] = "kab";
            $kirim['data'] = Kecamatan::with('suaradpd')->orderBy('title', 'ASC')->get();
            $kirim['data_dpd'] = Dpd::withSum('suaradpd', 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaradpd::sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::sum('dpd');
        } else if ($tipe == 'kec') {
            $kirim['ket'] = "kec";
            $kecamatan = Kecamatan::where('id', '=', $id)->first();
            $kirim['daerah_pemilihan'] = "<a href='" . url('rekapdpd/kab/all') . "'>Kabupaten Ponorogo </a> - Kecamatan " . $kecamatan->title;
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per Desa";
            $kirim['data'] = Desa::with(['suaradpd' => function ($query) use ($id) {
                $query->where('kecamatan_id', '=', $id);
            }])->where('kecamatan_id', $id)->orderBy('title', 'ASC')->get();
            $kirim['data_dpd'] = Dpd::withSum(['suaradpd' => function ($query) use ($id) {
                $query->where('kecamatan_id', '=', $id);
            }], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaradpd::where('kecamatan_id', '=', $id)->sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::where('kecamatan_id', '=', $id)->sum('dpd');
        } else if ($tipe == 'desa') {
            $kirim['ket'] = "desa";
            $desa = Desa::with('kecamatan')->where('id', '=', $id)->first();
            $kirim['daerah_pemilihan'] = "<a href='" . url('rekapdpd/kab/all') . "'>Kabupaten Ponorogo </a>- <a href='" . url('rekapdpd/kec/' . $desa->kecamatan->id) . "'>Kecamatan " . $desa->kecamatan->title . " </a> - Desa " . $desa->title;
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per TPS";
            $kirim['data'] = Tps::with(['suaradpd' => function ($query) use ($id) {
                $query->where('desa_id', '=', $id);
            }])->where('desa_id', $id)->orderBy('title', 'ASC')->get();
            $kirim['data_dpd'] = Dpd::withSum(['suaradpd' => function ($query) use ($id) {
                $query->where('desa_id', '=', $id);
            }], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaradpd::where('desa_id', '=', $id)->sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::where('desa_id', '=', $id)->sum('dpd');
        }
        return view('admin.conten.v_rekapdpd', $kirim);
    }
    public function rekapcalegri($tipe, $id)
    {
        if ($tipe == 'kab') {
            $kirim['daerah_pemilihan'] = "KABUPATEN PONOROGO";
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per Kecamatan";
            $kirim['ket'] = "kab";
            $kirim['headers'] = Kecamatan::orderBy('title', 'ASC')->get();
            $dapil_id = 1;
            $kirim['data'] = Partai::with(
                [
                    'suaracaleg' => function ($query) use ($id) {
                        $query->selectRaw('sum(jumlah) as total,partai_id')
                            ->groupBy('partai_id');
                    },
                    'suarapartai' => function ($query) {
                        $query->selectRaw('sum(jumlah) as jumlah,partai_id,kecamatan_id')
                            ->groupBy('kecamatan_id')
                            ->groupBy('partai_id');
                    },
                    'caleg.suaracaleg',
                    'caleg' => function ($query) use ($dapil_id) {
                        $query->whereIn('dapil_id', [$dapil_id]);
                    }
                ]
            )->withSum([
                'suarapartai' => function ($query) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,kecamatan_id')
                        ->groupBy('partai_id');
                }

            ], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracaleg::sum('jumlah') + Suarapartairi::sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::sum('dpr_ri');
        } else if ($tipe == 'kec') {
            $kirim['ket'] = "kec";
            $kirim['kecamatan'] = Kecamatan::where('id', '=', $id)->first();
            $kirim['daerah_pemilihan'] = "<a href='" . url('rekapcalegri/kab/all') . "'>Kabupaten Ponorogo </a> - Kecamatan " . $kirim['kecamatan']->title;
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per Desa";
            $kirim['headers'] = Desa::where('kecamatan_id', '=', $id)->orderBy('title', 'ASC')->get();
            $dapil_id = 1;
            $kirim['data'] = Partai::with([
                'suaracaleg' => function ($query) use ($id) {
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                        ->where('kecamatan_id', '=', $id)
                        ->groupBy('partai_id');
                },
                'suarapartai' => function ($query) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,desa_id')
                        ->groupBy('desa_id')
                        ->groupBy('partai_id');
                },
                'caleg' => function ($query) use ($dapil_id) {
                    $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut', 'ASC');
                },
                'caleg.suaracaleg'
            ])->withSum([
                'suarapartai' => function ($query) use ($id) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,kecamatan_id')
                        ->where('kecamatan_id', '=', $id)
                        ->groupBy('partai_id');
                }

            ], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracaleg::where('kecamatan_id', '=', $id)->sum('jumlah') + Suarapartairi::where('kecamatan_id', '=', $id)->sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::where('kecamatan_id', '=', $id)->sum('dpr_ri');
        } else if ($tipe == 'desa') {
            $kirim['ket'] = "desa";
            $kirim['desa'] = Desa::with('kecamatan')->where('id', '=', $id)->first();
            $kirim['daerah_pemilihan'] = "<a href='" . url('rekapcalegri/kab/all') . "'>Kabupaten Ponorogo </a>- <a href='" . url('rekapcalegri/kec/' . $kirim['desa']->kecamatan->id) . "'>Kecamatan " . $kirim['desa']->kecamatan->title . " </a> - Desa " . $kirim['desa']->title;
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per TPS";
            $kirim['headers'] = Tps::where('desa_id', '=', $id)->orderBy('title', 'ASC')->get();
            $dapil_id = 1;
            $kirim['data'] = Partai::with([
                'suaracaleg' => function ($query) use ($id) {
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                        ->where('desa_id', '=', $id)
                        ->groupBy('partai_id');
                },
                'suarapartai' => function ($query) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,tps_id')
                        ->groupBy('tps_id')
                        ->groupBy('partai_id');
                },
                'caleg.suaracaleg', 'caleg' => function ($query) use ($dapil_id) {
                    $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut', 'ASC');
                }
            ])->withSum([
                'suarapartai' => function ($query) use ($id) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,desa_id')
                        ->where('desa_id', '=', $id)
                        ->groupBy('partai_id');
                }

            ], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracaleg::where('desa_id', '=', $id)->sum('jumlah') + Suarapartairi::where('desa_id', '=', $id)->sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::where('desa_id', '=', $id)->sum('dpr_ri');
        }
        return view('admin.conten.v_rekapcalegri', $kirim);
    }
    public function rekapcalegprov($tipe, $id)
    {
        if ($tipe == 'kab') {
            $kirim['daerah_pemilihan'] = "KABUPATEN PONOROGO";
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per Kecamatan";
            $kirim['ket'] = "kab";
            $kirim['headers'] = Kecamatan::orderBy('title', 'ASC')->get();
            $dapil_id = 2;
            $kirim['data'] = Partai::with([
                'suaracalegprov' => function ($query) use ($id) {
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                        ->groupBy('partai_id');
                },
                'suarapartaiprov' => function ($query) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,kecamatan_id')
                        ->groupBy('kecamatan_id')
                        ->groupBy('partai_id');
                },
                'caleg.suaracalegprov', 'caleg' => function ($query) use ($dapil_id) {
                    $query->whereIn('dapil_id', [$dapil_id]);
                }
            ])->withSum([
                'suarapartaiprov' => function ($query) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,kecamatan_id')
                        ->groupBy('partai_id');
                }

            ], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracalegprov::sum('jumlah') + Suarapartaiprov::sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::sum('dpr_prov');
        } else if ($tipe == 'kec') {
            $kirim['ket'] = "kec";
            $kirim['kecamatan'] = Kecamatan::where('id', '=', $id)->first();
            $kirim['daerah_pemilihan'] = "<a href='" . url('rekapcalegprov/kab/all') . "'>Kabupaten Ponorogo </a> - Kecamatan " . $kirim['kecamatan']->title;
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per Desa";
            $kirim['headers'] = Desa::where('kecamatan_id', '=', $id)->orderBy('title', 'ASC')->get();
            $dapil_id = 2;
            $kirim['data'] = Partai::with([
                'suaracalegprov' => function ($query) use ($id) {
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                        ->where('kecamatan_id', '=', $id)
                        ->groupBy('partai_id');
                },
                'suarapartaiprov' => function ($query) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,desa_id')
                        ->groupBy('desa_id')
                        ->groupBy('partai_id');
                },
                'caleg' => function ($query) use ($dapil_id) {
                    $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut', 'ASC');
                },
                'caleg.suaracalegprov'
            ])->withSum([
                'suarapartaiprov' => function ($query) use ($id) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,kecamatan_id')
                        ->where('kecamatan_id', '=', $id)
                        ->groupBy('partai_id');
                }

            ], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracalegprov::where('kecamatan_id', '=', $id)->sum('jumlah') + Suarapartaiprov::where('kecamatan_id', '=', $id)->sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::where('kecamatan_id', '=', $id)->sum('dpr_prov');
        } else if ($tipe == 'desa') {
            $kirim['ket'] = "desa";
            $kirim['desa'] = Desa::with('kecamatan')->where('id', '=', $id)->first();
            $kirim['daerah_pemilihan'] = "<a href='" . url('rekapcalegprov/kab/all') . "'>Kabupaten Ponorogo </a>- <a href='" . url('rekapcalegprov/kec/' . $kirim['desa']->kecamatan->id) . "'>Kecamatan " . $kirim['desa']->kecamatan->title . " </a> - Desa " . $kirim['desa']->title;
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per TPS";
            $kirim['headers'] = Tps::where('desa_id', '=', $id)->orderBy('title', 'ASC')->get();
            $dapil_id = 2;
            $kirim['data'] = Partai::with([
                'suaracalegprov' => function ($query) use ($id) {
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                        ->where('desa_id', '=', $id)
                        ->groupBy('partai_id');
                },
                'suarapartaiprov' => function ($query) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,tps_id')
                        ->groupBy('tps_id')
                        ->groupBy('partai_id');
                },
                'caleg.suaracalegprov', 'caleg' => function ($query) use ($dapil_id) {
                    $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut', 'ASC');
                }
            ])->withSum([
                'suarapartaiprov' => function ($query) use ($id) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,desa_id')
                        ->where('desa_id', '=', $id)
                        ->groupBy('partai_id');
                }

            ], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracalegprov::where('desa_id', '=', $id)->sum('jumlah') + Suarapartaiprov::where('desa_id', '=', $id)->sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::where('desa_id', '=', $id)->sum('dpr_prov');
        }
        return view('admin.conten.v_rekapcalegprov', $kirim);
    }
    public function rekapcalegkab($tipe, $id)
    {
        if ($tipe == 'kab') {
            $kirim['daerah_pemilihan'] = "KABUPATEN PONOROGO";
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per Kecamatan";
            $kirim['ket'] = "kab";
            $kirim['headers'] = Kecamatan::orderBy('title', 'ASC')->get();
            $kirim['data'] = Partai::with([
                'suaracalegkab' => function ($query) use ($id) {
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                        ->groupBy('partai_id');
                },
                'suarapartaikab' => function ($query) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,kecamatan_id')
                        ->groupBy('kecamatan_id')
                        ->groupBy('partai_id');
                },
                'caleg.suaracalegkab', 'caleg' => function ($query) {
                    $query->whereNotIn('dapil_id', [1, 2]);
                }
            ])->withSum([
                'suarapartaikab' => function ($query) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,kecamatan_id')
                        ->groupBy('partai_id');
                }

            ], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracalegkab::sum('jumlah') + Suarapartaikab::sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::sum('dpr_kab');
        } else if ($tipe == 'kec') {
            $kirim['ket'] = "kec";
            $kecamatan = Kecamatan::where('id', '=', $id)->first();
            $kirim['daerah_pemilihan'] = "<a href='" . url('rekapcalegkab/kab/all') . "'>Kabupaten Ponorogo </a> - Kecamatan " . $kecamatan->title;
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per Desa";
            $kirim['headers'] = Desa::where('kecamatan_id', '=', $id)->orderBy('title', 'ASC')->get();
            $dapil_id = $kecamatan->dapil_id;
            $kirim['data'] = Partai::with([
                'suaracalegkab' => function ($query) use ($id) {
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                        ->where('kecamatan_id', '=', $id)
                        ->groupBy('partai_id');
                },
                'suarapartaikab' => function ($query) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,desa_id')
                        ->groupBy('desa_id')
                        ->groupBy('partai_id');
                },
                'caleg' => function ($query) use ($dapil_id) {
                    $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut', 'ASC');
                },
                'caleg.suaracalegkab'
            ])->withSum([
                'suarapartaikab' => function ($query) use ($id) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,kecamatan_id')
                        ->where('kecamatan_id', '=', $id)
                        ->groupBy('partai_id');
                }

            ], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracalegkab::where('kecamatan_id', '=', $id)->sum('jumlah') + Suarapartaikab::where('kecamatan_id', '=', $id)->sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::where('kecamatan_id', '=', $id)->sum('dpr_kab');
        } else if ($tipe == 'desa') {
            $kirim['ket'] = "desa";
            $desa = Desa::with('kecamatan')->where('id', '=', $id)->first();
            $kirim['daerah_pemilihan'] = "<a href='" . url('rekapcalegkab/kab/all') . "'>Kabupaten Ponorogo </a>- <a href='" . url('rekapcalegkab/kec/' . $desa->kecamatan->id) . "'>Kecamatan " . $desa->kecamatan->title . " </a> - Desa " . $desa->title;
            $kirim['tabel_pemilihan'] = "Data Perolehan Suara Per TPS";
            $kirim['headers'] = Tps::where('desa_id', '=', $id)->orderBy('title', 'ASC')->get();
            $dapil_id = $desa->kecamatan->dapil_id;
            $kirim['data'] = Partai::with([
                'suaracalegkab' => function ($query) use ($id) {
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                        ->where('desa_id', '=', $id)
                        ->groupBy('partai_id');
                },
                'suarapartaikab' => function ($query) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,tps_id')
                        ->groupBy('tps_id')
                        ->groupBy('partai_id');
                },
                'caleg.suaracalegkab', 'caleg' => function ($query) use ($dapil_id) {
                    $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut', 'ASC');
                }
            ])->withSum([
                'suarapartaikab' => function ($query) use ($id) {
                    $query
                        ->selectRaw('sum(jumlah) as jumlah,partai_id,desa_id')
                        ->where('desa_id', '=', $id)
                        ->groupBy('partai_id');
                }

            ], 'jumlah')->orderBy('no_urut', 'ASC')->get();
            $kirim['suarasah'] = Suaracalegkab::where('desa_id', '=', $id)->sum('jumlah') + Suarapartaikab::where('desa_id', '=', $id)->sum('jumlah');
            $kirim['suaratidaksah'] = Suaratidaksah::where('desa_id', '=', $id)->sum('dpr_kab');
        }
        return view('admin.conten.v_rekapcalegkab', $kirim);
    }
}
