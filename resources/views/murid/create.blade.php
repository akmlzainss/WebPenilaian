@extends('layouts.admin')

@section('title', 'Tambah Murid')
@section('breadcrumb', 'Tambah Murid')
@section('page-title', 'Tambah')

@section('content')
    <!-- Heading halaman untuk tambah murid -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Murid</h1>
    <p class="mb-4">Isi form di bawah ini untuk menambahkan murid baru.</p>

    <!-- Card pembungkus form tambah murid -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Judul form -->
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Murid</h6>
        </div>
        <div class="card-body">
            <!-- Menampilkan pesan sukses jika ada -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <!-- Menampilkan daftar error validasi jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <!-- Form tambah murid, metode POST ke route store -->
            <form action="{{ route('admin.murid.store') }}" method="POST">
                @csrf
                <!-- Input nama murid -->
                <div class="form-group">
                    <label class="font-weight-bold">Nama:</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required class="form-control">
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input NIS murid -->
                <div class="form-group">
                    <label class="font-weight-bold">NIS:</label>
                    <input type="text" name="nis" value="{{ old('nis') }}" required class="form-control">
                    @error('nis')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Dropdown pilihan kelas -->
                <div class="form-group">
                    <label class="font-weight-bold">Kelas:</label>
                    <select name="kelas" required class="form-control">
                        <option value="" disabled {{ old('kelas') ? '' : 'selected' }}>Pilih Kelas</option>
                        @foreach ($kelas_list as $kelas)
                            <option value="{{ $kelas }}" {{ old('kelas') == $kelas ? 'selected' : '' }}>
                                {{ $kelas }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Dropdown pilihan jenis kelamin -->
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

                <!-- Input nomor telepon -->
                <div class="form-group">
                    <label class="font-weight-bold">No Telp:</label>
                    <input type="text" name="no_telp" value="{{ old('no_telp') }}" required class="form-control">
                    @error('no_telp')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input tanggal lahir -->
                <div class="form-group">
                    <label class="font-weight-bold">Tanggal Lahir:</label>
                    <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required class="form-control">
                    @error('tgl_lahir')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Tombol submit simpan data -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
                <!-- Tombol batal kembali ke daftar murid -->
                <a href="{{ route('admin.murid.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Batal
                </a>
            </form>
        </div>
    </div>
@endsection
