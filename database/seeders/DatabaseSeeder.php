<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

        public function run(): void
{
    $this->call([
        UserSeeder::class,
        MuridSeeder::class,
        GuruSeeder::class,
        MapelSeeder::class,
        NilaiSeeder::class,
    ]);
}

    }

