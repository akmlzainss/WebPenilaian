<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mapel')->insert([
            ['kode' => 'MTK', 'mata_pelajaran' => 'Matematika', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'BIN', 'mata_pelajaran' => 'Bahasa Indonesia', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'BIG', 'mata_pelajaran' => 'Bahasa Inggris', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'PWEB', 'mata_pelajaran' => 'Pemrograman Web', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'BADA', 'mata_pelajaran' => 'Basis Data', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'PAI', 'mata_pelajaran' => 'Pendidikan Agama Islam', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'PKN', 'mata_pelajaran' => 'Pendidikan Kewarganegaraan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}