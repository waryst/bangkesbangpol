<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cabub;
use App\Models\Cagub;
use App\Models\Capres;
use App\Models\Desa;
use App\Models\Dpd;
use App\Models\Kecamatan;
use App\Models\Tps;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Kecamatan::create([
            'id' => '999054d7-54af-44d6-acff-9e88b899e401',
            'dapil_id' => 1,
            'title' => 'Siman',
        ]);
        Kecamatan::create([
            'id' => '999054d7-54af-44d6-acff-9e88b899e402',
            'dapil_id' => 1,
            'title' => 'Jetis',
        ]);
        Desa::create([
            'id'=>'999054d7-54af-44d6-acff-9e88b8991001',
            'kecamatan_id'=>'999054d7-54af-44d6-acff-9e88b899e401',
            'title'=>'Demangan',
        ]);
        Desa::create([
            'id'=>'999054d7-54af-44d6-acff-9e88b8991002',
            'kecamatan_id'=>'999054d7-54af-44d6-acff-9e88b899e401',
            'title'=>'Ngabar',
        ]);
        Desa::create([
            'id'=>'999054d7-54af-44d6-acff-9e88b8991003',
            'kecamatan_id'=>'999054d7-54af-44d6-acff-9e88b899e401',
            'title'=>'Jabung',
        ]);
        Desa::create([
            'id'=>'999054d7-54af-44d6-acff-9e88b8992001',
            'kecamatan_id'=>'999054d7-54af-44d6-acff-9e88b899e402',
            'title'=>'Karanggebang',
        ]);
        Desa::create([
            'id'=>'999054d7-54af-44d6-acff-9e88b8992002',
            'kecamatan_id'=>'999054d7-54af-44d6-acff-9e88b899e402',
            'title'=>'Kutu',
        ]);
        Tps::create([
            'id'=>'999054d7-54af-44d6-acff-9e88b899e401',
            'desa_id'=>'999054d7-54af-44d6-acff-9e88b8992001',
            'title'=>1,
        ]);
        Tps::create([
            'id'=>'999054d7-54af-44d6-acff-9e88b899e402',
            'desa_id'=>'999054d7-54af-44d6-acff-9e88b8992001',
            'title'=>2,
        ]);

        Tps::create([
            'id'=>'999054d7-54af-44d6-acff-9e88b899e403',
            'desa_id'=>'999054d7-54af-44d6-acff-9e88b8992001',
            'title'=>3,
        ]);
        Tps::create([
            'id'=>'999054d7-54af-44d6-acff-9e88b899e404',
            'desa_id'=>'999054d7-54af-44d6-acff-9e88b8992001',
            'title'=>4,
        ]);
        Tps::create([
            'id'=>'999054d7-54af-44d6-acff-9e88b899e405',
            'desa_id'=>'999054d7-54af-44d6-acff-9e88b8992001',
            'title'=>5,
        ]);
        Tps::create([
            'id'=>'999054d7-54af-44d6-acff-9e88b899e406',
            'desa_id'=>'999054d7-54af-44d6-acff-9e88b8992001',
            'title'=>6,
        ]);
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

    }
}
