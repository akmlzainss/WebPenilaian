@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <!-- Judul halaman -->
        <h1 class="mb-4">Activity Log</h1>

        <!-- Menampilkan pesan sukses jika ada -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form filter untuk memfilter data activity log -->
        <form method="GET" action="{{ route('admin.activity_logs.index') }}" class="mb-4">
            <div class="row">
                <!-- Filter berdasarkan tipe user -->
                <div class="col-md-3">
                    <select name="user_type" class="form-control">
                        <option value="">Semua User Type</option>
                        @foreach ($user_types as $type)
                            <option value="{{ $type }}" {{ request('user_type') == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter berdasarkan jenis aksi -->
                <div class="col-md-3">
                    <select name="action" class="form-control">
                        <option value="">Semua Aksi</option>
                        @foreach ($actions as $action)
                            <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                                {{ $action }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter berdasarkan tanggal mulai -->
                <div class="col-md-2">
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>

                <!-- Filter berdasarkan tanggal akhir -->
                <div class="col-md-2">
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>

                <!-- Tombol submit filter -->
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <!-- Tabel yang menampilkan data activity log -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User Type</th>
                    <th>Nama Pengguna</th>
                    <th>User ID</th> <!-- Kolom user ID -->
                    <th>Aksi</th>
                    <th>Tabel</th>
                    <th>Deskripsi</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                <!-- Looping data aktivitas -->
                @forelse ($activities as $activity)
                    <tr>
                        <td>{{ $activity->user_type ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $activity->user_name ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $activity->user_id ?? 'Tidak Diketahui' }}</td> <!-- User ID -->
                        <td>{{ $activity->action ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $activity->table_name ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $activity->description ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $activity->created_at ?? 'Tidak Diketahui' }}</td>
                    </tr>
                @empty
                    <!-- Jika tidak ada data aktivitas -->
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada aktivitas yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination untuk navigasi halaman data -->
        {{ $activities->appends(request()->query())->links() }}
    </div>
@endsection
