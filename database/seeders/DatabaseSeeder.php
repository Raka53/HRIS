<?php

namespace Database\Seeders;

use App\Models\gaji;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\hrd;
use App\Models\lembur;
use App\Models\status;
use App\Models\status_kry;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::factory(5)->create();
         hrd::factory(50)->create();
         status_kry::factory(3)->create();
         
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
