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
            $kirim['data']=Kecamatan::with('suaracaleg')->orderBy('title','ASC')->get();
            $dapil_id=1;
            $kirim['data_partai']=Partai::with(['caleg.suaracaleg','caleg' =>
            function ($query) use ($dapil_id)  {
                $query->where('dapil_id', '=', $dapil_id)->orderBy('no_urut','ASC');
            } ])->orderBy('no_urut','ASC')->get();

            $kirim['suara']=Suaracaleg::select('Suaracalegs.*','Calegs.nama','partais.id as partai_id','partais.singkatan')
            ->Join('Calegs', 'Suaracalegs.caleg_id', '=', 'Calegs.id')
            ->Join('partais', 'Calegs.partai_id', '=', 'partais.id')
            ->get();
            // dd($kirim['partai'][0]->nama);    
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
        return view('admin.conten.v_rekapcalegri',$kirim);       
    }
}
