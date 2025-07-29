@extends('layouts.admin')

@section('title', 'Tambah Pengguna')
@section('breadcrumb', 'Tambah Pengguna')
@section('page-title', 'Tambah Pengguna')

@section('content')
    <!-- Judul halaman utama -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Pengguna</h1>
    <p class="mb-4">Isi form di bawah untuk menambahkan pengguna baru.</p>

    <!-- Card container untuk form tambah pengguna -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Judul card -->
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Pengguna</h6>
        </div>
        <div class="card-body">
            <!-- Menampilkan pesan sukses jika ada -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <!-- Tombol close alert -->
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <!-- Menampilkan pesan error validasi jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        <!-- Looping untuk menampilkan semua error -->
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <!-- Tombol close alert -->
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <!-- Form untuk menambah pengguna baru -->
            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf <!-- Token CSRF untuk keamanan -->

                <!-- Input field username -->
                <div class="form-group">
                    <label class="font-weight-bold">Username:</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control" required>
                </div>

                <!-- Input field password -->
                <div class="form-group">
                    <label class="font-weight-bold">Kata Sandi:</label>
                    <input type="password" name="password" class="form-control" required minlength="6">
                </div>

                <!-- Input field konfirmasi password -->
                <div class="form-group">
                    <label class="font-weight-bold">Konfirmasi Kata Sandi:</label>
                    <input type="password" name="password_confirmation" class="form-control" required minlength="6">
                </div>

                <!-- Dropdown pilihan role pengguna -->
                <div class="form-group">
                    <label class="font-weight-bold">Role:</label>
                    <select name="role" class="form-control" required>
                        <option value="">Pilih Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="murid" {{ old('role') == 'murid' ? 'selected' : '' }}>Murid</option>
                    </select>
                </div>

                <!-- Tombol submit simpan data -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>

                <!-- Tombol batal kembali ke halaman index pengguna -->
                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Batal
                </a>
            </form>
        </div>
    </div>
@endsection
