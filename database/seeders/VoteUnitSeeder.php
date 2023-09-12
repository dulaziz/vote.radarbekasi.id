<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoteUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('vote_units')->insert([
            'thumbnail' => 'unit-items/thumbnail.png',
            'title' => 'Bogor Memilih 2024, Siapa Kandidat Balon Wali Kota Bogor Terfavorit?',
            'description' => 'PEMILIHAN Wali Kota Bogor akan digelar pada 2024 mendatang. Sejumlah nama digadang-gadang bakal maju menjadi orang nomor satu di Kota Bogor. Siapa kandidat bakal calon Wali Kota Bogor 2024, pilihan Anda? Yuk, ikut poling berikut:',
            'date_start' => date('d-m-y'),
            'date_end' => date('10-07-2022'),
            'subtitle' => 'Bakal Calon Wali Kota Bogor'
        ]);

    }
}
