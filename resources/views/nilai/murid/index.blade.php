@extends('layouts.murid') <!-- Menggunakan layout khusus untuk murid -->

@section('title', 'Nilai Saya') <!-- Judul halaman di tab browser -->
@section('page-title', 'Nilai Saya') <!-- Judul besar halaman -->
@section('page-subtitle', 'Lihat dan kelola nilai akademik Anda') <!-- Subjudul halaman -->

@push('styles') <!-- Menambahkan style khusus untuk halaman ini -->
<style>
    .card-custom {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.15);
        animation: fadeInScale 0.8s ease;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 1rem;
        border-bottom: 1px solid #e3e6f0;
    }

    .table th {
        background-color: var(--light-color);
        color: var(--dark-color);
        font-weight: 600;
    }

    .table tbody tr:hover {
        background-color: rgba(78, 115, 223, 0.05);
        transition: background-color 0.3s ease;
    }

    .form-control, .form-select {
        border-radius: 0.5rem;
        border: 1px solid #e3e6f0;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .btn-primary-custom {
        background: var(--primary-color);
        color: white;
        border-radius: 0.5rem;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary-custom:hover {
        background: #2e59d9;
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(78, 115, 223, 0.3);
    }

    .sort-link {
        color: var(--dark-color);
        text-decoration: none;
        position: relative;
    }

    .sort-link:hover {
        text-decoration: underline;
    }

    .sort-link span {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        margin-left: 0.25rem;
    }

    .dataTables_wrapper .dataTables_paginate .pagination {
        margin: 0;
    }

    .dataTables_wrapper .dataTables_paginate .page-link {
        border-radius: 0.5rem;
        margin: 0 0.25rem;
        color: var(--primary-color);
    }

    .dataTables_wrapper .dataTables_paginate .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }
</style>
@endpush

@section('content') <!-- Konten utama halaman -->
<div class="row g-4 animate__animated animate__fadeIn"> <!-- Animasi fade in -->
    <div class="col-12">
        <div class="card-custom"> <!-- Kartu utama -->
            <div class="card-header-custom">
                <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i> Daftar Nilai</h5> <!-- Judul kartu -->
            </div>
            <div class="card-body-custom">
                <!-- Bagian header dan export -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold text-gray-800">Nilai Akademik</h6>
                    <!-- Form export nilai ke PDF/Excel/Word -->
                    <form action="{{ route('murid.nilai.export') }}" method="GET">
                        <select name="format" class="form-select" onchange="this.form.submit()">
                            <option value="excel" {{ request()->input('format') == 'excel' ? 'selected' : '' }}>Excel</option>
                            <option value="pdf" {{ request()->input('format') == 'pdf' ? 'selected' : '' }}>PDF</option>
                            <option value="word" {{ request()->input('format') == 'word' ? 'selected' : '' }}>Word</option>
                        </select>
                    </form>
                </div>

                <!-- Form filter dan pencarian -->
                <form method="GET" class="mb-4 d-flex gap-4 flex-wrap">
                    <input type="text" name="search" placeholder="Cari Mata Pelajaran" value="{{ request()->input('search') }}" class="form-control flex-1">
                    <select name="semester" class="form-select">
                        <option value="">Semua Semester</option>
                        @foreach ($semester_list as $key => $value)
                            <option value="{{ $key }}" {{ request()->input('semester') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary-custom">Filter</button>
                </form>

                <!-- Tabel nilai dengan DataTables -->
                <div class="table-responsive">
                    <table class="table" id="nilaiTable">
                        <thead>
                            <tr>
                                <th>
                                    <a href="{{ route('murid.nilai.index', array_merge(request()->query(), ['sort' => 'mapel.mata_pelajaran', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}"
                                       class="sort-link">
                                        Mata Pelajaran
                                        @if (request('sort') === 'mapel.mata_pelajaran')
                                            <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('murid.nilai.index', array_merge(request()->query(), ['sort' => 'guru.nama', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}"
                                       class="sort-link">
                                        Guru
                                        @if (request('sort') === 'guru.nama')
                                            <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('murid.nilai.index', array_merge(request()->query(), ['sort' => 'nilai', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}"
                                       class="sort-link">
                                        Nilai
                                        @if (request('sort') === 'nilai')
                                            <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('murid.nilai.index', array_merge(request()->query(), ['sort' => 'predikat', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}"
                                       class="sort-link">
                                        Predikat
                                        @if (request('sort') === 'predikat')
                                            <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('murid.nilai.index', array_merge(request()->query(), ['sort' => 'semester', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}"
                                       class="sort-link">
                                        Semester
                                        @if (request('sort') === 'semester')
                                            <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                                        @endif
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilai as $item)
                                <tr>
                                    <td>{{ $item->mapel->mata_pelajaran }}</td>
                                    <td>{{ $item->guru->nama }}</td>
                                    <td>{{ $item->nilai }}</td>
                                    <td>{{ $item->predikat }}</td>
                                    <td>{{ $item->semester }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts') <!-- Menambahkan script DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#nilaiTable').DataTable({
            paging: true,
            pageLength: 10,
            lengthChange: false,
            searching: false,
            ordering: true,
            info: true,
            processing: true,
            serverSide: false,
            order: [[0, 'asc']],
            columns: [
                { data: 'mapel.mata_pelajaran', name: 'mapel.mata_pelajaran' },
                { data: 'guru.nama', name: 'guru.nama' },
                { data: 'nilai', name: 'nilai' },
                { data: 'predikat', name: 'predikat' },
                { data: 'semester', name: 'semester' }
            ],
            language: {
                paginate: {
                    previous: '<i class="fas fa-angle-left"></i>',
                    next: '<i class="fas fa-angle-right"></i>'
                }
            }
        });
    });
</script>
@endpush