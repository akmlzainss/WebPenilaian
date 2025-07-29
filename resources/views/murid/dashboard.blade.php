@extends('layouts.murid')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Murid')

@push('styles')
<!-- Memasukkan stylesheet Animate.css untuk animasi -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<style>
    /* Styling khusus untuk kartu dashboard dengan animasi slideInUp */
    .card-custom {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.15);
        animation: slideInUp 0.6s ease var(--delay) both;
        position: relative;
        overflow: hidden;
    }

    /* Efek radial gradient di belakang kartu saat hover */
    .card-custom::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(78, 115, 223, 0.1) 0%, transparent 70%);
        transform: scale(0);
        transition: transform 0.6s ease;
        z-index: 0;
    }

    /* Saat hover, efek gradient muncul */
    .card-custom:hover::before {
        transform: scale(1);
    }

    /* Efek hover pada kartu: naik dan sedikit membesar serta shadow lebih dalam */
    .card-custom:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 0.5rem 2rem 0 rgba(33, 40, 50, 0.2);
        z-index: 1;
    }

    /* Styling header kartu dengan gradien dan teks putih */
    .card-header-custom {
        background: linear-gradient(135deg, var(--primary-color) 0%, #224abe 100%);
        color: white;
        border: none;
        padding: 1.25rem;
        font-weight: 600;
    }

    /* Padding dalam body kartu */
    .card-body-custom {
        padding: 1.5rem;
        position: relative;
        z-index: 2;
    }

    /* Styling tabel dengan border-radius dan spacing */
    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    /* Padding dan border bawah untuk cell tabel */
    .table th, .table td {
        padding: 1rem;
        border-bottom: 1px solid #e3e6f0;
    }

    /* Styling header tabel */
    .table th {
        background-color: var(--light-color);
        color: var(--dark-color);
        font-weight: 600;
    }

    /* Efek hover baris tabel */
    .table tbody tr:hover {
        background-color: rgba(78, 115, 223, 0.05);
        transition: background-color 0.3s ease;
    }

    /* Styling untuk section ucapan selamat datang */
    .welcome-section {
        text-align: center;
        padding: 2rem;
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.15);
        animation: slideInUp 0.6s ease 0.4s both;
    }

    /* Styling paragraf di welcome section dengan icon bintang sebelum dan sesudah */
    .welcome-section p {
        color: var(--secondary-color);
        font-size: 1.1rem;
        line-height: 1.6;
        max-width: 600px;
        margin: 0 auto;
    }

    .welcome-section p::before,
    .welcome-section p::after {
        content: '\f005';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        color: #ffd700;
        margin: 0 0.5rem;
    }

    /* Responsif untuk layar kecil, mengurangi padding dan margin */
    @media (max-width: 768px) {
        .table-responsive {
            margin-bottom: 1.5rem;
        }

        .table th, .table td {
            padding: 0.75rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Baris utama dashboard dengan animasi fadeIn -->
<div class="row g-4 mb-5 animate__animated animate__fadeIn">
    <div class="col-12">
        <!-- Kartu khusus berisi daftar mata pelajaran dan guru -->
        <div class="card-custom">
            <!-- Header kartu dengan icon dashboard -->
            <div class="card-header-custom">
                <h5 class="mb-0"><i class="fas fa-tachometer-alt me-2"></i> Dashboard Murid</h5>
            </div>
            <div class="card-body-custom">
                <!-- Tabel responsif menampilkan mata pelajaran dan guru -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Guru</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop data nilai untuk ditampilkan -->
                            @forelse ($nilai as $item)
                                <tr>
                                    <td>{{ $item->mapel->mata_pelajaran ?? 'N/A' }}</td>
                                    <td>{{ $item->guru->nama ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <!-- Jika tidak ada data, tampilkan pesan kosong -->
                                <tr>
                                    <td colspan="2" class="text-center text-muted">Tidak ada data mata pelajaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection