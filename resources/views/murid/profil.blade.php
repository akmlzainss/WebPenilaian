@extends('layouts.murid')

@section('title', 'Profil')
@section('page-title', 'Profil Murid')
@section('page-subtitle', 'Kelola informasi pribadi Anda')

@push('styles')
<style>
    /* Custom card styling for a clean white background with shadow and rounded corners */
    .card-custom {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.15);
        animation: fadeInScale 0.8s ease;
    }

    /* Table styling with full width and separate border spacing */
    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    /* Padding and border for table headers and cells */
    .table th, .table td {
        padding: 1rem;
        border-bottom: 1px solid #e3e6f0;
    }

    /* Table header styling: background color, font weight, and color */
    .table th {
        background-color: var(--light-color);
        color: var(--dark-color);
        font-weight: 600;
    }

    /* Form control styling with rounded borders and smooth transitions */
    .form-control {
        border-radius: 0.5rem;
        border: 1px solid #e3e6f0;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }

    /* Focus effect for form controls to highlight with primary color */
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    /* Custom primary button styling with color, padding, and hover effects */
    .btn-primary-custom {
        background: var(--primary-color);
        color: white;
        border-radius: 0.5rem;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
    }

    /* Hover effect for primary button: darker background, slight lift, and shadow */
    .btn-primary-custom:hover {
        background: #2e59d9;
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(78, 115, 223, 0.3);
    }
</style>
@endpush

@section('content')
<div class="row g-4 animate__animated animate__fadeIn">
    <!-- Section: Display Personal Information -->
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header-custom">
                <h5 class="mb-0"><i class="fas fa-user me-2"></i> Informasi Pribadi</h5>
            </div>
            <div class="card-body-custom">
                <table class="table">
                    <!-- Display the student's name -->
                    <tr><th>Nama</th><td>{{ $murid->nama }}</td></tr>
                    <!-- Display the student's NIS (student ID number) -->
                    <tr><th>NIS</th><td>{{ $murid->nis }}</td></tr>
                    <!-- Display the student's class -->
                    <tr><th>Kelas</th><td>{{ $murid->kelas }}</td></tr>
                    <!-- Display the student's phone number or fallback text if empty -->
                    <tr><th>No. Telepon</th><td>{{ $murid->no_telp ?? 'Belum diisi' }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Section: Form to Edit Profile Information -->
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header-custom">
                <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i> Edit Profil</h5>
            </div>
            <div class="card-body-custom">
                <!-- Form to update phone number and password -->
                <form action="{{ route('murid.update.profil') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Input for phone number -->
                    <div class="mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="no_telp" class="form-control" value="{{ $murid->no_telp ?? '' }}" required>
                    </div>
                    <!-- Input for current password to verify identity -->
                    <div class="mb-3">
                        <label class="form-label">Kata Sandi Lama</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <!-- Input for new password -->
                    <div class="mb-3">
                        <label class="form-label">Kata Sandi Baru</label>
                        <input type="password" name="new_password" class="form-control" required minlength="6">
                    </div>
                    <!-- Confirmation input for new password -->
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="new_password_confirmation" class="form-control" required minlength="6">
                    </div>
                    <!-- Submit button to save changes -->
                    <button type="submit" class="btn btn-primary-custom">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
