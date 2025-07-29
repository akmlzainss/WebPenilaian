@extends('layouts.guru')

@section('title', 'Tambah Nilai')
@section('page-title', 'Tambah Nilai')

@section('content')
    <div class="animate__animated animate__fadeIn">
        <!-- Heading halaman -->
        <h1 class="h3 mb-2 text-gray-800">Tambah Nilai</h1>
        <p class="mb-4">Isi form di bawah ini untuk menambahkan data nilai baru.</p>

        <!-- Kartu utama untuk menampung form -->
        <div class="card-custom mb-4">
            <div class="card-header-custom">
                <!-- Judul card -->
                <h6 class="m-0 font-weight-bold"><i class="fas fa-plus me-2"></i> Form Tambah Nilai</h6>
            </div>

            <div class="card-body-custom">
                <!-- Tampilkan notifikasi sukses jika ada -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Tampilkan pesan error validasi jika ada -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form tambah nilai -->
                <form action="{{ route('guru.nilai.store') }}" method="POST">
                    @csrf

                    <!-- Pilih murid berdasarkan NIS -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-gray-700">NIS Murid:</label>
                        <select name="nis" required
                            class="form-select border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300">
                            <option value="">Pilih Murid</option>
                            @foreach ($murids as $murid)
                                <option value="{{ $murid->nis }}" {{ old('nis') == $murid->nis ? 'selected' : '' }}>
                                    {{ $murid->nis }} - {{ $murid->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Menampilkan mata pelajaran yang diajar oleh guru -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-gray-700">Mata Pelajaran:</label>
                        <input type="text" value="{{ $guru->mapel->mata_pelajaran ?? 'N/A' }}"
                            class="form-control border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                        <input type="hidden" name="kode" value="{{ $guru->kode }}">
                    </div>

                    <!-- Menampilkan nama guru -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-gray-700">Guru:</label>
                        <input type="text" value="{{ $guru->nama }}"
                            class="form-control border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                        <input type="hidden" name="nip" value="{{ $guru->nip }}">
                    </div>

                    <!-- Input nilai angka -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-gray-700">Nilai:</label>
                        <input type="number" name="nilai" value="{{ old('nilai') }}" required min="0" max="100" step="1"
                            class="form-control border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300">
                    </div>

                    <!-- Pilih predikat nilai -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-gray-700">Predikat:</label>
                        <select name="predikat" required
                            class="form-select border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300">
                            <option value="">Pilih Predikat</option>
                            <option value="A" {{ old('predikat') == 'A' ? 'selected' : '' }}>A (Sangat Baik)</option>
                            <option value="B" {{ old('predikat') == 'B' ? 'selected' : '' }}>B (Baik)</option>
                            <option value="C" {{ old('predikat') == 'C' ? 'selected' : '' }}>C (Cukup)</option>
                            <option value="D" {{ old('predikat') == 'D' ? 'selected' : '' }}>D (Kurang)</option>
                        </select>
                    </div>

                    <!-- Pilih semester -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-gray-700">Semester:</label>
                        <select name="semester" required
                            class="form-select border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300">
                            <option value="">Pilih Semester</option>
                            @foreach ($semester_list as $key => $value)
                                <option value="{{ $key }}" {{ old('semester') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tombol Simpan dan Batal -->
                    <div class="flex gap-3">
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="fas fa-save me-2"></i> Simpan
                        </button>
                        <a href="{{ route('guru.nilai.index') }}"
                            class="btn btn-secondary hover:bg-gray-600 hover:text-white transition-all duration-300">
                            <i class="fas fa-arrow-left me-2"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tambahkan animasi dari Animate.css -->
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @endpush
@endsection
