@extends('layouts.guru')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Guru')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js" />
<style>
    .stat-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 2rem;
        text-align: center;
        transition: transform 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .stat-icon {
        font-size: 2.5rem;
    }
    .stat-number {
        font-size: 2rem;
        font-weight: bold;
    }
    .stat-label {
        font-size: 1rem;
        font-weight: 500;
        color: #666;
    }
    .card-custom {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    .card-header-custom {
        background-color: #f8f9fc;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e3e6f0;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }
    .card-body-custom {
        padding: 1.5rem;
    }
    .btn-primary-custom {
        background-color: #4e73df;
        color: #fff;
        border: none;
        padding: 0.75rem 1rem;
        font-weight: 500;
        border-radius: 12px;
        transition: background-color 0.3s ease;
    }
    .btn-primary-custom:hover {
        background-color: #2e59d9;
    }
    .timeline-marker {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: 0.75rem;
    }
    #scoreChart {
        max-height: 400px;
    }
    .section-container {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
    .description-text {
        margin-top: 1.5rem;
        color: #666;
        font-size: 0.95rem;
        text-align: center;
    }
</style>
@endpush

@section('content')
<!-- Aksi Cepat (Statistics Cards) -->
<div class="row g-4 mb-5 animate__animated animate__fadeIn">
    <div class="col-md-4">
        <div class="stat-card">
            <i class="fas fa-user-graduate stat-icon text-primary"></i>
            <div class="stat-number text-primary">{{ $jumlahMurid ?? '0' }}</div>
            <div class="stat-label">Total Murid</div>
            <div class="mt-2">
                <small class="text-muted"><i class="fas fa-info-circle me-1"></i> Murid yang terdaftar</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <i class="fas fa-clipboard-check stat-icon text-success"></i>
            <div class="stat-number text-success">{{ $jumlahNilai ?? '0' }}</div>
            <div class="stat-label">Nilai Diinput</div>
            <div class="mt-2">
                <small class="text-muted"><i class="fas fa-info-circle me-1"></i> Total penilaian</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <i class="fas fa-chart-line stat-icon text-info"></i>
            <div class="stat-number text-info">{{ number_format(($jumlahNilai ?? 0) / max(($jumlahMurid ?? 1), 1), 1) }}</div>
            <div class="stat-label">Rata-rata Nilai/Murid</div>
            <div class="mt-2">
                <small class="text-muted"><i class="fas fa-info-circle me-1"></i> Produktivitas penilaian</small>
            </div>
        </div>
    </div>
</div>

<!-- Score Distribution Chart and Recent Activities -->
<div class="row g-4 mb-5 animate__animated animate__fadeIn section-container">
    <div class="col-lg-8">
        <div class="card-custom h-100">
            <div class="card-header-custom">
                <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i> Distribusi Nilai Murid</h5>
            </div>
            <div class="card-body-custom">
                <canvas id="scoreChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-custom h-100">
            <div class="card-header-custom">
                <h5 class="mb-0"><i class="fas fa-clock me-2"></i> Aktivitas Terakhir</h5>
            </div>
            <div class="card-body-custom">
                <div class="timeline">
                    @forelse($recentActivities as $activity)
                        <div class="timeline-item mb-3 transition-all duration-300 hover:bg-gray-50 rounded-lg p-2">
                            <div class="d-flex align-items-center">
                                <div class="timeline-marker bg-{{ $activity->status_color }}"></div>
                                <div class="ms-3">
                                    <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                                    <div class="fw-bold text-gray-800">{{ $activity->description }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted">Tidak ada aktivitas terakhir.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="description-text">
            Grafik ini menunjukkan distribusi nilai murid berdasarkan rentang nilai, dengan aktivitas terakhir guru di sampingnya. Gunakan informasi ini untuk memantau perkembangan akademik dan aktivitas terkini.
        </div>
    </div>
</div>

<!-- Recent Data -->
<div class="row g-4 animate__animated animate__fadeIn">
    <div class="col-lg-6">
        <div class="card-custom h-100">
            <div class="card-header-custom">
                <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i> Murid Terbaru</h5>
            </div>
            <div class="card-body-custom">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr class="text-muted">
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentStudents as $student)
                                <tr class="transition-all duration-300 hover:bg-gray-50">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($student->nama) }}&background=4e73df&color=ffffff" 
                                                 class="rounded-circle me-2 shadow-sm" width="32" height="32" alt="Student">
                                            <span class="fw-bold text-gray-800">{{ $student->nama }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $student->kelas }}</td>
                                    <td><span class="badge bg-{{ $student->status_color }} px-3 py-1 rounded-full">{{ $student->status }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Tidak ada murid terbaru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('guru.murid.search') }}" class="btn btn-outline-primary btn-sm hover:bg-primary hover:text-white transition-all duration-300">
                        Lihat Semua Murid
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-custom h-100">
            <div class="card-header-custom">
                <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i> Nilai Terbaru</h5>
            </div>
            <div class="card-body-custom">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr class="text-muted">
                                <th>Murid</th>
                                <th>Mata Pelajaran</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentScores as $score)
                                <tr class="transition-all duration-300 hover:bg-gray-50">
                                    <td>
                                        <span class="fw-bold text-gray-800">{{ $score->murid->nama }}</span>
                                        <br><small class="text-muted">{{ $score->murid->kelas }}</small>
                                    </td>
                                    <td>{{ $score->mapel->mata_pelajaran }}</td>
                                    <td>
                                        <span class="badge bg-{{ $score->grade_color }} px-3 py-1 rounded-full fs-6">{{ $score->nilai }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Tidak ada nilai terbaru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('guru.nilai.index') }}" class="btn btn-outline-primary btn-sm hover:bg-primary hover:text-white transition-all duration-300">
                        Lihat Semua Nilai
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('scoreChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar', // Changed from 'pie' to 'bar'
            data: {
                labels: <?php echo json_encode($chartLabels); ?>,
                datasets: [{
                    label: 'Jumlah Murid',
                    data: <?php echo json_encode($chartData); ?>,
                    backgroundColor: [
                        'rgba(78, 115, 223, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: [
                        'rgba(78, 115, 223, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Murid'
                        },
                        ticks: {
                            stepSize: 1 // Ensures whole numbers for student counts
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Rentang Nilai'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top' // Position legend at the top for bar charts
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' murid';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
