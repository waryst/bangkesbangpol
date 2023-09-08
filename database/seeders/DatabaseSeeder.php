<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cabub;
use App\Models\Cagub;
use App\Models\Caleg;
use App\Models\Capres;
use App\Models\Desa;
use App\Models\Dpd;
use App\Models\Kecamatan;
use App\Models\Partai;
use App\Models\Tps;
use App\Models\Dapil;
use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Warist Amru Khoruddin',
            'desa_id' =>'123',
            'email' => 'admin',
            'role'=>'administrator',
            'password'=>Hash::make('admin'),
        ]);

        $kecamatan = array(
            "Babadan"=>array("Babadan","Bareng","Cekok","Gupolo","Japan","Kadipaten","Kertosari","Lembah","Ngunut","Patihan Wetan","Polorejo","Pondok","Purwosari","Sukosari","Trisono"),
            "Badegan"=>array("Badegan","Bandaralim","Biting","Dayakan","Kapuran","Karangan","Karangjoho","Tanjunggunung","Tanjungrejo","Watubonang"),
            "Balong"=>array("Bajang","Balong","Bulak","Bulukidul","Dadapan","Jalen","Karangan","Karangmojo","Karangpatihan","Muneng","Ngampel","Ngendut","Ngraket","Ngumpul","Pandak","Purworejo","Sedarat","Singkil","Sumberejo","Tatung"),
            "Bungkal"=>array("Bancar","Bedikulon","Bediwetan","Bekare","Belang","Bungkal","Bungu","Kalisat","Ketonggo","Koripan","Kunti","Kupuk","Kwajon","Munggu","Nambak","Padas","Pager","Pelem","Sambilawang"),
            "Jambon"=>array("Blembem","Bringinan","Bulu Lor","Jambon","Jonggol","Karanglo Kidul","Krebet","Menang","Poko","Pulosari","Sendang","Sidoharjo","Srandil"),
            "Jenangan"=>array("Jenangan","Jimbe","Kemiri","Mrican","Nglayang","Ngrupit","Panjeng","Paringan","Pintu","Plalangan","Sedah","Semanding","Setono","Singosaren","Sraten","Tanjungsari","Wates"),
            "Jetis"=>array("Coper","Jetis","Josari","Karanggebang","Kradenan","Kutukulon","Kutuwetan","Mojomati","Mojorejo","Ngasinan","Tegalsari","Turi","Winong","Wonoketro"),
            "Kauman"=>array("Bringin","Carat","Ciluk","Gabel","Kauman","Maron","Nglarangan","Ngrandu","Nongkodono","Pengkol","Plosojenar","Semanding","Somoroto","Sukosari","Tegalombo","Tosanan"),
            "Mlarak"=>array("Bajang","Candi","Gandu","Gontor","Jabung","Joresan","Kaponan","Mlarak","Ngrukem","Nglumpang","Serangan","Siwalan","Suren","Totokan","Tugu"),
            "Ngebel"=>array("Gondowido","Ngebel","Ngrogung","Pupus","Sahang","Sempu","Talun","Wagirlor"),
            "Ngrayun"=>array("Baosankidul","Baosanlor","Binade","Cepoko","Gedangan","Mrayan","Ngrayun","Selur","Sendang","Temon","Wonodadi"),
            "Ponorogo"=>array("Bangunsari","Banyudono","Beduri","Brotonegaran","Cokromenggalan","Jingglong","Kauman","Keniten","Kepatihan","Mangkujayan","Nologaten","Paju","Pakunden","Pinggirsari","Purbosuman","Surodikraman","Tamanarum","Tambakbayan","Tonatan"),
            "Pudak"=>array("Banjarjo","Bareng","Krisik","Pudakkulon","Pudakwetan","Tambang"),
            "Pulung"=>array("Banaran","Bedrug","Bekiring","Karangpatihan","Kesugihan","Munggung","Patik","Plunturan","Pomahan","Pulung","Pulung Merdiko","Serag","Sidoharjo","Singgahan","Tegalrejo","Wagirkidul","Wayang","Wotan"),
            "Sambit"=>array("Bancangan","Bangsalan","Bedingin","Besuki","Bulu","Campurejo","Campursari","Gajah","Jrakah","Kemuning","Maguwan","Ngadisanan","Nglewan","Sambit","Wilangan","Wringinanom"),
            "Sampung"=>array("Carangrejo","Gelangkulon","Glinggang","Jenangan","Karangwaluh","Kunti","Nglurup","Pagerukir","Pohijo","Ringinputih","Sampung","Tulung"),
            "Sawoo"=>array("Bondrang","Grogol","Ketro","Kori","Ngindeng","Pangkal","Prayungan","Sawoo","Sriti","Temon","Tempuran","Tugurejo","Tumpakpelem","Tumpuk"),
            "Siman"=>array("Beton","Brahu","Demangan","Jarak","Kepuhrubuh","Madusari","Mangunsuman","Manuk","Ngabar","Patihan Kidul","Pijeran","Ronosentanan","Ronowijayan","Sawuh","Sekaran","Siman","Tajug","Tranjang"),
            "Slahung"=>array("Broto","Caluk","Crabak","Duri","Galak","Gombang","Gundik","Janti","Jebeng","Kambeng","Menggare","Mojopitu","Nailan","Ngilo-ilo","Ngloning","Plancungan","Senepo","Simo","Slahung","Truneng","Tugurejo","Wates"),
            "Sooko"=>array("Bedoho","Jurug","Klepu","Ngadirojo","Sooko","Suru"),
            "Sukorejo"=>array("Bangunrejo","Gandukepuh","Gegeran","Gelanglor","Golan","Kalimalang","Karanglolor","Kedungbanteng","Kranggan","Lengkong","Morosari","Nambangrejo","Nampan","Prajegan","Serangan","Sidorejo","Sragi","Sukorejo")
        );
        $partai = array(
            "Partai Kebangkitan Bangsa"=>array("PKB"),
            "Partai Gerakan Indonesia Raya"=>array("Gerindra"),
            "Partai Demokrasi Indonesia Perjuangan"=>array("PDI Perjuangan"),
            "Partai Golongan Karya"=>array("Golkar"),
            "Partai Nasional Demokrat"=>array("Nasdem"),
            "Partai Buruh"=>array("Buruh"),
            "Partai Gelombang Rakyat Indonesia"=>array("Gelora"),
            "Partai Keadilan Sejahtera"=>array("PKS"),
            "Partai Kebangkitan Nusantara"=>array("PKN"),
            "Partai Hati Nurani Rakyat"=>array("Hanura"),
            "Partai Garda Perubahan Indonesia"=>array("Garuda"),
            "Partai Amanat Nasional"=>array("PAN"),
            "Partai Bulan Bintang"=>array("PBB"),
            "Partai Demokrat"=>array("Demokrat"),
            "Partai Solidaritas Indonesia"=>array("PSI"),
            "Partai Persatuan Indonesia"=>array("Perindo"),
            "Partai Persatuan Pembangunan"=>array("PPP"),
            "Partai UMMAT"=>array("UMMAT"),
        );
        $data_dapil=[];
        for ($i=1; $i<=6;$i++) {
            $dapil=Dapil::create(['title'=>$i]);
            array_push($data_dapil, $dapil->id);
        }
        foreach ($kecamatan as $nama_kec => $array_desa) {
            $post = Kecamatan::create([
                'title' => $nama_kec,
                'dapil_id'=>$data_dapil[rand(0, 5)]

            ]);
            foreach ($array_desa as $nama_desa) {
                $desa = Desa::create([
                    'kecamatan_id'=>$post->id,
                    'title'=>$nama_desa,
                ]);
                $create_password= User::create([
                    'name' => "Operator ".$desa->title,
                    'desa_id' =>$desa->id,
                    'email' => str_replace(" ", "", (strtolower($desa->title).".".strtolower($nama_kec))),
                    'role'=>'operator',
                    'password'=>Hash::make(str_replace(" ", "", (strtolower($nama_kec).".".strtolower($desa->title)))),
                ]);
                for ($i=1; $i<=10;$i++) {
                    $tps=Tps::create([
                        'desa_id'=>$desa->id,
                        'title'=>$i,
                    ]);
                }
            }
        }
        for ($i=1; $i<=3;$i++) {
            $capres=Capres::create([
                'no_urut'=>$i,
                'nama_capres'=>fake()->name(),
                'nama_cawapres'=>fake()->name(),
                'foto'=>3
            ]);
        }
        for ($i=1; $i<=2;$i++) {
            $cagub=Cagub::create([
                'no_urut'=>$i,
                'nama_cagub'=>fake()->name(),
                'nama_cawagub'=>fake()->name(),
                'foto'=>3
            ]);
        }
        for ($i=1; $i<=2;$i++) {
            $cabub=Cabub::create([
                'no_urut'=>$i,
                'nama_cabub'=>fake()->name(),
                'nama_cawabub'=>fake()->name(),
                'foto'=>3
            ]);
        }
        for ($i=1; $i<=30;$i++) {
            $dpd=Dpd::create([
                'no_urut'=>$i,
                'nama'=>fake()->name(),
                'foto'=>3
            ]);
        }
        $no=1;
        foreach ($partai as $key_partai => $array_partai) {
            foreach ($array_partai as $nama_partai) {
                $partai = Partai::create([
                    'no_urut' =>  $no,
                    'nama' =>  $key_partai,
                    'singkatan' =>  $nama_partai,
                ]);
                for ($i=1; $i<=15;$i++) {
                    $caleg_ri=Caleg::create([
                        'partai_id'=>$partai->id,
                        'dapil_id'=>1,
                        'no_urut'=>$i,
                        'nama'=>fake()->name(),
                    ]);
                }
                for ($i=1; $i<=15;$i++) {
                    $caleg_prov=Caleg::create([
                        'partai_id'=>$partai->id,
                        'dapil_id'=>2,
                        'no_urut'=>$i,
                        'nama'=>fake()->name(),
                    ]);
                }
                for ($x=0; $x<=5;$x++) {
                    for ($i=1; $i<=15;$i++) {
                        $caleg_kab=Caleg::create([
                            'partai_id'=>$partai->id,
                            'dapil_id'=>$data_dapil[$x],
                            'no_urut'=>$i,
                            'nama'=>fake()->name(),
                        ]);
                    }
                }
            }
            $no++;
        }
    }
}
