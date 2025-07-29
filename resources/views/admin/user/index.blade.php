@extends('layouts.admin')

@section('title', 'Manajemen User')
@section('breadcrumb', 'User')
@section('page-title', 'Halaman User')

@section('content')
    <!-- Judul halaman utama -->
    <h1 class="h3 mb-2 text-gray-800">Daftar User</h1>
    <p class="mb-4">Berikut adalah daftar pengguna yang terdaftar di sistem.</p>

    <!-- Tombol aksi: Tambah User dan Kembali ke dashboard admin -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Tambah User
        </a>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <!-- Card container untuk tabel data user -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Judul card -->
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
        <div class="card-body">
            <!-- Wrapper responsive tabel -->
            <div class="table-responsive">
                <!-- Tabel Data User dengan Bootstrap dan DataTables -->
                <table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                            <th>Ubah Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop data user, jika kosong tampilkan pesan -->
                        @forelse($users as $user)
                            <tr>
                                <!-- Tampilkan username -->
                                <td>{{ $user->username }}</td>
                                <!-- Tampilkan role user -->
                                <td>{{ $user->role }}</td>
                                <td>
                                    <!-- Tombol edit user -->
                                    <a href="{{ route('admin.user.edit', $user->username) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <!-- Form hapus user dengan konfirmasi -->
                                    <form action="{{ route('admin.user.destroy', $user->username) }}"
                                        method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <!-- Tombol untuk mengarahkan ke halaman ubah password -->
                                    <a href="{{ route('admin.user.edit', $user->username) }}"
                                        class="btn btn-success btn-sm">
                                        <i class="fas fa-key"></i> Ubah Password
                                    </a>
                                </td>
                            </tr>
                        <!-- Jika data user kosong -->
                        @empty
                            <tr><td colspan="4" class="text-center">Data tidak ditemukan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Memasukkan library DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        // Inisialisasi DataTables saat dokumen siap
        $(document).ready(function () {
            $('#dataTableUser').DataTable({
                paging: true,           // Aktifkan pagination
                searching: true,        // Aktifkan fitur pencarian
                ordering: true,         // Aktifkan sorting kolom
                info: true,             // Tampilkan info jumlah data
                autoWidth: false,       // Nonaktifkan auto lebar kolom
                responsive: true,       // Buat tabel responsif
                language: {             // Konfigurasi bahasa DataTables ke Bahasa Indonesia
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    },
                    emptyTable: "Tidak ada data tersedia"
                }
            });
        });
    </script>
@endpush
