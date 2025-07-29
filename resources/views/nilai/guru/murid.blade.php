@extends('layouts.guru') {{-- Menggunakan layout khusus untuk tampilan guru --}}

@section('title', 'Nilai Murid') {{-- Judul halaman (di <title>) --}}
@section('page-title', 'Nilai Murid: {{ $murid->nama }}') {{-- Judul besar di halaman --}}

@section('content')
    {{-- Container utama dengan animasi masuk --}}
    <div class="container mx-auto px-4 py-8 animate__animated animate__fadeIn">
        {{-- Heading utama halaman --}}
        <h1 class="text-3xl font-bold mb-6">Nilai Murid: {{ $murid->nama }}</h1>

        {{-- Tampilkan notifikasi sukses jika ada --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Tombol untuk menambahkan nilai baru --}}
        <div class="mb-6">
            <a href="{{ route('guru.nilai.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-2"></i> Tambah Nilai
            </a>
        </div>

        {{-- Kartu berisi tabel nilai --}}
        <div class="card-custom">
            {{-- Header kartu --}}
            <div class="card-header-custom">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-table me-2"></i> Daftar Nilai
                </h6>
            </div>

            {{-- Isi kartu --}}
            <div class="card-body-custom">
                {{-- Tabel responsive --}}
                <div class="table-responsive">
                    <table class="min-w-full table-auto">
                        {{-- Header tabel --}}
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">
                                <th class="border px-4 py-2">Mata Pelajaran</th>
                                <th class="border px-4 py-2">Nilai</th>
                                <th class="border px-4 py-2">Predikat</th>
                                <th class="border px-4 py-2">Semester</th>
                                <th class="border px-4 py-2">Aksi</th>
                            </tr>
                        </thead>

                        {{-- Isi data nilai --}}
                        <tbody>
                            @forelse($nilai as $n)
                                <tr class="transition-all duration-300 hover:bg-gray-50">
                                    {{-- Kode mapel --}}
                                    <td class="border px-4 py-2">{{ $n->kode }}</td>

                                    {{-- Nilai dengan badge warna berdasarkan rentang nilai --}}
                                    <td class="border px-4 py-2">
                                        <span class="badge bg-{{ $n->nilai >= 90 ? 'success' : ($n->nilai >= 75 ? 'info' : ($n->nilai >= 60 ? 'warning' : 'danger')) }} px-3 py-1 rounded-full">
                                            {{ $n->nilai }}
                                        </span>
                                    </td>

                                    {{-- Predikat nilai --}}
                                    <td class="border px-4 py-2">{{ $n->predikat }}</td>

                                    {{-- Semester --}}
                                    <td class="border px-4 py-2">{{ $n->semester }}</td>

                                    {{-- Tombol aksi edit --}}
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('guru.nilai.edit', [$n->nis, $n->kode]) }}"
                                           class="btn btn-primary btn-sm hover:bg-blue-600 transition-all duration-300">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                {{-- Tampilkan pesan jika tidak ada data --}}
                                <tr>
                                    <td colspan="5" class="border px-4 py-2 text-center text-muted">
                                        Belum ada nilai untuk murid ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Tombol kembali ke halaman pencarian murid --}}
        <div class="mt-4">
            <a href="{{ route('guru.murid.search') }}"
               class="btn btn-outline-primary hover:bg-primary hover:text-white transition-all duration-300">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Pencarian Murid
            </a>
        </div>
    </div>

    {{-- Tambahan CSS animasi --}}
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @endpush
@endsection
