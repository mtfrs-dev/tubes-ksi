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
                'name' => 'botol sirup'
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'tablet'
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'botol suntik'
            ),
        ));
    }
}
