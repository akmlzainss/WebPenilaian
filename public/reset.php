<?php

// Autoload file
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel (penting!)
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Jalankan kernel
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Import model
use App\Models\User;

// Tentukan ID dan Username user yang ingin direset passwordnya
$userIdToReset = 1; // Ganti dengan ID user yang benar
$usernameToReset = 'admin'; // Ganti dengan username user yang benar

// Temukan user berdasarkan composite primary key
$user = User::where('id', $userIdToReset)
            ->where('username', $usernameToReset)
            ->first();

if ($user) {
    $newPassword = '111111';
    $user->password = $newPassword; // Jika mutator hashing aktif, password akan ter-hash
    $user->save();
    echo "Password untuk user dengan ID {$user->id} dan username '{$user->username}' diubah ke {$newPassword}.\n";
} else {
    echo "User dengan ID {$userIdToReset} dan username '{$usernameToReset}' tidak ditemukan.\n";
}