<?php

namespace Database\Seeders;

use App\Models\gaji;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\hrd;
use App\Models\lembur;
use App\Models\medical;
use App\Models\status;
use App\Models\status_kry;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
         hrd::factory(10)->create();
         $this->call(UserRoleSeeder::class);

      
    }
}
