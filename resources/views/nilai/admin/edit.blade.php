@extends('layouts.admin') {{-- Menggunakan layout admin --}}

@section('title', 'Edit Nilai') {{-- Menentukan judul halaman --}}
@section('breadcrumb', 'Edit Nilai') {{-- Menentukan breadcrumb untuk navigasi --}}
@section('page-title', 'Edit') {{-- Menentukan judul halaman utama --}}

@section('content')
    <!-- Judul halaman -->
    <h1 class="h3 mb-2 text-gray-800">Edit Nilai</h1>
    <p class="mb-4">Edit informasi nilai di bawah ini.</p>

    <!-- Kartu berisi form edit nilai -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Header pada kartu -->
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Nilai</h6>
        </div>
        <div class="card-body">
            <!-- Menampilkan pesan error validasi jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li> {{-- Menampilkan setiap error --}}
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <!-- Form untuk mengedit data nilai -->
            <form action="{{ route('admin.nilai.update', ['nis' => $nilai->nis, 'kode' => $nilai->kode]) }}" method="POST">
                @csrf {{-- Token keamanan untuk form --}}
                @method('PUT') {{-- Menggunakan metode PUT untuk update data --}}

                <!-- Input NIP Guru (readonly karena tidak bisa diubah) -->
                <div class="form-group">
                    <label for="nip" class="font-weight-bold">NIP Guru:</label>
                    <input type="text" name="nip" id="nip" value="{{ $nilai->nip }}" readonly class="form-control">
                </div>

                <!-- Input NIS Murid (readonly karena tidak bisa diubah) -->
                <div class="form-group">
                    <label for="nis" class="font-weight-bold">NIS:</label>
                    <input type="text" name="nis" id="nis" value="{{ $nilai->nis }}" readonly class="form-control">
                </div>

                <!-- Input Kode Mata Pelajaran (readonly karena tidak bisa diubah) -->
                <div class="form-group">
                    <label for="kode" class="font-weight-bold">Kode Mapel:</label>
                    <input type="text" name="kode" id="kode" value="{{ $nilai->kode }}" readonly class="form-control">
                </div>

                <!-- Input nilai angka (dapat diedit) -->
                <div class="form-group">
                    <label for="nilai" class="font-weight-bold">Nilai:</label>
                    <input type="number" name="nilai" id="nilai" value="{{ $nilai->nilai }}" min="0" max="100" required class="form-control">
                </div>

                <!-- Pilihan predikat nilai -->
                <div class="form-group">
                    <label for="predikat" class="font-weight-bold">Predikat:</label>
                    <select name="predikat" id="predikat" required class="form-control">
                        <option value="A" {{ $nilai->predikat == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ $nilai->predikat == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ $nilai->predikat == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ $nilai->predikat == 'D' ? 'selected' : '' }}>D</option>
                        <option value="E" {{ $nilai->predikat == 'E' ? 'selected' : '' }}>E</option>
                    </select>
                </div>

                <!-- Pilihan semester -->
                <div class="form-group">
                    <label for="semester" class="font-weight-bold">Semester:</label>
                    <select name="semester" id="semester" required class="form-control">
                        <option value="1" {{ $nilai->semester == '1' ? 'selected' : '' }}>Semester 1</option>
                        <option value="2" {{ $nilai->semester == '2' ? 'selected' : '' }}>Semester 2</option>
                    </select>
                </div>

                <!-- Tombol submit dan batal -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Update {{-- Tombol simpan perubahan --}}
                </button>
                <a href="{{ route('admin.nilai.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Batal {{-- Tombol kembali ke halaman index --}}
                </a>
            </form>
        </div>
    </div>
@endsection
