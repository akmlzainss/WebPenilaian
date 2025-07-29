@extends('layouts.admin')

@section('title', 'Edit Murid')
@section('breadcrumb', 'Edit Murid')
@section('page-title', 'Edit')

@section('content')
    <!-- Judul halaman dan deskripsi singkat -->
    <h1 class="h3 mb-2 text-gray-800">Edit Murid</h1>
    <p class="mb-4">Ubah data murid di bawah ini.</p>

    <!-- Card container untuk form edit murid dengan shadow dan margin bawah -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Judul card -->
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Murid</h6>
        </div>
        <div class="card-body">
            <!-- Menampilkan pesan sukses jika ada, dengan tombol close -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <!-- Menampilkan error validasi jika ada, dengan daftar pesan dan tombol close -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        <!-- Loop setiap error validasi dan tampilkan -->
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <!-- Form untuk mengupdate data murid dengan method PUT ke route update -->
            <form action="{{ route('admin.murid.update', $murid->nis) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Input Nama Murid -->
                <div class="form-group">
                    <label class="font-weight-bold">Nama:</label>
                    <input type="text" name="nama" value="{{ old('nama', $murid->nama) }}" required class="form-control">
                    <!-- Pesan error validasi untuk field nama -->
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input NIS -->
                <div class="form-group">
                    <label class="font-weight-bold">NIS:</label>
                    <input type="text" name="nis" value="{{ old('nis', $murid->nis) }}" required class="form-control">
                    <!-- Pesan error validasi untuk field nis -->
                    @error('nis')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Select Kelas -->
                <div class="form-group">
                    <label class="font-weight-bold">Kelas:</label>
                    <select name="kelas" required class="form-control">
                        <option value="" disabled {{ old('kelas', $murid->kelas) ? '' : 'selected' }}>Pilih Kelas</option>
                        <!-- Loop data kelas untuk pilihan -->
                        @foreach ($kelas_list as $kelas)
                            <option value="{{ $kelas }}" {{ old('kelas', $murid->kelas) == $kelas ? 'selected' : '' }}>
                                {{ $kelas }}
                            </option>
                        @endforeach
                    </select>
                    <!-- Pesan error validasi untuk field kelas -->
                    @error('kelas')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Select Jenis Kelamin -->
                <div class="form-group">
                    <label class="font-weight-bold">Jenis Kelamin:</label>
                    <select name="jenis_kelamin" required class="form-control">
                        <option value="L" {{ old('jenis_kelamin', $murid->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $murid->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    <!-- Pesan error validasi untuk field jenis_kelamin -->
                    @error('jenis_kelamin')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input No Telp -->
                <div class="form-group">
                    <label class="font-weight-bold">No Telp:</label>
                    <input type="text" name="no_telp" value="{{ old('no_telp', $murid->no_telp) }}" required class="form-control">
                    <!-- Pesan error validasi untuk field no_telp -->
                    @error('no_telp')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input Tanggal Lahir -->
                <div class="form-group">
                    <label class="font-weight-bold">Tanggal Lahir:</label>
                    <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $murid->tgl_lahir) }}" required class="form-control">
                    <!-- Pesan error validasi untuk field tgl_lahir -->
                    @error('tgl_lahir')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Tombol Submit untuk update data -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Update
                </button>

                <!-- Tombol batal untuk kembali ke daftar murid -->
                <a href="{{ route('admin.murid.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Batal
                </a>
            </form>
        </div>
    </div>
@endsection
