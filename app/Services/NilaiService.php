<?php

namespace App\Services;

use App\Models\Nilai;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiService
{
    // Property untuk menyimpan instance ActivityLogService
    protected $activityLogService;

    // Konstruktor untuk inject dependency ActivityLogService
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    // Mengembalikan daftar semester yang tersedia dalam bentuk array key => label
    public function getSemesterList()
    {
        return ['1' => 'Semester 1', '2' => 'Semester 2'];
    }

    // Membuat data nilai baru berdasarkan data yang diterima dari request
    public function createNilai(Request $request)
    {
        // Membuat record nilai baru menggunakan data yang diterima (nis, kode mapel, nip guru, nilai, predikat, semester)
        $nilai = Nilai::create($request->only(['nis', 'kode', 'nip', 'nilai', 'predikat', 'semester']));

        // Mencatat aktivitas penambahan nilai ke dalam log aktivitas
        $this->activityLogService->logActivity([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'create',
            'table_name' => 'nilai',
            'description' => 'Menambahkan nilai untuk NIS: ' . $nilai->nis . ', Kode Mapel: ' . $nilai->kode . ', Guru NIP: ' . $nilai->nip,
        ]);

        // Mengembalikan objek nilai yang baru dibuat
        return $nilai;
    }

    // Memperbarui data nilai berdasarkan nis dan kode mapel
    public function updateNilai(Request $request, $nis, $kode)
    {
        // Cari data nilai yang sesuai nis dan kode mapel, gagal jika tidak ditemukan
        $nilai = Nilai::where('nis', $nis)->where('kode', $kode)->firstOrFail();

        // Update data nilai, predikat, dan semester dengan data dari request
        $nilai->update($request->only(['nilai', 'predikat', 'semester']));

        // Catat aktivitas update nilai ke dalam log aktivitas
        $this->activityLogService->logActivity([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'update',
            'table_name' => 'nilai',
            'description' => 'Memperbarui nilai untuk NIS: ' . $nilai->nis . ', Kode Mapel: ' . $nilai->kode . ', Guru NIP: ' . $nilai->nip,
        ]);

        // Kembalikan objek nilai yang sudah diperbarui
        return $nilai;
    }

    // Menghapus data nilai berdasarkan nis dan kode mapel
    public function deleteNilai($nis, $kode)
    {
        // Cari data nilai berdasarkan nis dan kode mapel, gagal jika tidak ditemukan
        $nilai = Nilai::where('nis', $nis)->where('kode', $kode)->firstOrFail();
        $nip = $nilai->nip;

        // Hapus data nilai dari database
        $nilai->delete();

        // Catat aktivitas penghapusan nilai pada log aktivitas
        $this->activityLogService->logActivity([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'delete',
            'table_name' => 'nilai',
            'description' => 'Menghapus nilai untuk NIS: ' . $nis . ', Kode Mapel: ' . $kode . ', Guru NIP: ' . $nip,
        ]);
    }
}
