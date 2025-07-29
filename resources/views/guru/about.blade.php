@extends('layouts.guru')

@section('title', 'About Us')
@section('page-title', 'About Us')

@section('content')
    <!-- Kontainer utama dengan padding dan animasi fadeIn dari Animate.css -->
    <div class="container mx-auto px-4 py-8 animate__animated animate__fadeIn">
        <!-- Judul halaman -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6">About Us</h1>

        <!-- Card pertama: Penjelasan tentang Sistem Penilaian Sekolah -->
        <div class="card-custom p-6">
            <!-- Header card dengan ikon dan judul -->
            <div class="flex items-center mb-4">
                <i class="fas fa-school text-3xl text-primary mr-3"></i>
                <h2 class="text-2xl font-semibold text-gray-800">Sistem Penilaian Sekolah</h2>
            </div>
            <!-- Deskripsi singkat tentang aplikasi -->
            <p class="text-gray-600 mb-4">
                Sistem Penilaian Sekolah adalah aplikasi berbasis web yang dirancang untuk mempermudah pengelolaan data akademik di sekolah. Aplikasi ini memungkinkan admin, guru, dan murid untuk mengelola data seperti:
            </p>
            <!-- Daftar fitur aplikasi dengan ikon ceklis -->
            <ul class="list-disc list-inside text-gray-600 mb-4">
                <li class="flex items-center"><i class="fas fa-check-circle text-success mr-2"></i> Manajemen data guru dan murid</li>
                <li class="flex items-center"><i class="fas fa-check-circle text-success mr-2"></i> Pengelolaan mata pelajaran</li>
                <li class="flex items-center"><i class="fas fa-check-circle text-success mr-2"></i> Penilaian dan pelaporan nilai siswa</li>
                <li class="flex items-center"><i class="fas fa-check-circle text-success mr-2"></i> Monitoring aktivitas pengguna</li>
            </ul>
            <!-- Penutup deskripsi tentang tujuan aplikasi -->
            <p class="text-gray-600">
                Dibuat oleh tim pengembang untuk mendukung efisiensi administrasi sekolah dengan desain yang modern dan user-friendly.
            </p>
        </div>

        <!-- Card kedua: Informasi tentang tim pengembang -->
        <div class="card-custom mt-4 p-6">
            <!-- Header card dengan ikon dan judul -->
            <div class="flex items-center mb-4">
                <i class="fas fa-users text-3xl text-primary mr-3"></i>
                <h2 class="text-2xl font-semibold text-gray-800">Tim Kami</h2>
            </div>
            <!-- Deskripsi singkat tentang tim pengembang aplikasi -->
            <p class="text-gray-600">
                Kami adalah tim pengembang yang berdedikasi untuk menciptakan solusi teknologi yang membantu dunia pendidikan. Dengan pengalaman bertahun-tahun, kami berkomitmen untuk memberikan aplikasi yang intuitif dan efisien.
            </p>
        </div>
    </div>

    <!-- Memasukkan stylesheet Animate.css untuk efek animasi -->
    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @endpush
@endsection
