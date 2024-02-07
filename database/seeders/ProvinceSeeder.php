<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provinces')->delete();
        $provinces = array(
            array('name' => "Koshi"),
            array('name' => "Madhesh"),
            array('name' => "Bagmati"),
            array('name' => "Gandaki"),
            array('name' => "Lumbini"),
            array('name' => "Karnali"),
            array('name' => "Sudurpaschim"),
    );
        DB::table('provinces')->insert($provinces);
    }
}
