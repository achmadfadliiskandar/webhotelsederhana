<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeKamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipe_kamars')->insert([
            'tipe_kamar'=>'silver',
        ]);
        DB::table('tipe_kamars')->insert([
            'tipe_kamar'=>'gold',
        ]);
    }
}
