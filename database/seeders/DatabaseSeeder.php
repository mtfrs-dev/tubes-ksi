<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UnitSeeder;
use Database\Seeders\MedicineCategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'role'  => 'ADMIN'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test Supplier',
            'email' => 'supplier@example.com',
            'role'  => 'SUPPLIER'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
        ]);
        \App\Models\User::factory(10)->create();

        $this->call(UnitSeeder::class);
        
        \App\Models\Medicine::factory(10)->create();
        \App\Models\Category::factory(10)->create();
        $this->call(MedicineCategorySeeder::class);

    }
}
