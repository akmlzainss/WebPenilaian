@extends('layouts.admin')

@section('title', 'Edit Pengguna')
@section('breadcrumb', 'Edit Pengguna')
@section('page-title', 'Edit')

@section('content')
    <!-- Judul halaman utama -->
    <h1 class="h3 mb-2 text-gray-800">Edit Pengguna</h1>
    <p class="mb-4">Ubah data pengguna {{ $user->username }}.</p>

    <!-- Card container untuk form edit pengguna -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Judul card -->
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Pengguna</h6>
        </div>
        <div class="card-body">
            <!-- Menampilkan pesan sukses jika ada -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <!-- Tombol untuk menutup alert -->
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <!-- Menampilkan pesan error validasi jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        <!-- Looping menampilkan semua error -->
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <!-- Tombol untuk menutup alert -->
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <!-- Form untuk mengedit data pengguna -->
            <form action="{{ route('admin.user.update', $user->username) }}" method="POST">
                @csrf <!-- Token CSRF untuk keamanan form -->
                @method('PUT') <!-- Method spoofing untuk HTTP PUT -->

                <!-- Input untuk username dengan nilai default -->
                <div class="form-group">
                    <label class="font-weight-bold">Username:</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control" required>
                </div>

                <!-- Input untuk password baru, kosongkan jika tidak ingin mengubah -->
                <div class="form-group">
                    <label class="font-weight-bold">Kata Sandi (Kosongkan jika tidak ingin mengubah):</label>
                    <input type="password" name="password" class="form-control" minlength="6">
                </div>

                <!-- Input untuk konfirmasi password baru -->
                <div class="form-group">
                    <label class="font-weight-bold">Konfirmasi Kata Sandi:</label>
                    <input type="password" name="password_confirmation" class="form-control" minlength="6">
                </div>

                <!-- Dropdown untuk memilih role pengguna dengan nilai default -->
                <div class="form-group">
                    <label class="font-weight-bold">Role:</label>
                    <select name="role" class="form-control" required>
                        <option value="">Pilih Role</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="murid" {{ old('role', $user->role) == 'murid' ? 'selected' : '' }}>Murid</option>
                    </select>
                </div>

                <!-- Tombol submit untuk menyimpan perubahan -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>

                <!-- Tombol batal kembali ke halaman daftar pengguna -->
                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Batal
                </a>
            </form>
        </div>
    </div>
@endsection
