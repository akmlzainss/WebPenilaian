@extends('layouts.guru')

@section('title', 'Edit Nilai')
@section('page-title', 'Edit Nilai')

@section('content')
    <div class="animate__animated animate__fadeIn">
        <!-- Judul Halaman -->
        <h1 class="h3 mb-2 text-gray-800">Edit Nilai</h1>
        <p class="mb-4">Ubah data nilai di bawah ini.</p>

        <!-- Kartu Formulir -->
        <div class="card-custom mb-4">
            <div class="card-header-custom">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-edit me-2"></i> Form Edit Nilai</h6>
            </div>
            <div class="card-body-custom">
                <!-- Menampilkan pesan sukses dari session -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Menampilkan daftar error validasi jika ada -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulir untuk mengedit data nilai -->
                <form action="{{ route('guru.nilai.update', [$nilai->nis, $nilai->kode]) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Method spoofing untuk PUT request -->

                    <!-- Dropdown untuk memilih murid berdasarkan NIS -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-gray-700">NIS Murid:</label>
                        <select name="nis" required class="form-select border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300">
                            <option value="">Pilih Murid</option>
                            @foreach ($murids as $murid)
                                <option value="{{ $murid->nis }}" {{ old('nis', $nilai->nis) == $murid->nis ? 'selected' : '' }}>
                                    {{ $murid->nis }} - {{ $murid->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Input readonly untuk menampilkan nama mata pelajaran -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-gray-700">Mata Pelajaran:</label>
                        <input type="text" value="{{ $guru->mapel->mata_pelajaran ?? 'N/A' }}" class="form-control border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                        <!-- Hidden input untuk mengirim kode mapel -->
                        <input type="hidden" name="kode" value="{{ $guru->kode }}">
                    </div>

                    <!-- Input readonly untuk menampilkan nama guru -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-gray-700">Guru:</label>
                        <input type="text" value="{{ $guru->nama }}" class="form-control border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                        <!-- Hidden input untuk mengirim NIP guru -->
                        <input type="hidden" name="nip" value="{{ $guru->nip }}">
                    </div>

                    <!-- Input nilai numerik -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-gray-700">Nilai:</label>
                        <input type="number" name="nilai" value="{{ old('nilai', $nilai->nilai) }}" required class="form-control border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300" min="0" max="100" step="1">
                    </div>

                    <!-- Dropdown untuk memilih predikat -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-gray-700">Predikat:</label>
                        <select name="predikat" required class="form-select border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300">
                            <option value="">Pilih Predikat</option>
                            <option value="A" {{ old('predikat', $nilai->predikat) == 'A' ? 'selected' : '' }}>A (Sangat Baik)</option>
                            <option value="B" {{ old('predikat', $nilai->predikat) == 'B' ? 'selected' : '' }}>B (Baik)</option>
                            <option value="C" {{ old('predikat', $nilai->predikat) == 'C' ? 'selected' : '' }}>C (Cukup)</option>
                            <option value="D" {{ old('predikat', $nilai->predikat) == 'D' ? 'selected' : '' }}>D (Kurang)</option>
                        </select>
                    </div>

                    <!-- Dropdown untuk memilih semester -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-gray-700">Semester:</label>
                        <select name="semester" required class="form-select border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300">
                            <option value="">Pilih Semester</option>
                            @foreach ($semester_list as $key => $value)
                                <option value="{{ $key }}" {{ old('semester', $nilai->semester) == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tombol aksi -->
                    <div class="flex gap-3">
                        <!-- Tombol simpan -->
                        <button type="submit" class="btn btn-primary-custom"><i class="fas fa-save me-2"></i> Simpan</button>
                        <!-- Tombol batal kembali ke index -->
                        <a href="{{ route('guru.nilai.index') }}" class="btn btn-secondary hover:bg-gray-600 hover:text-white transition-all duration-300"><i class="fas fa-arrow-left me-2"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tambahan animasi CSS -->
    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @endpush
@endsection
