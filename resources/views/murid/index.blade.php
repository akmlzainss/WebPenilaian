@extends('layouts.admin')

@section('title', 'Manajemen Murid') <!-- Judul halaman yang akan ditampilkan di tab browser -->
@section('breadcrumb', 'Murid') <!-- Breadcrumb untuk navigasi halaman -->
@section('page-title', 'Halaman Murid') <!-- Judul utama halaman -->

@push('styles')
<!-- Mengimpor stylesheet DataTables untuk styling tabel -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <!-- Heading halaman dan deskripsi singkat -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Murid</h1>
    <p class="mb-4">Berikut adalah daftar murid yang terdaftar di sistem.</p>

    <!-- Bagian form untuk pencarian dan filter data murid -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Data Murid</h6>
        </div>
        <div class="card-body">
            <!-- Form GET untuk pencarian dan filter -->
            <form method="GET" action="{{ route('admin.murid.index') }}" class="form-inline">
                <!-- Input pencarian berdasarkan nama atau NIS -->
                <div class="form-group mb-2 mr-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NIS"
                        class="form-control">
                </div>
                <!-- Dropdown filter berdasarkan kelas -->
                <div class="form-group mb-2 mr-3">
                    <select name="kelas" class="form-control">
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelas_list as $kelas)
                            <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>
                                {{ $kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Dropdown filter berdasarkan jenis kelamin -->
                <div class="form-group mb-2 mr-3">
                    <select name="jenis_kelamin" class="form-control">
                        <option value="">Pilih Jenis Kelamin</option>
                        @foreach ($jenis_kelamin_list as $key => $value)
                            <option value="{{ $key }}" {{ request('jenis_kelamin') == $key ? 'selected' : '' }}>
                                {{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Tombol submit untuk melakukan pencarian dan filter -->
                <button type="submit" class="btn btn-primary mb-2">
                    <i class="fas fa-search"></i> Cari
                </button>
            </form>
        </div>
    </div>

    <!-- Bagian tombol untuk tambah murid baru dan export data -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <!-- Tombol tambah murid yang mengarah ke halaman create -->
            <a href="{{ route('admin.murid.create') }}" class="btn btn-primary mr-2">
                <i class="fas fa-plus mr-2"></i> Tambah Murid
            </a>
            <!-- Form export data murid dengan pilihan format file -->
            <form method="POST" action="{{ route('admin.murid.export') }}" class="d-inline-flex align-items-center">
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

        <!-- Tombol kembali ke dashboard admin -->
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <!-- Bagian tabel yang menampilkan data murid -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Murid</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- Tabel data murid dengan ID dataTable untuk inisialisasi DataTables -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>No Telp</th>
                            <th>Tanggal Lahir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Looping data murid, jika kosong tampilkan pesan -->
                        @forelse($murids as $m)
                            <tr>
                                <td>{{ $m->nis }}</td>
                                <td>{{ $m->nama }}</td>
                                <td>{{ $m->kelas }}</td>
                                <!-- Menampilkan jenis kelamin dalam format teks -->
                                <td>{{ $m->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $m->no_telp }}</td>
                                <td>{{ $m->tgl_lahir }}</td>
                                <td>
                                    <!-- Tombol edit data murid -->
                                    <a href="{{ route('admin.murid.edit', $m->nis) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <!-- Form hapus data murid dengan konfirmasi -->
                                    <form method="POST" action="{{ route('admin.murid.destroy', $m->nis) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <!-- Pesan jika tidak ada data murid -->
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data murid.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<!-- Memuat jQuery sebagai dependency untuk DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Memuat stylesheet DataTables Bootstrap 4 (duplikasi bisa dihapus) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<!-- Memuat skrip DataTables dan integrasi dengan Bootstrap 4 -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
        // Inisialisasi DataTable pada tabel dengan ID 'dataTable'
        $('#dataTable').DataTable({
            paging: true,       // Mengaktifkan paginasi
            searching: true,    // Mengaktifkan fitur pencarian
            ordering: true,     // Mengaktifkan pengurutan kolom
            info: true,         // Menampilkan info jumlah data
            autoWidth: false,   // Mematikan auto lebar kolom
            responsive: true,   // Mengaktifkan responsif untuk tabel
            language: {         // Konfigurasi bahasa Indonesia untuk DataTables
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
