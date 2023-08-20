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
            'desa_id' =>'999054d7-54af-44d6-acff-9e88b8992001',
            'email' => 'admin',
            'role'=>'administrator',
            'password'=>Hash::make('admin'),
        ]);
        User::create([
            'name' => 'Kinara Tadkiya',
            'desa_id' =>'999054d7-54af-44d6-acff-9e88b8992001',
            'email' => 'operator',
            'role'=>'operator',
            'password'=>Hash::make('admin'),
        ]);

        $kecamatan = array(
            "Babadan"=>array("Babadan","Barang","Cekok","Gupolo","Japan","Kadipaten","Kertosari","Lembah","Ngunut","Patihan Wetan","Polorejo","Pondok","Purwosari","Sukosari","Trisono"),
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
            
            
        foreach ($kecamatan as $nama_kec => $array_desa) {
            $post = Kecamatan::create(['title' => $nama_kec]);
            foreach ($array_desa as $nama_desa) {
                $des = Desa::create([
                    'kecamatan_id'=>$post->id,
                    'title'=>$nama_desa,
                ]);
               
            }
        }
        Dapil::create(['title'=>'1']);
        Dapil::create(['title'=>'2']);
        Dapil::create(['title'=>'3']);
        Dapil::create(['title'=>'4']);
        Dapil::create(['title'=>'5']);
        Dapil::create(['title'=>'6']);              
       
    }
}
