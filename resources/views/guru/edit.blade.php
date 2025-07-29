@extends('layouts.admin')

@section('title', 'Edit Data Guru')
@section('breadcrumb', 'Edit Guru')
@section('page-title', 'Edit')

@section('content')
    <!-- Judul halaman dan deskripsi singkat -->
    <h1 class="h3 mb-2 text-gray-800">Edit Data Guru</h1>
    <p class="mb-4">Edit informasi guru di bawah ini.</p>

    <!-- Card berisi form edit guru dengan shadow dan margin bawah -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Header card dengan teks bold dan warna utama -->
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Guru</h6>
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
                        <!-- Loop untuk menampilkan setiap error validasi -->
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <!-- Form untuk mengedit data guru, method POST dengan override PUT -->
            <form action="{{ route('admin.guru.update', $guru->nip) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Input field nama guru dengan value lama atau dari database dan validasi error -->
                <div class="form-group">
                    <label class="font-weight-bold">Nama:</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $guru->nama) }}" required class="form-control">
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input field NIP guru readonly karena tidak boleh diubah, dengan validasi error -->
                <div class="form-group">
                    <label class="font-weight-bold">NIP:</label>
                    <input type="text" name="nip" id="nip" value="{{ old('nip', $guru->nip) }}" required class="form-control" readonly>
                    @error('nip')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input field email guru dengan validasi error -->
                <div class="form-group">
                    <label class="font-weight-bold">Email:</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $guru->email) }}" required class="form-control">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Dropdown jenis kelamin dengan pilihan dan validasi error -->
                <div class="form-group">
                    <label class="font-weight-bold">Jenis Kelamin:</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" required class="form-control">
                        <option value="L" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input field nomor telepon guru dengan validasi -->
                <div class="form-group">
                    <label class="font-weight-bold">No Telp:</label>
                    <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp', $guru->no_telp) }}" required class="form-control">
                    @error('no_telp')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input field tanggal lahir guru dengan validasi -->
                <div class="form-group">
                    <label class="font-weight-bold">Tanggal Lahir:</label>
                    <input type="date" name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir', $guru->tgl_lahir) }}" required class="form-control">
                    @error('tgl_lahir')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Dropdown mata pelajaran dengan opsi dari variabel $mapel dan validasi error -->
                <div class="form-group">
                    <label class="font-weight-bold">Mata Pelajaran:</label>
                    <select name="kode" id="kode" required class="form-control">
                        @foreach ($mapel as $m)
                            <option value="{{ $m->kode }}" {{ old('kode', $guru->kode) == $m->kode ? 'selected' : '' }}>
                                {{ $m->mata_pelajaran }}
                            </option>
                        @endforeach
                    </select>
                    @error('kode')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Tombol submit untuk memperbarui data -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Perbarui
                </button>

                <!-- Tombol kembali ke halaman daftar guru -->
                <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </form>
        </div>
    </div>
@endsection
