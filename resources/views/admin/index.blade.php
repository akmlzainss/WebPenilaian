@extends('layouts.admin')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row: Statistik -->
    <div class="row">
        @php
            $stats = [
                ['label' => 'Total User', 'value' => $totalUser, 'icon' => 'fas fa-users', 'border' => 'primary'],
                [
                    'label' => 'Total Guru',
                    'value' => $totalGuru,
                    'icon' => 'fas fa-chalkboard-teacher',
                    'border' => 'success',
                ],
                [
                    'label' => 'Total Murid',
                    'value' => $totalMurid,
                    'icon' => 'fas fa-user-graduate',
                    'border' => 'info',
                ],
                ['label' => 'Total Mapel', 'value' => $totalMapel, 'icon' => 'fas fa-book', 'border' => 'warning'],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-{{ $stat['border'] }} shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-{{ $stat['border'] }} text-uppercase mb-1">
                                    {{ $stat['label'] }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stat['value'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="{{ $stat['icon'] }} fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Content Row: Grafik -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Nilai Rata-rata per Mata Pelajaran</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="height: 300px;">
                        <canvas id="averageScoreChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doughnut Chart -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Komposisi Nilai Murid</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2" style="height: 300px;">
                        <canvas id="scoreDistributionChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2"><i class="fas fa-circle text-primary"></i> 90-100</span>
                        <span class="mr-2"><i class="fas fa-circle text-success"></i> 80-89</span>
                        <span class="mr-2"><i class="fas fa-circle text-info"></i> 70-79</span>
                        <span class="mr-2"><i class="fas fa-circle text-warning"></i> 60-69</span>
                        <span class="mr-2"><i class="fas fa-circle text-danger"></i> 60</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row: Aktivitas dan Quick Actions -->
    <div class="row">
        <!-- Aktivitas Terakhir -->
        <div class="col-lg-9 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terakhir</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableActivities" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Role</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentActivities as $activity)
                                    <tr>
                                        <td>{{ $activity->user_type ?? '-' }}</td>
                                        <td>{{ $activity->user_id ?? '-' }}</td>
                                        <td>{{ $activity->username ?? '-' }}</td>
                                        <td>{{ $activity->action ?? '-' }}</td>
                                        <td style="max-width: 400px; white-space: normal;">
                                            {{ Str::limit($activity->description ?? '-', 120, '...') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada aktivitas terakhir.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body px-3 py-2">
                    @php
                        $actions = [
                            [
                                'label' => 'Guru',
                                'desc' => 'Kelola data guru',
                                'icon' => 'fas fa-chalkboard-teacher',
                                'route' => route('admin.guru.index'),
                            ],
                            [
                                'label' => 'Murid',
                                'desc' => 'Kelola data murid',
                                'icon' => 'fas fa-user-graduate',
                                'route' => route('admin.murid.index'),
                            ],
                            [
                                'label' => 'About US',
                                'desc' => 'Tentang Kami',
                                'icon' => 'fas fa-book',
                                'route' => route('admin.about'),
                            ],
                            [
                                'label' => 'FAQ',
                                'desc' => 'Jawab Pertanyaan anda',
                                'icon' => 'fas fa-chart-line',
                                'route' => route('admin.faq'),
                            ],
                        ];
                    @endphp
                    <ul class="list-group list-group-flush">
                        @foreach ($actions as $action)
                            <li class="list-group-item d-flex align-items-center justify-content-between py-2 px-2">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 30px; height: 30px; font-size: 0.8rem;">
                                        <i class="{{ $action['icon'] }}"></i>
                                    </div>
                                    <div>
                                        <a href="{{ $action['route'] }}"
                                            class="fw-semibold text-dark text-decoration-none">
                                            {{ $action['label'] }}
                                        </a>
                                        <div class="text-muted small">{{ $action['desc'] }}</div>
                                    </div>
                                </div>
                                <i class="fas fa-chevron-right text-muted small"></i>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <!-- CSS untuk memperbaiki ukuran panah dan posisi paginasi -->
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
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataTableActivities').DataTable({
                paging: true,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
                pageLength: 5,
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

        // Line Chart (Area Chart)
        const averageScoreCtx = document.getElementById('averageScoreChart');
        if (averageScoreCtx) {
            new Chart(averageScoreCtx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: @json($mapelLabels),
                    datasets: [{
                        label: 'Nilai Rata-rata',
                        data: @json($averageScores),
                        borderColor: '#4e73df',
                        backgroundColor: 'rgba(78, 115, 223, 0.2)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                stepSize: 20,
                                callback: function(value) {
                                    return value + '%';
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        }

        // Doughnut Chart
        const scoreDistributionCtx = document.getElementById('scoreDistributionChart');
        if (scoreDistributionCtx) {
            const data = @json($scoreDistribution);
            console.log('Doughnut Chart Data:', data); // Debugging
            new Chart(scoreDistributionCtx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['90-100', '80-89', '70-79', '60-69', '60'],
                    datasets: [{
                        data: data,
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e',
                            '#e74a3b'
                        ],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutout: '50%',
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        } else {
            console.log('Canvas untuk scoreDistributionChart tidak ditemukan.');
        }
    </script>
@endpush