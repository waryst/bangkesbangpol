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
use App\Models\Suaracaleg;
use App\Models\Suaracalegkab;
use App\Models\Suaracalegprov;
use App\Models\Suaracapres;
use App\Models\Tps;
use Illuminate\Http\Request;

class RekapSuaraController extends Controller
{
    public function rekapcapres($tipe,$id=''){
      
        if($tipe=='kab'){
            $kirim['ket']="kab";
            $kirim['daerah_pemilihan']="KABUPATEN PONOROGO";
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per Kecamatan";
            $kirim['data']=Kecamatan::with('suaracapres')->orderBy('title','ASC')->get();
            $kirim['data_capres']=Capres::with('suaracapres')->orderBy('no_urut','ASC')->get();
        }
        else if($tipe=='kec'){
            $kirim['ket']="kec";
            $kecamatan=Kecamatan::where('id', '=', $id)->first();
            $kirim['daerah_pemilihan']="<a href='".url('rekapcapres/kab/all')."'>Kabupaten Ponorogo </a> - Kecamatan ".$kecamatan->title;
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per Desa";

            $kirim['data']=Desa::with(['suaracapres'=> function ($query) use($id)
            {
                $query->where('kecamatan_id', '=', $id);
            }])->where('kecamatan_id',$id)->orderBy('title','ASC')->get();
            $kirim['data_capres']=Capres::with(['suaracapres'=> function ($query) use($id)
            {
                $query->where('kecamatan_id', '=', $id);
            }])->orderBy('no_urut','ASC')->get();       
        }
        else if($tipe=='desa'){
            $kirim['ket']="desa";
            $desa=Desa::with('kecamatan')->where('id', '=', $id)->first();
            $kirim['daerah_pemilihan']="<a href='".url('rekapcapres/kab/all')."'>Kabupaten Ponorogo </a>- <a href='".url('rekapcapres/kec/'.$desa->kecamatan->id)."'>Kecamatan ".$desa->kecamatan->title." </a> - Desa ".$desa->title;
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per TPS";
            $kirim['data']=Tps::with(['suaracapres'=> function ($query) use($id)
            {
                $query->where('desa_id', '=', $id);
            }])->where('desa_id',$id)->orderBy('title','ASC')->get();
            $kirim['data_capres']=Capres::with(['suaracapres'=> function ($query) use($id){
                $query->where('desa_id', '=', $id);
            }])->orderBy('no_urut','ASC')->get();
        }
        return view('admin.conten.v_rekapcapres',$kirim);    
    }
    public function rekapcagub($tipe,$id=''){
        if($tipe=='kab'){
            $kirim['ket']="kab";
            $kirim['daerah_pemilihan']="KABUPATEN PONOROGO";
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per Kecamatan";
            $kirim['data']=Kecamatan::with('suaracagub')->orderBy('title','ASC')->get();
            $kirim['data_cagub']=Cagub::with('suaracagub')->orderBy('no_urut','ASC')->get();
        }
        else if($tipe=='kec'){
            $kirim['ket']="kec";
            $kecamatan=Kecamatan::where('id', '=', $id)->first();
            $kirim['daerah_pemilihan']="<a href='".url('rekapcagub/kab/all')."'>Kabupaten Ponorogo </a> - Kecamatan ".$kecamatan->title;
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per Desa";
            $kirim['data']=Desa::with(['suaracagub'=> function ($query) use($id)
            {
                $query->where('kecamatan_id', '=', $id);
            }])->where('kecamatan_id',$id)->orderBy('title','ASC')->get();
            $kirim['data_cagub']=Cagub::with(['suaracagub'=> function ($query) use($id)
            {
                $query->where('kecamatan_id', '=', $id);
            }])->orderBy('no_urut','ASC')->get();       
        }
        else if($tipe=='desa'){
            $kirim['ket']="desa";
            $desa=Desa::with('kecamatan')->where('id', '=', $id)->first();
            $kirim['daerah_pemilihan']="<a href='".url('rekapcagub/kab/all')."'>Kabupaten Ponorogo </a>- <a href='".url('rekapcagub/kec/'.$desa->kecamatan->id)."'>Kecamatan ".$desa->kecamatan->title." </a> - Desa ".$desa->title;
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per TPS";
            $kirim['data']=Tps::with(['suaracagub'=> function ($query) use($id)
            {
                $query->where('desa_id', '=', $id);
            }])->where('desa_id',$id)->orderBy('title','ASC')->get();
            $kirim['data_cagub']=Cagub::with(['suaracagub'=> function ($query) use($id){
                $query->where('desa_id', '=', $id);
            }])->orderBy('no_urut','ASC')->get();
        }
        return view('admin.conten.v_rekapcagub',$kirim);    

    }
    public function rekapcabub($tipe,$id){
        if($tipe=='kab'){
            $kirim['daerah_pemilihan']="KABUPATEN PONOROGO";
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per Kecamatan";
            $kirim['ket']="kab";
            $kirim['data']=Kecamatan::with('suaracabub')->orderBy('title','ASC')->get();
            $kirim['data_cabub']=Cabub::with('suaracabub')->orderBy('no_urut','ASC')->get();
        }
        else if($tipe=='kec'){
            $kirim['ket']="kec";
            $kecamatan=Kecamatan::where('id', '=', $id)->first();
            $kirim['daerah_pemilihan']="<a href='".url('rekapcabub/kab/all')."'>Kabupaten Ponorogo </a> - Kecamatan ".$kecamatan->title;
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per Desa";
            $kirim['data']=Desa::with(['suaracabub'=> function ($query) use($id)
            {
                $query->where('kecamatan_id', '=', $id);
            }])->where('kecamatan_id',$id)->orderBy('title','ASC')->get();
            $kirim['data_cabub']=Cabub::with(['suaracabub'=> function ($query) use($id)
            {
                $query->where('kecamatan_id', '=', $id);
            }])->orderBy('no_urut','ASC')->get();       
        }
        else if($tipe=='desa'){
            $kirim['ket']="desa";
            $desa=Desa::with('kecamatan')->where('id', '=', $id)->first();
            $kirim['daerah_pemilihan']="<a href='".url('rekapcabub/kab/all')."'>Kabupaten Ponorogo </a>- <a href='".url('rekapcabub/kec/'.$desa->kecamatan->id)."'>Kecamatan ".$desa->kecamatan->title." </a> - Desa ".$desa->title;
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per TPS";
            $kirim['data']=Tps::with(['suaracabub'=> function ($query) use($id)
            {
                $query->where('desa_id', '=', $id);
            }])->where('desa_id',$id)->orderBy('title','ASC')->get();
            $kirim['data_cabub']=Cabub::with(['suaracabub'=> function ($query) use($id){
                $query->where('desa_id', '=', $id);
            }])->orderBy('no_urut','ASC')->get();
        }
        return view('admin.conten.v_rekapcabub',$kirim);       
    }
    public function rekapdpd($tipe,$id){
        if($tipe=='kab'){
            $kirim['daerah_pemilihan']="KABUPATEN PONOROGO";
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per Kecamatan";
            $kirim['ket']="kab";
            $kirim['data']=Kecamatan::with('suaradpd')->orderBy('title','ASC')->get();
            $kirim['data_dpd']=Dpd::with('suaradpd')->orderBy('no_urut','ASC')->get();
        }
        else if($tipe=='kec'){
            $kirim['ket']="kec";
            $kecamatan=Kecamatan::where('id', '=', $id)->first();
            $kirim['daerah_pemilihan']="<a href='".url('rekapdpd/kab/all')."'>Kabupaten Ponorogo </a> - Kecamatan ".$kecamatan->title;
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per Desa";
            $kirim['data']=Desa::with(['suaradpd'=> function ($query) use($id)
            {
                $query->where('kecamatan_id', '=', $id);
            }])->where('kecamatan_id',$id)->orderBy('title','ASC')->get();
            $kirim['data_dpd']=Dpd::with(['suaradpd'=> function ($query) use($id)
            {
                $query->where('kecamatan_id', '=', $id);
            }])->orderBy('no_urut','ASC')->get();       
        }
        else if($tipe=='desa'){
            $kirim['ket']="desa";
            $desa=Desa::with('kecamatan')->where('id', '=', $id)->first();
            $kirim['daerah_pemilihan']="<a href='".url('rekapdpd/kab/all')."'>Kabupaten Ponorogo </a>- <a href='".url('rekapdpd/kec/'.$desa->kecamatan->id)."'>Kecamatan ".$desa->kecamatan->title." </a> - Desa ".$desa->title;
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per TPS";
            $kirim['data']=Tps::with(['suaradpd'=> function ($query) use($id)
            {
                $query->where('desa_id', '=', $id);
            }])->where('desa_id',$id)->orderBy('title','ASC')->get();
            $kirim['data_dpd']=Dpd::with(['suaradpd'=> function ($query) use($id){
                $query->where('desa_id', '=', $id);
            }])->orderBy('no_urut','ASC')->get();
        }
        return view('admin.conten.v_rekapdpd',$kirim);       
    }
    public function rekapcalegri($tipe,$id){
        if($tipe=='kab'){
            $kirim['daerah_pemilihan']="KABUPATEN PONOROGO";
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per Kecamatan";
            $kirim['ket']="kab";
            $kirim['headers']=Kecamatan::orderBy('title','ASC')->get();
            $dapil_id=1;
            $kirim['data']=Partai::with
            ([
                'suaracaleg'=>function ($query) use($id){
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                    ->groupBy('partai_id');
                },
                'suarapartai' =>function ($query) {
                    $query
                    ->selectRaw('sum(jumlah) as jumlah,partai_id,kecamatan_id')
                    ->groupBy('kecamatan_id')
                    ->groupBy('partai_id');
                },
                'caleg.suaracaleg', 'caleg' => function ($query)use ($dapil_id){
                    $query->whereIn('dapil_id', [$dapil_id]);
                }
            ])
            ->orderBy('no_urut','ASC')->get();  
        }
        else if($tipe=='kec'){
            $kirim['ket']="kec";
            $kirim['kecamatan']=Kecamatan::where('id', '=', $id)->first();
            $kirim['daerah_pemilihan']="<a href='".url('rekapcalegri/kab/all')."'>Kabupaten Ponorogo </a> - Kecamatan ".$kirim['kecamatan']->title;
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per Desa";          
            $kirim['headers']=Desa::where('kecamatan_id', '=', $id)->orderBy('title','ASC')->get();  
            $dapil_id=1;
            $kirim['data']=Partai::with
            ([
                'suaracaleg'=>function ($query) use($id){
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                    ->where('kecamatan_id','=',$id)
                    ->groupBy('partai_id');
                },
                'suarapartai' =>function ($query) {
                    $query
                    ->selectRaw('sum(jumlah) as jumlah,partai_id,desa_id')
                    ->groupBy('desa_id')
                    ->groupBy('partai_id');
                },
                'caleg' =>function ($query) use ($dapil_id) {
                    $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut','ASC');
                },
                'caleg.suaracaleg'
                ])->orderBy('no_urut','ASC')->get();

        }
        else if($tipe=='desa'){
            $kirim['ket']="desa";
            $kirim['desa']=Desa::with('kecamatan')->where('id', '=', $id)->first();
            $kirim['daerah_pemilihan']="<a href='".url('rekapcalegri/kab/all')."'>Kabupaten Ponorogo </a>- <a href='".url('rekapcalegri/kec/'.$kirim['desa']->kecamatan->id)."'>Kecamatan ".$kirim['desa']->kecamatan->title." </a> - Desa ".$kirim['desa']->title;
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per TPS";
            $kirim['headers']=Tps::where('desa_id', '=', $id)->orderBy('title','ASC')->get();
            $dapil_id=1;
            $kirim['data']=Partai::with
            ([
                'suaracaleg'=>function ($query) use($id){
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                    ->where('desa_id','=',$id)
                    ->groupBy('partai_id');
                },
                'suarapartai' =>function ($query) {
                    $query
                    ->selectRaw('sum(jumlah) as jumlah,partai_id,tps_id')
                    ->groupBy('tps_id')
                    ->groupBy('partai_id');
                },
                'caleg.suaracaleg','caleg' =>function ($query) use ($dapil_id) {
                    $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut','ASC');
                }
            ])->orderBy('no_urut','ASC')->get();
        }
        return view('admin.conten.v_rekapcalegri',$kirim);       
    }
    public function rekapcalegprov($tipe,$id){
        if($tipe=='kab'){
            $kirim['daerah_pemilihan']="KABUPATEN PONOROGO";
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per Kecamatan";
            $kirim['ket']="kab";
            $kirim['headers']=Kecamatan::orderBy('title','ASC')->get();
            $dapil_id=2;
            $kirim['data']=Partai::with
            ([
                'suaracalegprov'=>function ($query) use($id){
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                    ->groupBy('partai_id');
                },
                'suarapartaiprov' =>function ($query) {
                    $query
                    ->selectRaw('sum(jumlah) as jumlah,partai_id,kecamatan_id')
                    ->groupBy('kecamatan_id')
                    ->groupBy('partai_id');
                },
                'caleg.suaracalegprov', 'caleg' => function ($query)use ($dapil_id){
                    $query->whereIn('dapil_id', [$dapil_id]);
                }
            ])
            ->orderBy('no_urut','ASC')->get();  
        }
        else if($tipe=='kec'){
            $kirim['ket']="kec";
            $kirim['kecamatan']=Kecamatan::where('id', '=', $id)->first();
            $kirim['daerah_pemilihan']="<a href='".url('rekapcalegprov/kab/all')."'>Kabupaten Ponorogo </a> - Kecamatan ".$kirim['kecamatan']->title;
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per Desa"; 
            $kirim['headers']=Desa::where('kecamatan_id', '=', $id)->orderBy('title','ASC')->get();  
            $dapil_id=2;
            $kirim['data']=Partai::with
            ([
                'suaracalegprov'=>function ($query) use($id){
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                    ->where('kecamatan_id','=',$id)
                    ->groupBy('partai_id');
                },
                'suarapartaiprov' =>function ($query) {
                    $query
                    ->selectRaw('sum(jumlah) as jumlah,partai_id,desa_id')
                    ->groupBy('desa_id')
                    ->groupBy('partai_id');
                },
                'caleg' =>function ($query) use ($dapil_id) {
                    $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut','ASC');
                },
                'caleg.suaracalegprov'
                ])->orderBy('no_urut','ASC')->get();

        }
        else if($tipe=='desa'){
            $kirim['ket']="desa";
            $kirim['desa']=Desa::with('kecamatan')->where('id', '=', $id)->first();
            $kirim['daerah_pemilihan']="<a href='".url('rekapcalegprov/kab/all')."'>Kabupaten Ponorogo </a>- <a href='".url('rekapcalegprov/kec/'.$kirim['desa']->kecamatan->id)."'>Kecamatan ".$kirim['desa']->kecamatan->title." </a> - Desa ".$kirim['desa']->title;
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per TPS";
            $kirim['headers']=Tps::where('desa_id', '=', $id)->orderBy('title','ASC')->get();
            $dapil_id=2;
            $kirim['data']=Partai::with
            ([
                'suaracalegprov'=>function ($query) use($id){
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                    ->where('desa_id','=',$id)
                    ->groupBy('partai_id');
                },
                'suarapartaiprov' =>function ($query) {
                    $query
                    ->selectRaw('sum(jumlah) as jumlah,partai_id,tps_id')
                    ->groupBy('tps_id')
                    ->groupBy('partai_id');
                },
                'caleg.suaracalegprov','caleg' =>function ($query) use ($dapil_id) {
                    $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut','ASC');
                }
            ])->orderBy('no_urut','ASC')->get();
        }
        return view('admin.conten.v_rekapcalegprov',$kirim);       
    }
    public function rekapcalegkab($tipe,$id){
        if($tipe=='kab'){
            $kirim['daerah_pemilihan']="KABUPATEN PONOROGO";
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per Kecamatan";
            $kirim['ket']="kab";
            $kirim['headers']=Kecamatan::orderBy('title','ASC')->get();
            $kirim['data']=Partai::with
            ([
                'suaracalegkab'=>function ($query) use($id){
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                    ->groupBy('partai_id');
                },
                'suarapartaikab' =>function ($query) {
                    $query
                    ->selectRaw('sum(jumlah) as jumlah,partai_id,kecamatan_id')
                    ->groupBy('kecamatan_id')
                    ->groupBy('partai_id');
                },
                'caleg.suaracalegkab', 'caleg' => function ($query){
                    $query->whereNotIn('dapil_id', [1,2]);
                }
            ])
            ->orderBy('no_urut','ASC')->get();  
        }
        else if($tipe=='kec'){
            $kirim['ket']="kec";
            $kecamatan=Kecamatan::where('id', '=', $id)->first();
            $kirim['daerah_pemilihan']="<a href='".url('rekapcalegkab/kab/all')."'>Kabupaten Ponorogo </a> - Kecamatan ".$kecamatan->title;
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per Desa";  
            $kirim['headers']=Desa::where('kecamatan_id', '=', $id)->orderBy('title','ASC')->get();
            $dapil_id=$kecamatan->dapil_id;
            $kirim['data']=Partai::with
            ([
                'suaracalegkab'=>function ($query) use($id){
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                    ->where('kecamatan_id','=',$id)
                    ->groupBy('partai_id');
                },
                'suarapartaikab' =>function ($query) {
                    $query
                    ->selectRaw('sum(jumlah) as jumlah,partai_id,desa_id')
                    ->groupBy('desa_id')
                    ->groupBy('partai_id');
                },
                'caleg' =>function ($query) use ($dapil_id) {
                    $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut','ASC');
                },
                'caleg.suaracalegkab'
                ])->orderBy('no_urut','ASC')->get();
        }
        else if($tipe=='desa'){
            $kirim['ket']="desa";
            $desa=Desa::with('kecamatan')->where('id', '=', $id)->first();
            $kirim['daerah_pemilihan']="<a href='".url('rekapcalegkab/kab/all')."'>Kabupaten Ponorogo </a>- <a href='".url('rekapcalegkab/kec/'.$desa->kecamatan->id)."'>Kecamatan ".$desa->kecamatan->title." </a> - Desa ".$desa->title;
            $kirim['tabel_pemilihan']="Data Perolehan Suara Per TPS";
            $kirim['headers']=Tps::where('desa_id', '=', $id)->orderBy('title','ASC')->get();
            $dapil_id=$desa->kecamatan->dapil_id;
            $kirim['data']=Partai::with
            ([
                'suaracalegkab'=>function ($query) use($id){
                    $query->selectRaw('sum(jumlah) as total,partai_id')
                    ->where('desa_id','=',$id)
                    ->groupBy('partai_id');
                },
                'suarapartaikab' =>function ($query) {
                    $query
                    ->selectRaw('sum(jumlah) as jumlah,partai_id,tps_id')
                    ->groupBy('tps_id')
                    ->groupBy('partai_id');
                },
                'caleg.suaracalegkab','caleg' =>function ($query) use ($dapil_id) {
                    $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut','ASC');
                }
            ])->orderBy('no_urut','ASC')->get();
        }
        return view('admin.conten.v_rekapcalegkab',$kirim);       
    }
}
