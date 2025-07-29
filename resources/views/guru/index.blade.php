@extends('layouts.admin')

@section('title', 'Manajemen Guru')
@section('breadcrumb', 'Guru')
@section('page-title', 'Halaman Guru')

@push('styles')
<!-- Load CSS DataTables dengan styling Bootstrap 4 -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <!-- Judul halaman dan deskripsi singkat -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Guru</h1>
    <p class="mb-4">Berikut adalah daftar guru yang terdaftar di sistem.</p>

    <!-- Baris tombol Tambah Guru dan Export Data -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <!-- Tombol untuk menuju halaman tambah data guru -->
            <a href="{{ route('admin.guru.create') }}" class="btn btn-primary mr-2">
                <i class="fas fa-plus mr-2"></i> Tambah Guru
            </a>
            <!-- Form export data guru dengan pilihan format file -->
            <form method="POST" action="{{ route('admin.guru.export') }}" class="d-inline-flex align-items-center">
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

        <!-- Tombol kembali ke halaman dashboard admin -->
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <!-- Card berisi tabel data guru dengan shadow dan margin bawah -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Header card dengan teks bold dan warna utama -->
            <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- Tabel bootstrap untuk menampilkan daftar guru -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th>No Telp</th>
                            <th>Tanggal Lahir</th>
                            <th>Mata Pelajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop menampilkan data guru, jika kosong tampilkan pesan -->
                        @forelse($gurus as $g)
                            <tr>
                                <td>{{ $g->nip }}</td>
                                <td>{{ $g->nama }}</td>
                                <td>{{ $g->email }}</td>
                                <td>{{ $g->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $g->no_telp }}</td>
                                <td>{{ $g->tgl_lahir }}</td>
                                <td>{{ $g->mapel->mata_pelajaran ?? 'N/A' }}</td>
                                <td>
                                    <!-- Tombol edit guru -->
                                    <a href="{{ route('admin.guru.edit', $g->nip) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <!-- Form hapus guru dengan metode DELETE dan konfirmasi -->
                                    <form method="POST" action="{{ route('admin.guru.destroy', $g->nip) }}"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <!-- Pesan jika tidak ada data guru -->
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data guru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<!-- Load JS DataTables dan integrasi dengan Bootstrap 4 -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        // Inisialisasi DataTables dengan opsi untuk paging, searching, ordering, info, dll
        $('#dataTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            // Bahasa UI DataTables dalam Bahasa Indonesia
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                paginate: {
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                },
                emptyTable: "Tidak ada data tersedia"
            }
        });
    });
</script>
@endpush
