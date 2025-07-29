@extends('layouts.guru')

@section('title', 'Profil Guru')
@section('page-title', 'Profil Guru')

@section('content')
    <!-- Container utama dengan padding dan animasi fadeIn -->
    <div class="container mx-auto px-4 py-8 animate__animated animate__fadeIn">
        <!-- Judul halaman -->
        <h1 class="text-3xl font-bold mb-6">Profil Guru</h1>

        <!-- Menampilkan pesan sukses jika ada di session -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Menampilkan daftar error validasi jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li> <!-- Tampilkan setiap pesan error -->
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card informasi pribadi guru -->
        <div class="card-custom mb-4">
            <div class="card-header-custom">
                <!-- Header card dengan ikon dan judul -->
                <h2 class="text-2xl font-semibold mb-0"><i class="fas fa-user me-2"></i> Informasi Pribadi</h2>
            </div>
            <div class="card-body-custom">
                <!-- Tabel data guru -->
                <table class="w-full table-auto">
                    <tr class="border-b hover:bg-gray-50 transition-all duration-300">
                        <th class="text-left py-3 font-medium text-gray-700">Nama</th>
                        <td class="py-3 text-gray-800">{{ $guru->nama }}</td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 transition-all duration-300">
                        <th class="text-left py-3 font-medium text-gray-700">NIP</th>
                        <td class="py-3 text-gray-800">{{ $guru->nip }}</td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 transition-all duration-300">
                        <th class="text-left py-3 font-medium text-gray-700">Email</th>
                        <td class="py-3 text-gray-800">{{ $guru->email }}</td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 transition-all duration-300">
                        <th class="text-left py-3 font-medium text-gray-700">Jenis Kelamin</th>
                        <td class="py-3 text-gray-800">{{ $guru->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 transition-all duration-300">
                        <th class="text-left py-3 font-medium text-gray-700">No. Telepon</th>
                        <td class="py-3 text-gray-800">{{ $guru->no_telp }}</td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 transition-all duration-300">
                        <th class="text-left py-3 font-medium text-gray-700">Tanggal Lahir</th>
                        <td class="py-3 text-gray-800">{{ $guru->tgl_lahir }}</td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 transition-all duration-300">
                        <th class="text-left py-3 font-medium text-gray-700">Mata Pelajaran</th>
                        <td class="py-3 text-gray-800">{{ $guru->mapel->mata_pelajaran ?? 'Tidak ada mata pelajaran' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Card form ubah kata sandi -->
        <div class="card-custom">
            <div class="card-header-custom">
                <!-- Header card dengan ikon dan judul -->
                <h2 class="text-2xl font-semibold mb-0"><i class="fas fa-lock me-2"></i> Ubah Kata Sandi</h2>
            </div>
            <div class="card-body-custom">
                <!-- Form update password dengan method POST -->
                <form action="{{ route('guru.update.password') }}" method="POST">
                    @csrf
                    <!-- Input password lama -->
                    <div class="mb-4">
                        <label for="current_password" class="block text-gray-700 font-medium mb-2">Kata Sandi Lama</label>
                        <input type="password" name="current_password" id="current_password" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300" required>
                    </div>
                    <!-- Input password baru -->
                    <div class="mb-4">
                        <label for="new_password" class="block text-gray-700 font-medium mb-2">Kata Sandi Baru</label>
                        <input type="password" name="new_password" id="new_password" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300" required minlength="6">
                    </div>
                    <!-- Input konfirmasi password baru -->
                    <div class="mb-4">
                        <label for="new_password_confirmation" class="block text-gray-700 font-medium mb-2">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300" required minlength="6">
                    </div>
                    <!-- Tombol submit untuk simpan perubahan password -->
                    <button type="submit" class="btn btn-primary-custom"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
    <!-- Load Animate.css untuk animasi fadeIn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @endpush
@endsection
