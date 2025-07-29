@extends('layouts.admin')

@section('title', 'Tambah Mata Pelajaran')
@section('breadcrumb', 'Tambah Mata Pelajaran')
@section('page-title', 'Tambah')

@section('content')
    <!-- Judul halaman utama -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Mata Pelajaran</h1>
    <!-- Deskripsi singkat tentang halaman -->
    <p class="mb-4">Isi form di bawah ini untuk menambahkan mata pelajaran baru.</p>

    <!-- Card container untuk form tambah mata pelajaran -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Header card dengan judul form -->
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Mata Pelajaran</h6>
        </div>
        <div class="card-body">
            <!-- Menampilkan pesan error validasi jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <!-- Daftar pesan error validasi -->
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <!-- Tombol untuk menutup pesan error -->
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <!-- Form untuk menambah data mata pelajaran -->
            <form method="POST" action="{{ route('admin.mapel.store') }}">
                @csrf <!-- Token CSRF untuk keamanan -->

                <!-- Input field untuk kode mata pelajaran -->
                <div class="form-group">
                    <label for="kode" class="font-weight-bold">Kode:</label>
                    <input type="text" name="kode" id="kode" class="form-control" required>
                    <!-- Menampilkan error spesifik untuk field kode -->
                    @error('kode')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input field untuk nama mata pelajaran -->
                <div class="form-group">
                    <label for="mata_pelajaran" class="font-weight-bold">Mata Pelajaran:</label>
                    <input type="text" name="mata_pelajaran" id="mata_pelajaran" class="form-control" required>
                    <!-- Menampilkan error spesifik untuk field mata_pelajaran -->
                    @error('mata_pelajaran')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Tombol submit untuk menyimpan data -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
                <!-- Tombol batal untuk kembali ke halaman daftar mata pelajaran -->
                <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Batal
                </a>
            </form>
        </div>
    </div>
@endsection
