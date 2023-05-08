<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Tetes',
                'code' => 'gtt'
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Suppositoria',
                'code' => 'supp'
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Tablet',
                'code' => 'tab'
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Kaplet',
                'code' => 'kap'
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Sirup',
                'code' => 'syr'
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Salep',
                'code' => 'sal'
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Injeksi',
                'code' => 'inj'
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Aerosol',
                'code' => 'aer'
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Pil',
                'code' => 'pil'
            ),
        ));
    }
}
