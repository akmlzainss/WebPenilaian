@extends('layouts.admin')

{{-- Judul halaman --}}
@section('title', 'Manajemen Nilai')

{{-- Breadcrumb untuk navigasi --}}
@section('breadcrumb', 'Nilai')

{{-- Judul utama halaman --}}
@section('page-title', 'Halaman Nilai')

@section('content')
    <!-- Heading halaman -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Nilai</h1>
    <p class="mb-4">Berikut adalah daftar nilai yang terdaftar di sistem.</p>

    <!-- Filter pencarian dan semester -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Data Nilai</h6>
        </div>
        <div class="card-body">
            <!-- Form filter data nilai -->
            <form method="GET" action="{{ route('admin.nilai.index') }}" class="form-inline">
                <!-- Input pencarian berdasarkan mata pelajaran -->
                <div class="form-group mb-2 mr-3">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari mata pelajaran" class="form-control">
                </div>

                <!-- Dropdown untuk filter berdasarkan semester -->
                <div class="form-group mb-2 mr-3">
                    <select name="semester" class="form-control">
                        <option value="">Pilih Semester</option>
                        @foreach ($semester_list as $key => $value)
                            <option value="{{ $key }}" {{ request('semester') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol pencarian -->
                <button type="submit" class="btn btn-primary mb-2">
                    <i class="fas fa-search"></i> Cari
                </button>
            </form>
        </div>
    </div>

    <!-- Tombol aksi tambah dan export -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <!-- Tombol tambah nilai -->
            <a href="{{ route('admin.nilai.create') }}" class="btn btn-primary mr-2">
                <i class="fas fa-plus mr-2"></i> Tambah Nilai
            </a>

            <!-- Form export data nilai ke Excel, PDF, atau Word -->
            <form method="POST" action="{{ route('admin.nilai.export') }}" class="d-inline-flex align-items-center">
                @csrf
                <select name="format" class="form-control mr-2" style="width: auto;">
                    <option value="excel">Excel</option>
                    <option value="pdf">PDF</option>
                    <option value="word">Word</option>
                </select>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-download mr-2"></i> Export
                </button>
            </form>
        </div>

        <!-- Tombol kembali ke dashboard -->
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <!-- Tabel daftar nilai -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Nilai</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- Tabel nilai dengan ID untuk DataTables -->
                <table class="table table-bordered" id="dataTableNilai" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama Murid</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>Nilai</th>
                            <th>Predikat</th>
                            <th>Semester</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Iterasi setiap data nilai -->
                        @forelse($nilai as $n)
                            <tr>
                                <td>{{ $n->nis }}</td>
                                <td>{{ $n->murid->nama ?? '-' }}</td>
                                <td>{{ $n->mapel->mata_pelajaran ?? '-' }}</td>
                                <td>{{ $n->guru->nama ?? '-' }}</td>
                                <td>{{ $n->nilai }}</td>
                                <td>{{ $n->predikat }}</td>
                                <td>{{ $n->semester }}</td>
                                <td>
                                    <!-- Tombol edit nilai -->
                                    <a href="{{ route('admin.nilai.edit', [$n->nis, $n->kode]) }}"
                                        class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Form hapus nilai -->
                                    <form method="POST" action="{{ route('admin.nilai.destroy', [$n->nis, $n->kode]) }}"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <!-- Pesan jika tidak ada data nilai -->
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data nilai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Push custom script untuk DataTables --}}
    @push('scripts')
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- DataTables + Bootstrap 4 CSS & JS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

        <!-- Inisialisasi DataTables dengan pengaturan bahasa Indonesia -->
        <script>
            $(document).ready(function () {
                $('#dataTableNilai').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                    responsive: true,
                    language: {
                        "paginate": {
                            "previous": "Sebelumnya",
                            "next": "Berikutnya"
                        },
                        "search": "Cari:",
                        "lengthMenu": "Tampilkan _MENU_ data per halaman",
                        "zeroRecords": "Tidak ditemukan data",
                        "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        "infoEmpty": "Tidak ada data tersedia",
                        "infoFiltered": "(difilter dari total _MAX_ data)"
                    }
                });
            });
        </script>
    @endpush
@endsection
