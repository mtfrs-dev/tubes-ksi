<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('units')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Miligram',
                'code' => 'mg',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Mikrogram',
                'code' => 'mcg'
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Gram',
                'code' => 'g'
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Mililiter',
                'code' => 'mL'
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Botol',
                'code' => 'bot'
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Tabung',
                'code' => 'tbg'
            ),
        ));
    }
}
