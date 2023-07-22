<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cabub;
use App\Models\Cagub;
use App\Models\Capres;
use App\Models\Desa;
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

    }
}
