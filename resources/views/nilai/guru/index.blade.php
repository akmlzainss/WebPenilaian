@extends('layouts.guru')

@section('title', 'Manajemen Nilai')
@section('page-title', 'Manajemen Nilai')

@section('content')
    <div class="animate__animated animate__fadeIn">
        <!-- Judul Halaman -->
        <h1 class="h3 mb-2 text-gray-800">Daftar Nilai</h1>
        <p class="mb-4">Berikut adalah daftar nilai yang Anda kelola di sistem.</p>

        <!-- Form Filter dan Pencarian Data Nilai -->
        <div class="card-custom mb-4">
            <div class="card-header-custom">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-filter me-2"></i> Filter Data Nilai</h6>
            </div>
            <div class="card-body-custom">
                <form method="GET" action="{{ route('guru.nilai.index') }}" class="row g-3">
                    <!-- Input untuk mencari nama murid atau NIS -->
                    <div class="col-md-3">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama murid atau NIS"
                            class="form-control border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300">
                    </div>
                    <!-- Dropdown filter semester -->
                    <div class="col-md-2">
                        <select name="semester"
                            class="form-select border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300">
                            <option value="">Pilih Semester</option>
                            @foreach ($semester_list as $key => $value)
                                <option value="{{ $key }}" {{ request('semester') == $key ? 'selected' : '' }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Dropdown filter predikat -->
                    <div class="col-md-2">
                        <select name="predikat"
                            class="form-select border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300">
                            <option value="">Pilih Predikat</option>
                            @foreach ($predikat_list as $key => $value)
                                <option value="{{ $key }}" {{ request('predikat') == $key ? 'selected' : '' }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Filter nilai minimum -->
                    <div class="col-md-2">
                        <input type="number" name="nilai_min" value="{{ request('nilai_min') }}" placeholder="Nilai Min"
                            class="form-control border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300"
                            min="0" max="100">
                    </div>
                    <!-- Filter nilai maksimum -->
                    <div class="col-md-2">
                        <input type="number" name="nilai_max" value="{{ request('nilai_max') }}" placeholder="Nilai Max"
                            class="form-control border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300"
                            min="0" max="100">
                    </div>
                    <!-- Tombol pencarian -->
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary-custom w-100"><i class="fas fa-search me-2"></i>
                            Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tombol Tambah Nilai dan Ekspor Data -->
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <!-- Tombol tambah nilai baru -->
                <a href="{{ route('guru.nilai.create') }}" class="btn btn-primary-custom">
                    <i class="fas fa-plus me-2"></i> Tambah Nilai
                </a>
                <!-- Form untuk ekspor data nilai ke format file -->
                <form method="GET" action="{{ route('guru.nilai.export') }}"
                    class="d-inline-flex align-items-center gap-2">
                    <select name="format"
                        class="form-select border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300"
                        style="width: auto;">
                        <option value="excel">Excel</option>
                        <option value="pdf">PDF</option>
                        <option value="word">Word</option>
                    </select>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-download me-2"></i> Ekspor
                    </button>
                </form>
            </div>
            <!-- Tombol kembali ke dashboard guru -->
            <a href="{{ route('guru.dashboard') }}"
                class="btn btn-secondary hover:bg-gray-600 hover:text-white transition-all duration-300">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>

        <!-- Tabel Data Nilai -->
        <div class="card-custom mb-4">
            <div class="card-header-custom">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-table me-2"></i> Data Nilai</h6>
            </div>
            <div class="card-body-custom">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableNilai" width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">
                                <th>NIS</th>
                                <!-- Kolom Nama Murid dengan fitur sorting -->
                                <th>
                                    <a href="{{ route('guru.nilai.index', array_merge(request()->query(), ['sort' => 'murid.nama', 'direction' => request('direction', 'asc') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="text-primary hover:underline flex items-center gap-1">
                                        Nama Murid
                                        <i
                                            class="fas fa-sort {{ request('sort') == 'murid.nama' ? (request('direction') == 'asc' ? 'fa-sort-up' : 'fa-sort-down') : '' }}"></i>
                                    </a>
                                </th>
                                <th>Mata Pelajaran</th>
                                <!-- Kolom Nilai dengan fitur sorting -->
                                <th>
                                    <a href="{{ route('guru.nilai.index', array_merge(request()->query(), ['sort' => 'nilai', 'direction' => request('direction', 'asc') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="text-primary hover:underline flex items-center gap-1">
                                        Nilai
                                        <i
                                            class="fas fa-sort {{ request('sort') == 'nilai' ? (request('direction') == 'asc' ? 'fa-sort-up' : 'fa-sort-down') : '' }}"></i>
                                    </a>
                                </th>
                                <th>Predikat</th>
                                <th>Semester</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop data nilai -->
                            @forelse($nilai as $n)
                                <tr class="transition-all duration-300 hover:bg-gray-50">
                                    <td>{{ $n->nis }}</td>
                                    <td>{{ $n->murid->nama ?? 'N/A' }}</td>
                                    <td>{{ $n->mapel->mata_pelajaran ?? 'N/A' }}</td>
                                    <!-- Badge warna sesuai range nilai -->
                                    <td><span
                                            class="badge bg-{{ $n->nilai >= 90 ? 'success' : ($n->nilai >= 75 ? 'info' : ($n->nilai >= 60 ? 'warning' : 'danger')) }} px-3 py-1 rounded-full">{{ $n->nilai }}</span>
                                    </td>
                                    <td>{{ $n->predikat }}</td>
                                    <td>{{ $n->semester }}</td>
                                    <td>
                                        <!-- Tombol Aksi Edit dan Hapus -->
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('guru.nilai.edit', [$n->nis, $n->kode]) }}"
                                                class="btn btn-warning btn-sm hover:bg-yellow-500 transition-all duration-300"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST"
                                                action="{{ route('guru.nilai.destroy', [$n->nis, $n->kode]) }}"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm hover:bg-red-600 transition-all duration-300"
                                                    onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <!-- Jika tidak ada data nilai -->
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Tidak ada data nilai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS Tambahan -->
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
        <style>
            /* Perbaikan gaya tampilan pagination */
            .dataTables_paginate .pagination {
                margin: 0;
            }
            .dataTables_paginate .pagination .page-link {
                padding: 0.5rem 0.75rem;
                font-size: 0.9rem;
            }
            .dataTables_paginate .pagination .page-item {
                margin-right: 0.2rem;
            }
        </style>
    @endpush

    <!-- Script Tambahan -->
    @push('scripts')
        <!-- jQuery dan DataTables -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

        <script>
            $(document).ready(function() {
                // Inisialisasi DataTables
                $('#dataTableNilai').DataTable({
                    paging: true,
                    searching: false, // Nonaktifkan pencarian karena sudah ada filter custom
                    ordering: true,
                    info: true,
                    autoWidth: false,
                    responsive: true,
                    pageLength: 10,
                    language: {
                        lengthMenu: "Tampilkan _MENU_ data per halaman",
                        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        infoEmpty: "Tidak ada data tersedia",
                        infoFiltered: "(difilter dari total _MAX_ data)",
                        zeroRecords: "Tidak ditemukan data",
                        paginate: {
                            next: "Berikutnya",
                            previous: "Sebelumnya"
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
