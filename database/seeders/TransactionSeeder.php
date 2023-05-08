<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        \DB::table('transactions')->insert(array (
            0 => 
            array (
                'id'            => 1,
                'code'          => 'ABC',
                'type'          => 'PEMBELIAN',
                'user_id'       => 2,
                'total_price'   => 300000,
                'invoice'       => 'okokokokokoko',
            ),
            1 => 
            array (
                'id'            => 2,
                'code'          => 'BCD',
                'type'          => 'PEMBELIAN',
                'user_id'       => 2,
                'total_price'   => 300000,
                'invoice'       => 'okokokokokoko',
            ),
            2 => 
            array (
                'id'            => 3,
                'code'          => 'CDE',
                'type'          => 'PEMBELIAN',
                'user_id'       => 2,
                'total_price'   => 300000,
                'invoice'       => 'okokokokokoko',
            ),
            3 => 
            array (
                'id'            => 4,
                'code'          => 'DEF',
                'type'          => 'PENJUALAN',
                'user_id'       => rand(3,13),
                'total_price'   => 75000,
                'invoice'       => 'kokokokokokoko',
            ),
            4 => 
            array (
                'id'            => 5,
                'code'          => 'EFG',
                'type'          => 'PENJUALAN',
                'user_id'       => rand(3,13),
                'total_price'   => 75000,
                'invoice'       => 'kokokokokokoko',
            ),
            5 => 
            array (
                'id'            => 6,
                'code'          => 'GHI',
                'type'          => 'PENJUALAN',
                'user_id'       => rand(3,13),
                'total_price'   => 75000,
                'invoice'       => 'kokokokokokoko',
            ),
            6 => 
            array (
                'id'            => 7,
                'code'          => 'HIJ',
                'type'          => 'PENJUALAN',
                'user_id'       => rand(3,13),
                'total_price'   => 75000,
                'invoice'       => 'kokokokokokoko',
            ),
            7 => 
            array (
                'id'            => 8,
                'code'          => 'JKL',
                'type'          => 'PENJUALAN',
                'user_id'       => rand(3,13),
                'total_price'   => 75000,
                'invoice'       => 'kokokokokokoko',
            ),
            8 => 
            array (
                'id'            => 9,
                'code'          => 'KLM',
                'type'          => 'PENJUALAN',
                'user_id'       => rand(3,13),
                'total_price'   => 75000,
                'invoice'       => 'kokokokokokoko',
            ),
            9 => 
            array (
                'id'            => 10,
                'code'          => 'LMN',
                'type'          => 'PENJUALAN',
                'user_id'       => rand(3,13),
                'total_price'   => 75000,
                'invoice'       => 'kokokokokokoko',
            ),
        ));
    }
}
