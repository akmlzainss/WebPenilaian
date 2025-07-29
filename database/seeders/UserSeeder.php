<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['username' => 'admin', 'role' => 'admin', 'password' => 'admin123'],
            ['username' => '196504121990031002', 'role' => 'guru', 'password' => 'guru123'],
            ['username' => '198107252005012003', 'role' => 'guru', 'password' => 'guru123'],
            ['username' => '199001152010012005', 'role' => 'guru', 'password' => 'guru123'],
            ['username' => '199208172015031001', 'role' => 'guru', 'password' => 'guru123'],
            ['username' => '199503062018011001', 'role' => 'guru', 'password' => 'guru123'],
            ['username' => '196811221990091009', 'role' => 'guru', 'password' => 'guru123'],
            ['username' => '197609111996071007', 'role' => 'guru', 'password' => 'guru123'],
            ['username' => '197203051995012003', 'role' => 'guru', 'password' => 'guru123'],
            ['username' => '198108101998022004', 'role' => 'guru', 'password' => 'guru123'],
            ['username' => '198511221999032005', 'role' => 'guru', 'password' => 'guru123'],
            ['username' => '197911011996042006', 'role' => 'guru', 'password' => 'guru123'],
            ['username' => '198910151997052007', 'role' => 'guru', 'password' => 'guru123'],
            ['username' => '197706301994062008', 'role' => 'guru', 'password' => 'guru123'],
            ['username' => '198003101995072009', 'role' => 'guru', 'password' => 'guru123'],
            
        ];

        for ($i = 1; $i <= 45; $i++) {
            $users[] = [
                'username' => strval(1000 + $i),
                'role' => 'murid',
                'password' => 'murid123'
            ];
        }

        foreach ($users as $user) {
            User::updateOrCreate(
                ['username' => $user['username']],
                [
                    'password' => Hash::make($user['password']),
                    'role' => $user['role'],
                ]
            );
        }
    }
}