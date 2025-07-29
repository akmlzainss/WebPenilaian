@extends('layouts.murid')

@section('title', 'About Us')
@section('breadcrumb', 'About Us')
@section('page-title', 'Halaman About Us')

@section('content')
    <!-- Container utama untuk konten About Us dengan padding dan margin responsif -->
    <div class="container mx-auto px-4 py-8">
        <!-- Judul halaman About Us -->
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">About Us</h1>

        <!-- Card konten deskripsi sistem penilaian -->
        <div class="card-stat p-6">
            <!-- Subjudul deskripsi sistem -->
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Sistem Penilaian Sekolah</h2>
            <!-- Paragraf deskripsi singkat fungsi aplikasi -->
            <p class="text-gray-600 dark:text-gray-300 mb-4">
                Sistem Penilaian Sekolah adalah aplikasi berbasis web yang dirancang untuk mempermudah pengelolaan data akademik di sekolah. Aplikasi ini memungkinkan admin, guru, dan murid untuk mengelola data seperti:
            </p>
            <!-- Daftar fitur utama aplikasi -->
            <ul class="list-disc list-inside text-gray-600 dark:text-gray-300 mb-4">
                <li>Manajemen data guru dan murid</li>
                <li>Pengelolaan mata pelajaran</li>
                <li>Penilaian dan pelaporan nilai siswa</li>
                <li>Monitoring aktivitas pengguna</li>
            </ul>
            <!-- Paragraf penutup tentang tujuan pembuatan aplikasi -->
            <p class="text-gray-600 dark:text-gray-300">
                Dibuat oleh tim pengembang untuk mendukung efisiensi administrasi sekolah dengan desain yang modern dan user-friendly.
            </p>
        </div>
    </div>
@endsection
