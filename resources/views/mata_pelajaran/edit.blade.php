@extends('layouts.admin')

@section('title', 'Edit Mata Pelajaran')
@section('breadcrumb', 'Edit Mata Pelajaran')
@section('page-title', 'Edit')

@section('content')
    <!-- Judul halaman utama -->
    <h1 class="h3 mb-2 text-gray-800">Edit Mata Pelajaran</h1>
    <!-- Deskripsi singkat halaman -->
    <p class="mb-4">Edit informasi mata pelajaran di bawah ini.</p>

    <!-- Card container untuk form edit mata pelajaran -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Header card dengan judul form -->
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Mata Pelajaran</h6>
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

            <!-- Form edit data mata pelajaran dengan method PUT -->
            <form method="POST" action="{{ route('admin.mapel.update', $mapel->kode) }}">
                @csrf <!-- Token CSRF untuk keamanan -->
                @method('PUT') <!-- Override method POST menjadi PUT untuk update -->

                <!-- Input field untuk kode mata pelajaran -->
                <div class="form-group">
                    <label for="kode" class="font-weight-bold">Kode:</label>
                    <!-- Mengisi nilai lama atau nilai dari model -->
                    <input type="text" name="kode" id="kode" value="{{ old('kode', $mapel->kode) }}" class="form-control" required>
                    <!-- Menampilkan error spesifik untuk field kode -->
                    @error('kode')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input field untuk nama mata pelajaran -->
                <div class="form-group">
                    <label for="mata_pelajaran" class="font-weight-bold">Mata Pelajaran:</label>
                    <!-- Mengisi nilai lama atau nilai dari model -->
                    <input type="text" name="mata_pelajaran" id="mata_pelajaran" value="{{ old('mata_pelajaran', $mapel->mata_pelajaran) }}" class="form-control" required>
                    <!-- Menampilkan error spesifik untuk field mata_pelajaran -->
                    @error('mata_pelajaran')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Tombol submit untuk menyimpan perubahan -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
                <!-- Tombol batal untuk kembali ke daftar mata pelajaran -->
                <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Batal
                </a>
            </form>
        </div>
    </div>
@endsection
