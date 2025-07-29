@extends('layouts.admin')

@section('title', 'FAQ') 
<!-- Mengatur judul halaman browser -->

@section('breadcrumb', 'FAQ') 
<!-- Mengatur breadcrumb navigasi halaman -->

@section('page-title', 'Halaman FAQ') 
<!-- Mengatur judul utama halaman -->

@section('content')
    <!-- Kontainer utama dengan margin dan padding responsif -->
    <div class="container mx-auto px-4 py-8">
        <!-- Judul halaman FAQ -->
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">Frequently Asked Questions (FAQ)</h1>

        <!-- Card berisi konten FAQ -->
        <div class="card-stat p-6">
            <!-- Subjudul untuk bagian FAQ -->
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Pertanyaan Umum</h2>

            <!-- Accordion sebagai container FAQ yang dapat dilipat -->
            <div class="accordion" id="faqAccordion">

                <!-- Bagian FAQ khusus untuk Admin -->
                <div class="mb-4">
                    <!-- Judul kategori FAQ Admin -->
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Untuk Admin</h3>
                    
                    <!-- Item FAQ pertama untuk Admin -->
                    <div class="border rounded mb-2">
                        <button class="w-full text-left px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white font-medium flex justify-between items-center" 
                            type="button" data-toggle="collapse" data-target="#faqAdmin1" aria-expanded="true" aria-controls="faqAdmin1">
                            Apa yang bisa saya lakukan di dashboard admin?
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <!-- Konten jawaban FAQ pertama, default terbuka -->
                        <div id="faqAdmin1" class="collapse show" data-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                Di dashboard admin, Anda dapat melihat statistik seperti jumlah total user, guru, murid, dan mata pelajaran. Anda juga bisa melihat grafik rata-rata nilai per mata pelajaran, distribusi nilai, dan aktivitas terakhir pengguna.
                            </div>
                        </div>
                    </div>

                    <!-- Item FAQ kedua untuk Admin -->
                    <div class="border rounded mb-2">
                        <button class="w-full text-left px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white font-medium flex justify-between items-center" 
                            type="button" data-toggle="collapse" data-target="#faqAdmin2" aria-expanded="false" aria-controls="faqAdmin2">
                            Bagaimana cara menambahkan guru atau murid baru?
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <!-- Konten jawaban FAQ kedua, default tertutup -->
                        <div id="faqAdmin2" class="collapse" data-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                Untuk menambahkan guru, buka menu "Guru", lalu klik tombol "Tambah Guru". Isi data seperti nama, NIP, email, dan mata pelajaran yang diajar. Untuk murid, buka menu "Murid", klik "Tambah Murid", dan isi data seperti nama, NIS, dan kelas.
                            </div>
                        </div>
                    </div>

                    <!-- Item FAQ ketiga untuk Admin -->
                    <div class="border rounded mb-2">
                        <button class="w-full text-left px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white font-medium flex justify-between items-center" 
                            type="button" data-toggle="collapse" data-target="#faqAdmin3" aria-expanded="false" aria-controls="faqAdmin3">
                            Apa itu Activity Log dan bagaimana cara melihatnya?
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <!-- Konten jawaban FAQ ketiga, default tertutup -->
                        <div id="faqAdmin3" class="collapse" data-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                Activity Log mencatat aktivitas pengguna seperti login, logout, atau ekspor data. Anda dapat melihatnya di menu "Activity Log", di mana Anda bisa memfilter berdasarkan tipe pengguna atau aksi tertentu.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bagian FAQ khusus untuk Guru -->
                <div class="mb-4">
                    <!-- Judul kategori FAQ Guru -->
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Untuk Guru</h3>
                    
                    <!-- Item FAQ pertama untuk Guru -->
                    <div class="border rounded mb-2">
                        <button class="w-full text-left px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white font-medium flex justify-between items-center" 
                            type="button" data-toggle="collapse" data-target="#faqGuru1" aria-expanded="false" aria-controls="faqGuru1">
                            Bagaimana cara saya menginput nilai untuk murid?
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <!-- Konten jawaban FAQ pertama Guru -->
                        <div id="faqGuru1" class="collapse" data-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                Buka menu "Nilai", lalu klik "Tambah Nilai". Pilih murid, mata pelajaran yang Anda ajar, semester, dan masukkan nilai serta predikat (A/B/C/D). Setelah disimpan, nilai akan tercatat dan dapat dilihat oleh murid.
                            </div>
                        </div>
                    </div>

                    <!-- Item FAQ kedua untuk Guru -->
                    <div class="border rounded mb-2">
                        <button class="w-full text-left px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white font-medium flex justify-between items-center" 
                            type="button" data-toggle="collapse" data-target="#faqGuru2" aria-expanded="false" aria-controls="faqGuru2">
                            Bisakah saya mencari murid tertentu yang saya ajar?
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <!-- Konten jawaban FAQ kedua Guru -->
                        <div id="faqGuru2" class="collapse" data-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                Ya, Anda dapat mencari murid di menu "Murid". Gunakan filter seperti nama, kelas, atau jenis kelamin untuk menemukan murid yang Anda ajar berdasarkan mata pelajaran Anda.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bagian FAQ khusus untuk Murid -->
                <div class="mb-4">
                    <!-- Judul kategori FAQ Murid -->
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Untuk Murid</h3>
                    
                    <!-- Item FAQ pertama untuk Murid -->
                    <div class="border rounded mb-2">
                        <button class="w-full text-left px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white font-medium flex justify-between items-center" 
                            type="button" data-toggle="collapse" data-target="#faqMurid1" aria-expanded="false" aria-controls="faqMurid1">
                            Bagaimana cara saya melihat nilai saya?
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <!-- Konten jawaban FAQ pertama Murid -->
                        <div id="faqMurid1" class="collapse" data-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                Anda dapat melihat nilai Anda di menu "Nilai". Anda bisa memfilter nilai berdasarkan semester atau mata pelajaran tertentu. Nilai akan menampilkan mata pelajaran, nilai, predikat, dan semester.
                            </div>
                        </div>
                    </div>

                    <!-- Item FAQ kedua untuk Murid -->
                    <div class="border rounded mb-2">
                        <button class="w-full text-left px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white font-medium flex justify-between items-center" 
                            type="button" data-toggle="collapse" data-target="#faqMurid2" aria-expanded="false" aria-controls="faqMurid2">
                            Bisakah saya mengunduh data nilai saya?
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <!-- Konten jawaban FAQ kedua Murid -->
                        <div id="faqMurid2" class="collapse" data-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                Ya, Anda dapat mengekspor data nilai Anda ke format Excel atau PDF. Di menu "Nilai", klik tombol "Export" dan pilih format yang diinginkan.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bagian FAQ Umum -->
                <div class="mb-4">
                    <!-- Judul kategori FAQ Umum -->
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Umum</h3>
                    
                    <!-- Item FAQ pertama Umum -->
                    <div class="border rounded mb-2">
                        <button class="w-full text-left px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white font-medium flex justify-between items-center" 
                            type="button" data-toggle="collapse" data-target="#faqUmum1" aria-expanded="false" aria-controls="faqUmum1">
                            Bagaimana cara mengganti kata sandi saya?
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <!-- Konten jawaban FAQ pertama Umum -->
                        <div id="faqUmum1" class="collapse" data-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                Buka menu "Profil", lalu masukkan kata sandi lama dan kata sandi baru Anda. Pastikan kata sandi baru minimal 6 karakter dan konfirmasi dengan benar. Setelah berhasil, Anda mungkin perlu login ulang.
                            </div>
                        </div>
                    </div>

                    <!-- Item FAQ kedua Umum -->
                    <div class="border rounded mb-2">
                        <button class="w-full text-left px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white font-medium flex justify-between items-center" 
                            type="button" data-toggle="collapse" data-target="#faqUmum2" aria-expanded="false" aria-controls="faqUmum2">
                            Apakah data saya aman di sistem ini?
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <!-- Konten jawaban FAQ kedua Umum -->
                        <div id="faqUmum2" class="collapse" data-parent="#faqAccordion">
                            <div class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                Ya, sistem kami menggunakan enkripsi dan protokol keamanan untuk melindungi data Anda. Hanya pengguna yang berwenang yang dapat mengakses data sesuai hak aksesnya.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
