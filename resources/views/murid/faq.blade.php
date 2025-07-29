@extends('layouts.murid')

@section('title', 'FAQ Murid')  <!-- Set judul halaman browser -->
@section('page-title', 'Frequently Asked Questions for Murid') <!-- Set judul halaman konten -->

@section('content')
    <div class="container mx-auto px-4 py-8 animate__animated animate__fadeIn">
        <!-- Judul utama FAQ -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Frequently Asked Questions (FAQ) - Murid</h1>

        <div class="card-custom p-6">
            <!-- Subjudul untuk bagian FAQ khusus murid -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Pertanyaan Umum untuk Murid</h2>

            <!-- Container Accordion FAQ -->
            <div class="accordion" id="faqAccordion">

                <!-- Section FAQ Khusus Murid: Melihat Nilai -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Melihat Nilai</h3>

                    <!-- Item FAQ pertama: Cara melihat nilai -->
                    <div class="border rounded mb-2 shadow-sm transition-all duration-300 hover:shadow-md">
                        <button class="w-full text-left px-4 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-medium flex justify-between items-center" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#faqMurid1" 
                                aria-expanded="false" 
                                aria-controls="faqMurid1">
                            Bagaimana cara saya melihat nilai saya?
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>

                        <!-- Konten jawaban FAQ pertama -->
                        <div id="faqMurid1" class="collapse" data-bs-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 bg-white">
                                Anda dapat melihat nilai Anda di menu "Nilai". Nilai akan menampilkan mata pelajaran, nilai, predikat, dan semester. Anda juga bisa memfilter berdasarkan semester atau mata pelajaran tertentu.
                            </div>
                        </div>
                    </div>

                    <!-- Item FAQ kedua: Jika nilai belum muncul -->
                    <div class="border rounded mb-2 shadow-sm transition-all duration-300 hover:shadow-md">
                        <button class="w-full text-left px-4 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-medium flex justify-between items-center" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#faqMurid2" 
                                aria-expanded="false" 
                                aria-controls="faqMurid2">
                            Apa yang harus saya lakukan jika nilai saya belum muncul?
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>

                        <!-- Konten jawaban FAQ kedua -->
                        <div id="faqMurid2" class="collapse" data-bs-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 bg-white">
                                Jika nilai Anda belum muncul, hubungi guru mata pelajaran terkait atau admin sekolah. Mungkin guru belum menginput nilai Anda untuk semester tersebut.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section FAQ Khusus Murid: Ekspor Nilai -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Ekspor Nilai</h3>

                    <!-- Item FAQ ketiga: Mengunduh data nilai -->
                    <div class="border rounded mb-2 shadow-sm transition-all duration-300 hover:shadow-md">
                        <button class="w-full text-left px-4 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-medium flex justify-between items-center" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#faqMurid3" 
                                aria-expanded="false" 
                                aria-controls="faqMurid3">
                            Bisakah saya mengunduh data nilai saya?
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>

                        <!-- Konten jawaban FAQ ketiga -->
                        <div id="faqMurid3" class="collapse" data-bs-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 bg-white">
                                Ya, Anda dapat mengekspor data nilai Anda ke format Excel atau PDF. Di menu "Nilai", klik tombol "Export" dan pilih format yang diinginkan. File akan otomatis terunduh.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section FAQ Umum untuk Murid -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Umum</h3>

                    <!-- FAQ mengganti kata sandi -->
                    <div class="border rounded mb-2 shadow-sm transition-all duration-300 hover:shadow-md">
                        <button class="w-full text-left px-4 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-medium flex justify-between items-center" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#faqUmum1" 
                                aria-expanded="false" 
                                aria-controls="faqUmum1">
                            Bagaimana cara mengganti kata sandi saya?
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>

                        <!-- Konten jawaban mengganti kata sandi -->
                        <div id="faqUmum1" class="collapse" data-bs-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 bg-white">
                                Buka menu "Profil", lalu masukkan kata sandi lama dan kata sandi baru Anda. Pastikan kata sandi baru minimal 6 karakter dan konfirmasi dengan benar. Setelah berhasil, Anda perlu login ulang.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ lupa kata sandi -->
                    <div class="border rounded mb-2 shadow-sm transition-all duration-300 hover:shadow-md">
                        <button class="w-full text-left px-4 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-medium flex justify-between items-center" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#faqUmum2" 
                                aria-expanded="false" 
                                aria-controls="faqUmum2">
                            Apa yang harus saya lakukan jika lupa kata sandi?
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>

                        <!-- Konten jawaban lupa kata sandi -->
                        <div id="faqUmum2" class="collapse" data-bs-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 bg-white">
                                Jika Anda lupa kata sandi, hubungi admin sekolah Anda. Admin dapat mereset kata sandi Anda melalui menu "User" dengan memilih opsi "Edit Password".
                            </div>
                        </div>
                    </div>

                    <!-- FAQ melihat informasi profil -->
                    <div class="border rounded mb-2 shadow-sm transition-all duration-300 hover:shadow-md">
                        <button class="w-full text-left px-4 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-medium flex justify-between items-center" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#faqUmum3" 
                                aria-expanded="false" 
                                aria-controls="faqUmum3">
                            Bagaimana cara melihat informasi profil saya?
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>

                        <!-- Konten jawaban melihat profil -->
                        <div id="faqUmum3" class="collapse" data-bs-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 bg-white">
                                Anda dapat melihat informasi profil Anda, seperti nama, NIS, dan nomor telepon, di menu "Profil". Anda juga bisa memperbarui nomor telepon di sana.
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End Accordion -->
        </div> <!-- End Card -->
    </div> <!-- End Container -->

    @push('styles')
    <!-- Import Animate.css untuk efek animasi fadeIn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        /* Rotate icon chevron saat accordion aktif */
        .accordion .collapse.show + .collapse .fa-chevron-down {
            transform: rotate(180deg);
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // Script untuk toggle rotasi icon panah saat tombol accordion diklik
        document.querySelectorAll('.accordion button').forEach(button => {
            button.addEventListener('click', function () {
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-chevron-down'); // toggle icon ke bawah
                icon.classList.toggle('fa-chevron-up');   // toggle icon ke atas
            });
        });
    </script>
    @endpush
@endsection
