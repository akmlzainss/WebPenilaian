@extends('layouts.guru')

@section('title', 'Cari Murid')
@section('page-title', 'Cari Murid')

@section('content')
    <div class="container mt-4 animate__animated animate__fadeIn">
        <h1 class="h3 mb-2 text-gray-800">Cari Murid</h1>

        <!-- Form Pencarian -->
        <div class="card-custom mb-4">
            <div class="card-header-custom">
                <!-- Judul form pencarian dengan ikon pencarian -->
                <h6 class="m-0 font-weight-bold"><i class="fas fa-search me-2"></i> Form Pencarian</h6>
            </div>
            <div class="card-body-custom">
                <!-- Form GET untuk pencarian murid berdasarkan nama, kelas, dan jenis kelamin -->
                <form method="GET" action="{{ route('guru.murid.search') }}" class="row g-3">
                    <!-- Input teks untuk pencarian berdasarkan nama murid -->
                    <div class="col-md-3">
                        <label for="search" class="form-label font-medium text-gray-700">Cari Nama:</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Masukkan nama murid"
                            class="form-control border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300">
                    </div>

                    <!-- Dropdown untuk memilih kelas -->
                    <div class="col-md-3">
                        <label for="kelas" class="form-label font-medium text-gray-700">Kelas:</label>
                        <select name="kelas" class="form-select border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300">
                            <option value="">Semua Kelas</option>
                            <!-- Loop untuk menampilkan opsi kelas yang tersedia -->
                            @foreach ($kelas_list as $kelas)
                                <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>
                                    {{ $kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dropdown untuk memilih jenis kelamin -->
                    <div class="col-md-3">
                        <label for="jenis_kelamin" class="form-label font-medium text-gray-700">Jenis Kelamin:</label>
                        <select name="jenis_kelamin" class="form-select border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300">
                            <option value="">Semua</option>
                            <!-- Loop untuk opsi jenis kelamin -->
                            @foreach ($jenis_kelamin_list as $key => $value)
                                <option value="{{ $key }}" {{ request('jenis_kelamin') == $key ? 'selected' : '' }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tombol submit untuk menjalankan pencarian -->
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary-custom w-100"><i class="fas fa-search me-2"></i> Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Hasil Pencarian -->
        <div class="card-custom mb-4">
            <div class="card-header-custom">
                <!-- Judul tabel hasil pencarian dengan ikon tabel -->
                <h6 class="m-0 font-weight-bold"><i class="fas fa-table me-2"></i> Hasil Pencarian</h6>
            </div>
            <div class="card-body-custom">
                <div class="table-responsive">
                    <!-- Tabel Data Murid -->
                    <table class="table table-bordered" id="dataTableMurid" width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">
                                <!-- Header kolom Nama dengan fitur sorting -->
                                <th>
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'nama', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}"
                                        class="text-primary hover:underline flex items-center gap-1">
                                        Nama
                                        <i class="fas fa-sort {{ request('sort') == 'nama' ? (request('direction') == 'asc' ? 'fa-sort-up' : 'fa-sort-down') : '' }}"></i>
                                    </a>
                                </th>
                                <!-- Header kolom NIS dengan fitur sorting -->
                                <th>
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'nis', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}"
                                        class="text-primary hover:underline flex items-center gap-1">
                                        NIS
                                        <i class="fas fa-sort {{ request('sort') == 'nis' ? (request('direction') == 'asc' ? 'fa-sort-up' : 'fa-sort-down') : '' }}"></i>
                                    </a>
                                </th>
                                <!-- Header kolom Kelas dengan fitur sorting -->
                                <th>
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'kelas', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}"
                                        class="text-primary hover:underline flex items-center gap-1">
                                        Kelas
                                        <i class="fas fa-sort {{ request('sort') == 'kelas' ? (request('direction') == 'asc' ? 'fa-sort-up' : 'fa-sort-down') : '' }}"></i>
                                    </a>
                                </th>
                                <!-- Header kolom Mata Pelajaran (tidak sortable) -->
                                <th>Mata Pelajaran</th>
                                <!-- Header kolom Jenis Kelamin dengan fitur sorting -->
                                <th>
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'jenis_kelamin', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}"
                                        class="text-primary hover:underline flex items-center gap-1">
                                        Jenis Kelamin
                                        <i class="fas fa-sort {{ request('sort') == 'jenis_kelamin' ? (request('direction') == 'asc' ? 'fa-sort-up' : 'fa-sort-down') : '' }}"></i>
                                    </a>
                                </th>
                                <!-- Header kolom Aksi -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop data murid, tampilkan tiap baris data -->
                            @forelse($murids as $murid)
                                <tr class="transition-all duration-300 hover:bg-gray-50">
                                    <td>{{ $murid->nama }}</td>
                                    <td>{{ $murid->nis }}</td>
                                    <td>{{ $murid->kelas }}</td>
                                    <!-- Tampilkan mata pelajaran guru (dari variabel controller) -->
                                    <td>{{ $mata_pelajaran }}</td>
                                    <!-- Tampilkan jenis kelamin murid dalam format teks -->
                                    <td>{{ $murid->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>
                                        <!-- Tombol untuk melihat nilai murid terkait -->
                                        <a href="{{ route('guru.nilai.index', $murid->nis) }}"
                                            class="btn btn-primary btn-sm hover:bg-blue-600 transition-all duration-300">
                                            <i class="fas fa-eye me-1"></i> Lihat Nilai
                                        </a>
                                    </td>
                                </tr>
                            <!-- Jika data murid kosong -->
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Data murid tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <!-- Import Animate.css untuk animasi halaman -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <!-- Import DataTables CSS untuk styling tabel -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
        <!-- CSS kustom untuk memperbaiki tampilan paginasi dan panah DataTables -->
        <style>
            .dataTables_paginate .pagination {
                margin: 0;
            }
            .dataTables_paginate .pagination .page-link {
                padding: 0.5rem 0.75rem;
                font-size: 0.9rem; /* Ukuran font untuk panah normal */
            }
            .dataTables_paginate .pagination .page-item {
                margin-right: 0.2rem;
            }
            .dataTables_wrapper .dataTables_paginate {
                padding-top: 0.75rem;
                display: flex; /* Gunakan flexbox untuk mengatur posisi */
                justify-content: flex-end; /* Pindahkan ke ujung kanan */
            }
        </style>
    @endpush

    @push('scripts')
        <!-- Import jQuery untuk DataTables -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Import DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

        <script>
            $(document).ready(function() {
                // Inisialisasi DataTables untuk tabel murid dengan pengaturan paginasi, sorting, dan bahasa
                $('#dataTableMurid').DataTable({
                    paging: true, // Aktifkan paginasi DataTables
                    searching: false, // Nonaktifkan fitur searching bawaan DataTables
                    ordering: true, // Aktifkan fitur sorting kolom
                    info: true, // Tampilkan info jumlah data
                    autoWidth: false, // Nonaktifkan auto lebar kolom
                    responsive: true, // Tabel responsif di perangkat kecil
                    pageLength: 10, // Jumlah data per halaman
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
