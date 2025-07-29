@extends('layouts.admin')

@section('title', 'Tambah Data Guru')
@section('breadcrumb', 'Tambah Guru')
@section('page-title', 'Tambah')

@section('content')
    <!-- Judul halaman dan deskripsi singkat -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Data Guru</h1>
    <p class="mb-4">Isi form di bawah ini untuk menambahkan data guru baru.</p>

    <!-- Card berisi form tambah guru dengan shadow dan margin bawah -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Header card dengan teks bold dan warna utama -->
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Guru</h6>
        </div>
        <div class="card-body">
            <!-- Menampilkan pesan sukses jika ada session 'success' -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <!-- Menampilkan pesan error validasi jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        <!-- Loop untuk menampilkan setiap error -->
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <!-- Form untuk menambahkan data guru, method POST dan route yang dituju -->
            <form action="{{ route('admin.guru.store') }}" method="POST">
                @csrf

                <!-- Input field untuk nama guru dengan validasi error -->
                <div class="form-group">
                    <label class="font-weight-bold">Nama:</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required class="form-control">
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input field untuk NIP guru dengan validasi error -->
                <div class="form-group">
                    <label class="font-weight-bold">NIP:</label>
                    <input type="text" name="nip" value="{{ old('nip') }}" required class="form-control">
                    @error('nip')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input field untuk email guru dengan validasi error -->
                <div class="form-group">
                    <label class="font-weight-bold">Email:</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="form-control">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Dropdown untuk memilih jenis kelamin dengan opsi dan validasi -->
                <div class="form-group">
                    <label class="font-weight-bold">Jenis Kelamin:</label>
                    <select name="jenis_kelamin" required class="form-control">
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input field untuk nomor telepon dengan validasi -->
                <div class="form-group">
                    <label class="font-weight-bold">No Telp:</label>
                    <input type="text" name="no_telp" value="{{ old('no_telp') }}" required class="form-control">
                    @error('no_telp')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input field tanggal lahir dengan validasi -->
                <div class="form-group">
                    <label class="font-weight-bold">Tanggal Lahir:</label>
                    <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required class="form-control">
                    @error('tgl_lahir')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Dropdown untuk memilih mata pelajaran yang diambil dari variabel $mapel -->
                <div class="form-group">
                    <label class="font-weight-bold">Mata Pelajaran:</label>
                    <select name="kode" required class="form-control">
                        @foreach ($mapel as $m)
                            <option value="{{ $m->kode }}" {{ old('kode') == $m->kode ? 'selected' : '' }}>
                                {{ $m->mata_pelajaran }}
                            </option>
                        @endforeach
                    </select>
                    @error('kode')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Tombol submit untuk menyimpan data -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>

                <!-- Tombol batal yang mengarah ke halaman index guru -->
                <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Batal
                </a>
            </form>
        </div>
    </div>
@endsection
