@extends('layouts.guru')

@section('title', 'FAQ Guru')
@section('page-title', 'Frequently Asked Questions for Guru')

@section('content')
    <div class="container mx-auto px-4 py-8 animate__animated animate__fadeIn">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Frequently Asked Questions (FAQ) - Guru</h1>
        <div class="card-custom p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Pertanyaan Umum untuk Guru</h2>

            <!-- Accordion untuk FAQ -->
            <div class="accordion" id="faqAccordion">
                <!-- FAQ Khusus untuk Guru -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Pengelolaan Nilai</h3>
                    <div class="border rounded mb-2 shadow-sm transition-all duration-300 hover:shadow-md">
                        <button class="w-full text-left px-4 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-medium flex justify-between items-center" type="button" data-bs-toggle="collapse" data-bs-target="#faqGuru1" aria-expanded="false" aria-controls="faqGuru1">
                            Bagaimana cara saya menginput nilai untuk murid?
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>
                        <div id="faqGuru1" class="collapse" data-bs-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 bg-white">
                                Buka menu "Nilai", lalu klik "Tambah Nilai". Pilih murid, mata pelajaran yang Anda ajar, semester, dan masukkan nilai serta predikat (A/B/C/D). Setelah disimpan, nilai akan tercatat dan dapat dilihat oleh murid.
                            </div>
                        </div>
                    </div>

                    <div class="border rounded mb-2 shadow-sm transition-all duration-300 hover:shadow-md">
                        <button class="w-full text-left px-4 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-medium flex justify-between items-center" type="button" data-bs-toggle="collapse" data-bs-target="#faqGuru2" aria-expanded="false" aria-controls="faqGuru2">
                            Bagaimana cara mengedit atau menghapus nilai yang sudah diinput?
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>
                        <div id="faqGuru2" class="collapse" data-bs-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 bg-white">
                                Di menu "Nilai", cari nilai yang ingin Anda edit atau hapus. Klik tombol "Edit" untuk mengubah nilai atau "Hapus" untuk menghapus data nilai tersebut. Pastikan Anda hanya mengedit nilai untuk mata pelajaran yang Anda ajar.
                            </div>
                        </div>
                    </div>

                    <div class="border rounded mb-2 shadow-sm transition-all duration-300 hover:shadow-md">
                        <button class="w-full text-left px-4 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-medium flex justify-between items-center" type="button" data-bs-toggle="collapse" data-bs-target="#faqGuru3" aria-expanded="false" aria-controls="faqGuru3">
                            Bisakah saya mengekspor data nilai murid ke Excel atau PDF?
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>
                        <div id="faqGuru3" class="collapse" data-bs-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 bg-white">
                                Ya, Anda dapat mengekspor data nilai ke format Excel atau PDF. Di menu "Nilai", klik tombol "Export" dan pilih format yang diinginkan (Excel atau PDF). File akan otomatis terunduh.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ untuk Pencarian Murid -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Pencarian Murid</h3>
                    <div class="border rounded mb-2 shadow-sm transition-all duration-300 hover:shadow-md">
                        <button class="w-full text-left px-4 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-medium flex justify-between items-center" type="button" data-bs-toggle="collapse" data-bs-target="#faqGuru4" aria-expanded="false" aria-controls="faqGuru4">
                            Bagaimana cara mencari murid tertentu yang saya ajar?
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>
                        <div id="faqGuru4" class="collapse" data-bs-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 bg-white">
                                Anda dapat mencari murid di menu "Murid". Gunakan fitur pencarian dengan memasukkan nama, kelas, atau jenis kelamin untuk menemukan murid yang Anda ajar berdasarkan mata pelajaran Anda.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Umum untuk Guru -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Umum</h3>
                    <div class="border rounded mb-2 shadow-sm transition-all duration-300 hover:shadow-md">
                        <button class="w-full text-left px-4 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-medium flex justify-between items-center" type="button" data-bs-toggle="collapse" data-bs-target="#faqUmum1" aria-expanded="false" aria-controls="faqUmum1">
                            Bagaimana cara mengganti kata sandi saya?
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>
                        <div id="faqUmum1" class="collapse" data-bs-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 bg-white">
                                Buka menu "Profil", lalu masukkan kata sandi lama dan kata sandi baru Anda. Pastikan kata sandi baru minimal 6 karakter dan konfirmasi dengan benar. Setelah berhasil, Anda mungkin perlu login ulang.
                            </div>
                        </div>
                    </div>

                    <div class="border rounded mb-2 shadow-sm transition-all duration-300 hover:shadow-md">
                        <button class="w-full text-left px-4 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-medium flex justify-between items-center" type="button" data-bs-toggle="collapse" data-bs-target="#faqUmum2" aria-expanded="false" aria-controls="faqUmum2">
                            Apa yang harus saya lakukan jika lupa kata sandi?
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>
                        <div id="faqUmum2" class="collapse" data-bs-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 bg-white">
                                Jika Anda lupa kata sandi, hubungi admin sekolah Anda. Admin dapat mereset kata sandi Anda melalui menu "User" dengan memilih opsi "Edit Password".
                            </div>
                        </div>
                    </div>

                    <div class="border rounded mb-2 shadow-sm transition-all duration-300 hover:shadow-md">
                        <button class="w-full text-left px-4 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-medium flex justify-between items-center" type="button" data-bs-toggle="collapse" data-bs-target="#faqUmum3" aria-expanded="false" aria-controls="faqUmum3">
                            Bagaimana cara melihat mata pelajaran yang saya ajar?
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>
                        <div id="faqUmum3" class="collapse" data-bs-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 bg-white">
                                Mata pelajaran yang Anda ajar dapat dilihat di menu "Profil". Anda juga akan melihatnya saat menginput nilai, karena hanya mata pelajaran yang Anda ajar yang akan muncul di daftar.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        .accordion .collapse.show + .collapse .fa-chevron-down {
            transform: rotate(180deg);
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // Rotate chevron icon on accordion toggle
        document.querySelectorAll('.accordion button').forEach(button => {
            button.addEventListener('click', function () {
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-chevron-down');
                icon.classList.toggle('fa-chevron-up');
            });
        });
    </script>
    @endpush
@endsection