@extends('layouts.admin')

@section('title', 'Profil Admin')
@section('breadcrumb', 'Profil Admin')
@section('page-title', 'Profil')

@section('content')
    <!-- Judul halaman -->
    <h1 class="h3 mb-2 text-gray-800">Profil Admin</h1>
    <p class="mb-4">Informasi profil admin dan form untuk mengubah kata sandi.</p>

    <!-- Menampilkan pesan sukses jika ada di session -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Menampilkan error validasi jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                <!-- Looping untuk setiap error -->
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Bagian informasi admin -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Judul card -->
            <h6 class="m-0 font-weight-bold text-primary">Informasi Admin</h6>
        </div>
        <div class="card-body">
            <!-- Tampilan foto profil dan info singkat -->
            <div class="d-flex align-items-center mb-4">
                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}" alt="Profile"
                    style="width: 100px; height: 100px;">

                <div class="ml-4"> {{-- Memberikan margin kiri agar jarak antara gambar dan teks cukup --}}
                    <h2 class="h5 font-weight-bold text-gray-800">{{ $user->username }}</h2>
                    <p class="text-gray-600">Role: {{ $user->role }}</p>
                </div>
            </div>

            <!-- Tabel detail profil admin -->
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th>Username</th>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>{{ $user->role }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bagian form untuk mengubah kata sandi -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Judul card -->
            <h6 class="m-0 font-weight-bold text-primary">Edit Kata Sandi</h6>
        </div>
        <div class="card-body">
            <!-- Form update password, metode POST dengan CSRF token -->
            <form action="{{ route('admin.update.password') }}" method="POST">
                @csrf
                <!-- Input untuk kata sandi lama -->
                <div class="form-group">
                    <label for="current_password" class="font-weight-bold">Kata Sandi Lama:</label>
                    <input type="password" name="current_password" id="current_password" class="form-control" required>
                </div>
                <!-- Input untuk kata sandi baru -->
                <div class="form-group">
                    <label for="new_password" class="font-weight-bold">Kata Sandi Baru:</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" required
                        minlength="6">
                </div>
                <!-- Input untuk konfirmasi kata sandi baru -->
                <div class="form-group">
                    <label for="new_password_confirmation" class="font-weight-bold">Konfirmasi Kata Sandi Baru:</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                        class="form-control" required minlength="6">
                </div>
                <!-- Tombol submit untuk menyimpan perubahan -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
@endsection
