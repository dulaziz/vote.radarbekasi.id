<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // DB::table('vote_items')->insert([
        //     'vote_id' => 1,
        //     'vote_unit_id' => 1,
        //     'response' => 1,
        //     'vote_image' => 'vote-items/default.png',
        //     'vote_name' => 'Dedie A Rachim',
        //     'short_desc' => 'Wakil Wali Kota Bogor',
        // ]);

        // DB::table('vote_units')->insert([
        //     'thumbnail' => 'unit-items/thumbnail.png',
        //     'title' => 'Bogor Memilih 2024, Siapa Kandidat Balon Wali Kota Bogor Terfavorit?',
        //     'description' => 'PEMILIHAN Wali Kota Bogor akan digelar pada 2024 mendatang. Sejumlah nama digadang-gadang bakal maju menjadi orang nomor satu di Kota Bogor. Siapa kandidat bakal calon Wali Kota Bogor 2024, pilihan Anda? Yuk, ikut poling berikut:',
        //     'date_start' => round(microtime(true)),
        //     'date_end' => round(microtime(true) * 1000),
        //     'subtitle' => 'Bakal Calon Wali Kota Bogor'
        // ]);

        // DB::table('votings')->insert([
        //     'vote_unit_id' => 1,
        //     'vote_item_id' => 1,
        //     'response' => 50,
        // ]);

        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'admin@radar-bogor.com',
            'password' => Hash::make('redaksi-polling-16'),
            // 'response' => 50,
        ]);


    }
}
