@extends('layouts.admin')

@section('title', 'Tambah Nilai')
@section('breadcrumb', 'Tambah Nilai')
@section('page-title', 'Tambah')

@section('content')
    <!-- Judul Halaman -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Nilai</h1>
    <!-- Deskripsi singkat halaman -->
    <p class="mb-4">Isi form di bawah ini untuk menambahkan data nilai baru.</p>

    <!-- Card pembungkus form tambah nilai -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Judul form -->
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Nilai</h6>
        </div>
        <div class="card-body">
            <!-- Menampilkan pesan sukses jika ada -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <!-- Tombol close pada alert -->
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <!-- Menampilkan daftar error validasi jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        <!-- Loop menampilkan setiap error -->
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <!-- Tombol close pada alert error -->
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <!-- Form input data nilai baru -->
            <form action="{{ route('admin.nilai.store') }}" method="POST">
                @csrf
                <!-- Dropdown pilih NIS murid -->
                <div class="form-group">
                    <label class="font-weight-bold">NIS Murid:</label>
                    <select name="nis" required class="form-control">
                        <option value="">Pilih Murid</option>
                        <!-- Loop data murid untuk opsi select -->
                        @foreach ($murids as $murid)
                            <option value="{{ $murid->nis }}" {{ old('nis') == $murid->nis ? 'selected' : '' }}>
                                {{ $murid->nis }} - {{ $murid->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Dropdown pilih mata pelajaran -->
                <div class="form-group">
                    <label class="font-weight-bold">Mata Pelajaran:</label>
                    <select name="kode" required class="form-control">
                        <option value="">Pilih Mata Pelajaran</option>
                        <!-- Loop data mapel untuk opsi select -->
                        @foreach ($mapels as $m)
                            <option value="{{ $m->kode }}" {{ old('kode') == $m->kode ? 'selected' : '' }}>
                                {{ $m->mata_pelajaran }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Dropdown pilih guru -->
                <div class="form-group">
                    <label class="font-weight-bold">Guru:</label>
                    <select name="nip" required class="form-control">
                        <option value="">Pilih Guru</option>
                        <!-- Loop data guru untuk opsi select -->
                        @foreach ($gurus as $g)
                            <option value="{{ $g->nip }}" {{ old('nip') == $g->nip ? 'selected' : '' }}>
                                {{ $g->nama }} ({{ $g->mapel->mata_pelajaran ?? 'N/A' }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Input nilai angka -->
                <div class="form-group">
                    <label class="font-weight-bold">Nilai:</label>
                    <input type="number" name="nilai" value="{{ old('nilai') }}" required class="form-control" min="0" max="100" step="1">
                </div>
                <!-- Dropdown pilih predikat nilai -->
                <div class="form-group">
                    <label class="font-weight-bold">Predikat:</label>
                    <select name="predikat" required class="form-control">
                        <option value="">Pilih Predikat</option>
                        <option value="A" {{ old('predikat') == 'A' ? 'selected' : '' }}>A (Sangat Baik)</option>
                        <option value="B" {{ old('predikat') == 'B' ? 'selected' : '' }}>B (Baik)</option>
                        <option value="C" {{ old('predikat') == 'C' ? 'selected' : '' }}>C (Cukup)</option>
                        <option value="D" {{ old('predikat') == 'D' ? 'selected' : '' }}>D (Kurang)</option>
                    </select>
                </div>
                <!-- Dropdown pilih semester -->
                <div class="form-group">
                    <label class="font-weight-bold">Semester:</label>
                    <select name="semester" required class="form-control">
                        <option value="">Pilih Semester</option>
                        <!-- Loop data semester untuk opsi select -->
                        @foreach ($semester_list as $key => $value)
                            <option value="{{ $key }}" {{ old('semester') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Tombol submit simpan data -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
                <!-- Tombol batal kembali ke index nilai -->
                <a href="{{ route('admin.nilai.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Batal
                </a>
            </form>
        </div>
    </div>
@endsection
