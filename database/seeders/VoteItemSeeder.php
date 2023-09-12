<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoteItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('vote_items')->insert([
            'vote_unit_id' => 1,
            'vote_image' => 'vote-items/default.png',
            'vote_name' => 'Dedie A Rachim',
            'short_desc' => 'Wakil Wali Kota Bogor',
        ]);
    }
}
