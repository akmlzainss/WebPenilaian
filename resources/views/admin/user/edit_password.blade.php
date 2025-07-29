@extends('layouts.admin')

@section('title', 'Ubah Kata Sandi Pengguna')
@section('breadcrumb', 'Edit Password')
@section('page-title', 'Edit Password')

@section('content')
    <!-- Judul halaman utama -->
    <h1 class="h3 mb-2 text-gray-800">Ubah Kata Sandi Pengguna</h1>
    <p class="mb-4">Ubah kata sandi untuk pengguna {{ $user->username }}.</p>

    <!-- Card container untuk form ubah kata sandi -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Judul card -->
            <h6 class="m-0 font-weight-bold text-primary">Form Ubah Kata Sandi</h6>
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
                        <!-- Looping untuk menampilkan semua error -->
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

            <!-- Form untuk mengubah kata sandi pengguna -->
            <form action="{{ route('admin.user.update.password', $user->username) }}" method="POST">
                @csrf <!-- Token CSRF untuk keamanan -->
                @method('PUT') <!-- Method spoofing untuk HTTP PUT -->

                <!-- Input field untuk kata sandi baru -->
                <div class="form-group">
                    <label class="font-weight-bold">Kata Sandi Baru:</label>
                    <input type="password" name="new_password" class="form-control" required minlength="6">
                </div>

                <!-- Input field untuk konfirmasi kata sandi baru -->
                <div class="form-group">
                    <label class="font-weight-bold">Konfirmasi Kata Sandi Baru:</label>
                    <input type="password" name="new_password_confirmation" class="form-control" required minlength="6">
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
