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
            "Sukorejo"=>array("Bangunrejo","Gandukepuh","Gegeran","Gelanglor","Golan","Kalimalang","Karanglolor","Kedungbanteng","Kranggan","Lengkong","Morosari","Nambangrejo","Nampan","Prajegan","Serangan","Sidorejo","Sragi","Sukorejo"));
            
            
        foreach ($kecamatan as $nama_kec => $array_desa) {
            $post = Kecamatan::create(['title' => $nama_kec]);
            foreach ($array_desa as $nama_desa) {
                $des = Desa::create([
                    'kecamatan_id'=>$post->id,
                    'title'=>$nama_desa,
                ]);
                // ----------------------------------------------------------TPS
                Tps::create([
                    'desa_id'=>$des->id,
                    'title'=>'1',
                ]);
                Tps::create([
                    'desa_id'=>$des->id,
                    'title'=>'2',
                ]);
                Tps::create([
                    'desa_id'=>$des->id,
                    'title'=>'3',
                ]);
                // ----------------------------------------------------------TPS
            }
        }
            

        // Kecamatan::create([
        //     'id' => '999054d7-54af-44d6-acff-9e88b899e401',
        //     'dapil_id' => 1,
        //     'title' => 'Siman',
        // ]);
        // Kecamatan::create([
        //     'id' => '999054d7-54af-44d6-acff-9e88b899e402',
        //     'dapil_id' => 1,
        //     'title' => 'Jetis',
        // ]);
        // Desa::create([
        //     'id'=>'999054d7-54af-44d6-acff-9e88b8991001',
        //     'kecamatan_id'=>'999054d7-54af-44d6-acff-9e88b899e401',
        //     'title'=>'Demangan',
        // ]);
        // Desa::create([
        //     'id'=>'999054d7-54af-44d6-acff-9e88b8991002',
        //     'kecamatan_id'=>'999054d7-54af-44d6-acff-9e88b899e401',
        //     'title'=>'Ngabar',
        // ]);
        // Desa::create([
        //     'id'=>'999054d7-54af-44d6-acff-9e88b8991003',
        //     'kecamatan_id'=>'999054d7-54af-44d6-acff-9e88b899e401',
        //     'title'=>'Jabung',
        // ]);
        // Desa::create([
        //     'id'=>'999054d7-54af-44d6-acff-9e88b8992001',
        //     'kecamatan_id'=>'999054d7-54af-44d6-acff-9e88b899e402',
        //     'title'=>'Karanggebang',
        // ]);
        // Desa::create([
        //     'id'=>'999054d7-54af-44d6-acff-9e88b8992002',
        //     'kecamatan_id'=>'999054d7-54af-44d6-acff-9e88b899e402',
        //     'title'=>'Kutu',
        // ]);
        // Tps::create([
        //     'id'=>'999054d7-54af-44d6-acff-9e88b899e401',
        //     'desa_id'=>'999054d7-54af-44d6-acff-9e88b8992001',
        //     'title'=>1,
        // ]);
        // Tps::create([
        //     'id'=>'999054d7-54af-44d6-acff-9e88b899e402',
        //     'desa_id'=>'999054d7-54af-44d6-acff-9e88b8992001',
        //     'title'=>2,
        // ]);

        // Tps::create([
        //     'id'=>'999054d7-54af-44d6-acff-9e88b899e403',
        //     'desa_id'=>'999054d7-54af-44d6-acff-9e88b8992001',
        //     'title'=>3,
        // ]);
        // Tps::create([
        //     'id'=>'999054d7-54af-44d6-acff-9e88b899e404',
        //     'desa_id'=>'999054d7-54af-44d6-acff-9e88b8992001',
        //     'title'=>4,
        // ]);
        // Tps::create([
        //     'id'=>'999054d7-54af-44d6-acff-9e88b899e405',
        //     'desa_id'=>'999054d7-54af-44d6-acff-9e88b8992001',
        //     'title'=>5,
        // ]);
        // Tps::create([
        //     'id'=>'999054d7-54af-44d6-acff-9e88b899e406',
        //     'desa_id'=>'999054d7-54af-44d6-acff-9e88b8992001',
        //     'title'=>6,
        // ]);
        Capres::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcapres1',
            'no_urut'=>1,
            'nama_capres'=>'Ir. H. JOKO WIDODO',
            'nama_cawapres'=>'Prof. Dr.(H.C) KH. MA RUF AMIN',
            'foto'=>1,
        ]);
        Capres::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcapres2',
            'no_urut'=>2,
            'nama_capres'=>'H. PRABOWO SUBIANTO',
            'nama_cawapres'=>'H. SANDIAGA SALAHUDIN UNO',
            'foto'=>2,
        ]);

        Cagub::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcapres1',
            'no_urut'=>1,
            'nama_cagub'=>'Warist Amru Khoiruddin',
            'nama_cawagub'=>'Prof. Dr.(H.C) KH. MA RUF AMIN',
            'foto'=>1,
        ]);
        Cagub::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcapres2',
            'no_urut'=>2,
            'nama_cagub'=>'Devi Nurmalasari',
            'nama_cawagub'=>'H. SANDIAGA SALAHUDIN UNO',
            'foto'=>2,
        ]);

        Cabub::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcapres1',
            'no_urut'=>1,
            'nama_cabub'=>'Kinara Tazkiya Azzahra',
            'nama_cawabub'=>'Prof. Dr.(H.C) KH. MA RUF AMIN',
            'foto'=>1,
        ]);
        Cabub::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcapres2',
            'no_urut'=>2,
            'nama_cabub'=>'Fara Aulia Azzahra',
            'nama_cawabub'=>'H. SANDIAGA SALAHUDIN UNO',
            'foto'=>2,
        ]);
        Dpd::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcapres1',
            'no_urut'=>1,
            'nama'=>'1. Fara Aulia Azzahra',
            'foto'=>1,
        ]);
        Dpd::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcapres2',
            'no_urut'=>2,
            'nama'=>'2. Fara Aulia Azzahra',
            'foto'=>2,
        ]);
        Dpd::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcapres3',
            'no_urut'=>3,
            'nama'=>'3. Fara Aulia Azzahra',
            'foto'=>3,
        ]);
        Dpd::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcapres4',
            'no_urut'=>4,
            'nama'=>'4. Fara Aulia Azzahra',
            'foto'=>4,
        ]);
        Dpd::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcapres5',
            'no_urut'=>5,
            'nama'=>'5. Fara Aulia Azzahra',
            'foto'=>5,
        ]);
        Dpd::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcapres6',
            'no_urut'=>6,
            'nama'=>'6. Fara Aulia Azzahra',
            'foto'=>6,
        ]);
        Dpd::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcapres7',
            'no_urut'=>7,
            'nama'=>'7. Fara Aulia Azzahra',
            'foto'=>7,
        ]);
        Dpd::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcapres8',
            'no_urut'=>8,
            'nama'=>'8. Fara Aulia Azzahra',
            'foto'=>8,
        ]);
        Dpd::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcapres9',
            'no_urut'=>9,
            'nama'=>'9. Fara Aulia Azzahra',
            'foto'=>9,
        ]);
        Dpd::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcapre10',
            'no_urut'=>10,
            'nama'=>'10. Fara Aulia Azzahra',
            'foto'=>10,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai01',
            'no_urut'=>1,
            'nama'=>'PARTAI KEBANGKITAN BANGSA',
            'singkatan'=>'PKB',
            'logo'=>1,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai02',
            'no_urut'=>2,
            'nama'=>'PARTAI GERINDRA',
            'singkatan'=>'PARTAI GERINDRA',
            'logo'=>2,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai03',
            'no_urut'=>3,
            'nama'=>'PDI PERJUANGAN',
            'singkatan'=>'PDIP',
            'logo'=>3,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai04',
            'no_urut'=>4,
            'nama'=>'PARTAI GOLKAR',
            'singkatan'=>'GOLKAR',
            'logo'=>4,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai05',
            'no_urut'=>5,
            'nama'=>'PARTAI BURUH',
            'singkatan'=>'BURUH',
            'logo'=>5,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai06',
            'no_urut'=>6,
            'nama'=>'PARTAI NASDEM',
            'singkatan'=>'NASDEM',
            'logo'=>6,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai07',
            'no_urut'=>7,
            'nama'=>'PARTAI GELOMBANG RAKYAT INDONESIA',
            'singkatan'=>'GELORA',
            'logo'=>7,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai08',
            'no_urut'=>8,
            'nama'=>'PARTAI KEADILAN SEJAHTERA',
            'singkatan'=>'PKS',
            'logo'=>8,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai09',
            'no_urut'=>9,
            'nama'=>'PARTAI KEBANGKITAN NUSANTARA',
            'singkatan'=>'PKN',
            'logo'=>9,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai10',
            'no_urut'=>10,
            'nama'=>'PARTAI HATI NURANI RAKYAT',
            'singkatan'=>'HANURA',
            'logo'=>10,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai11',
            'no_urut'=>11,
            'nama'=>'PARTAI GARDA PERUBAHAN INDONESIA',
            'singkatan'=>'GARUDA',
            'logo'=>11,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai12',
            'no_urut'=>12,
            'nama'=>'PARTAI AMANAT NASIONAL',
            'singkatan'=>'PAN',
            'logo'=>12,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai13',
            'no_urut'=>13,
            'nama'=>'PARTAI BULAN BINTANG',
            'singkatan'=>'PBB',
            'logo'=>13,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai14',
            'no_urut'=>14,
            'nama'=>'PARTAI DEMOKRAT',
            'singkatan'=>'PARTAI DEMOKRAT',
            'logo'=>14,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai15',
            'no_urut'=>15,
            'nama'=>'PARTAI SOLIDARITAS INDONESIA',
            'singkatan'=>'PSI',
            'logo'=>15,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai16',
            'no_urut'=>16,
            'nama'=>'PARTAI PERSATUAN INDONESIA',
            'singkatan'=>'PERINDO',
            'logo'=>16,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai17',
            'no_urut'=>17,
            'nama'=>'PARTAI PERSATUAN INDONESIA',
            'singkatan'=>'PPP',
            'logo'=>17,
        ]);
        Partai::create([
            'id'=>'999054d7-54af-44d6-acff-9e88partai18',
            'no_urut'=>18,
            'nama'=>'PARTAI UMMAT',
            'singkatan'=>'PARTAI UMMAT',
            'logo'=>18,
        ]);
        Caleg::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcaleg01',
            'partai_id'=>'999054d7-54af-44d6-acff-9e88partai01',
            'dapil_id'=>'999054d7-54af-44d6-acff-9e88b899e402',
            'no_urut'=>1,
            'nama'=>'Drs. MUHAMMAD NUR, MH',
        ]);
        Caleg::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcaleg02',
            'partai_id'=>'999054d7-54af-44d6-acff-9e88partai01',
            'dapil_id'=>'999054d7-54af-44d6-acff-9e88b899e402',
            'no_urut'=>2,
            'nama'=>'MUHAMMAD SALEH, ST, MT',
        ]);
        Caleg::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcaleg03',
            'partai_id'=>'999054d7-54af-44d6-acff-9e88partai01',
            'dapil_id'=>'999054d7-54af-44d6-acff-9e88b899e402',
            'no_urut'=>3,
            'nama'=>'SITI MARIAM',
        ]);
        Caleg::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcaleg04',
            'partai_id'=>'999054d7-54af-44d6-acff-9e88partai02',
            'dapil_id'=>'999054d7-54af-44d6-acff-9e88b899e402',
            'no_urut'=>1,
            'nama'=>'Ir. Hj. ENDANG SULISTYORINI',
        ]);
        Caleg::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcaleg05',
            'partai_id'=>'999054d7-54af-44d6-acff-9e88partai02',
            'dapil_id'=>'999054d7-54af-44d6-acff-9e88b899e402',
            'no_urut'=>2,
            'nama'=>'Drs. H. ZAINUL ARIFIN',
        ]);
        Caleg::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcaleg06',
            'partai_id'=>'999054d7-54af-44d6-acff-9e88partai03',
            'dapil_id'=>'999054d7-54af-44d6-acff-9e88b899e402',
            'no_urut'=>1,
            'nama'=>'MUJAHID ABDUL LATIEF, S.H., M.H',
        ]);
        Caleg::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcaleg07',
            'partai_id'=>'999054d7-54af-44d6-acff-9e88partai01',
            'dapil_id'=>1,
            'no_urut'=>1,
            'nama'=>'WARIST AMRU KHOIRUDDIN',
        ]);
        Caleg::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcaleg08',
            'partai_id'=>'999054d7-54af-44d6-acff-9e88partai02',
            'dapil_id'=>1,
            'no_urut'=>1,
            'nama'=>'Drs. H. ZAINUL ARIFIN',
        ]);
        Caleg::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcaleg09',
            'partai_id'=>'999054d7-54af-44d6-acff-9e88partai01',
            'dapil_id'=>2,
            'no_urut'=>1,
            'nama'=>'MUJAHID ABDUL LATIEF, S.H., M.H',
        ]);
        Caleg::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcaleg10',
            'partai_id'=>'999054d7-54af-44d6-acff-9e88partai01',
            'dapil_id'=>2,
            'no_urut'=>2,
            'nama'=>'WARIST AMRU KHOIRUDDIN',
        ]);
        Caleg::create([
            'id'=>'999054d7-54af-44d6-acff-9e88bcaleg11',
            'partai_id'=>'999054d7-54af-44d6-acff-9e88partai01',
            'dapil_id'=>2,
            'no_urut'=>3,
            'nama'=>'Drs. H. ZAINUL ARIFIN',
        ]);

    }
}
