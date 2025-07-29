@extends('layouts.admin')

@section('title', 'Manajemen Mata Pelajaran')
@section('breadcrumb', 'Mata Pelajaran')
@section('page-title', 'Halaman Mata Pelajaran')

@section('content')
    <!-- Judul halaman utama -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Mata Pelajaran</h1>
    <!-- Deskripsi singkat halaman -->
    <p class="mb-4">Berikut adalah daftar mata pelajaran yang terdaftar di sistem.</p>

    <!-- Card untuk Form Pencarian dan Pengurutan Mata Pelajaran -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Header card dengan judul form pencarian -->
            <h6 class="m-0 font-weight-bold text-primary">Cari Mata Pelajaran</h6>
        </div>
        <div class="card-body">
            <!-- Form pencarian dengan method GET -->
            <form method="GET" action="{{ route('admin.mapel.index') }}" class="form-inline">
                <div class="form-group mb-2 mr-3">
                    <!-- Input pencarian yang nilainya tetap terisi berdasarkan request sebelumnya -->
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari mata pelajaran atau kode" class="form-control">
                </div>
                <!-- Tombol submit pencarian -->
                <button type="submit" class="btn btn-primary mb-2">
                    <i class="fas fa-search mr-1"></i> Cari
                </button>
            </form>
        </div>
    </div>

    <!-- Baris tombol Tambah, Export, dan Kembali -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <!-- Tombol untuk menuju halaman tambah mata pelajaran -->
            <a href="{{ route('admin.mapel.create') }}" class="btn btn-primary mr-2">
                <i class="fas fa-plus mr-2"></i> Tambah Mata Pelajaran
            </a>
            <!-- Form export data mata pelajaran ke berbagai format -->
            <form method="POST" action="{{ route('admin.mapel.export') }}" class="d-inline-flex align-items-center">
                @csrf
                <!-- Pilihan format export -->
                <select name="format" class="form-control mr-2" style="width: auto;">
                    <option value="excel">Excel</option>
                    <option value="pdf">PDF</option>
                    <option value="word">Word</option>
                </select>
                <!-- Tombol submit export -->
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-download mr-2"></i> Export
                </button>
            </form>
        </div>

        <!-- Tombol untuk kembali ke halaman dashboard admin -->
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <!-- Card container untuk tabel data mata pelajaran -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Header card dengan judul tabel -->
            <h6 class="m-0 font-weight-bold text-primary">Data Mata Pelajaran</h6>
        </div>
        <div class="card-body">
            <!-- Table responsive untuk tampilan data -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Mata Pelajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Looping data mata pelajaran, jika kosong tampilkan pesan -->
                        @forelse($mapels as $m)
                            <tr>
                                <td>{{ $m->kode }}</td>
                                <td>{{ $m->mata_pelajaran }}</td>
                                <td>
                                    <!-- Tombol edit mata pelajaran -->
                                    <a href="{{ route('admin.mapel.edit', $m->kode) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <!-- Form hapus mata pelajaran dengan konfirmasi -->
                                    <form method="POST" action="{{ route('admin.mapel.destroy', $m->kode) }}"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <!-- Pesan jika tidak ada data mata pelajaran -->
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data mata pelajaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script inisialisasi DataTables untuk tabel -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                paging: true,       // Mengaktifkan pagination
                searching: true,    // Mengaktifkan fitur pencarian
                ordering: true,     // Mengaktifkan pengurutan kolom
                info: true,         // Menampilkan info jumlah data
                autoWidth: false,   // Nonaktifkan auto lebar kolom
                responsive: true,   // Responsive untuk tampilan mobile
                language: {         // Kustomisasi bahasa DataTables
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

    <!--
    Script untuk menangani perubahan opsi sort pada select,
    memisahkan nilai menjadi sort dan direction, lalu reload halaman
    dengan parameter query yang sesuai (jika ada fitur sort select dropdown)
    -->
    <script>
        $('select[name="sort"]').on('change', function() {
            const val = $(this).val().split('-');
            const url = new URL(window.location.href);
            url.searchParams.set('sort', val[0]);
            url.searchParams.set('direction', val[1]);
            window.location.href = url.toString();
        });
    </script>
@endsection
