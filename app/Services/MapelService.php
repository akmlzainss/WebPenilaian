<?php

namespace App\Services;

use App\Models\Mapel;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapelService
{
    // Mengambil daftar mata pelajaran dengan filter pencarian dan paginasi
    public function getFilteredMapel(Request $request)
    {
        $query = Mapel::query();

        // Jika parameter 'search' ada, cari berdasarkan nama mata pelajaran atau kode
        if ($request->filled('search')) {
            $query->where('mata_pelajaran', 'like', '%' . $request->search . '%')
                  ->orWhere('kode', 'like', '%' . $request->search . '%');
        }

        // Mendapatkan parameter sort dan arah sort, defaultnya berdasarkan 'mata_pelajaran' ascending
        $sort = $request->get('sort', 'mata_pelajaran');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        // Kembalikan hasil dalam bentuk paginasi 10 data per halaman
        return $query->paginate(10);
    }

    // Membuat data mata pelajaran baru dan mencatat aktivitasnya
    public function createMapel(Request $request)
    {
        // Buat record mapel baru berdasarkan input request
        $mapel = Mapel::create($request->all());

        // Catat aktivitas penambahan mata pelajaran di tabel activity_log
        ActivityLog::create([
            'user_type' => Auth::user()->role,
            'username' => Auth::user()->username, // Catat username user yang melakukan aksi
            'action' => 'create',
            'table_name' => 'mapel',
            'description' => 'Menambahkan mata pelajaran: ' . $mapel->mata_pelajaran . ' (Kode: ' . $mapel->kode . ')',
        ]);

        // Kembalikan data mapel yang baru dibuat
        return $mapel;
    }

    // Memperbarui data mata pelajaran berdasarkan kode dan mencatat aktivitasnya
    public function updateMapel(Request $request, $kode)
    {
        // Cari data mapel berdasarkan kode, jika tidak ditemukan maka gagal
        $mapel = Mapel::where('kode', $kode)->firstOrFail();

        // Update data mapel dengan data baru dari request
        $mapel->update($request->all());

        // Catat aktivitas update mata pelajaran di activity_log
        ActivityLog::create([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'update',
            'table_name' => 'mapel',
            'description' => 'Memperbarui mata pelajaran: ' . $mapel->mata_pelajaran . ' (Kode: ' . $mapel->kode . ')',
        ]);

        // Kembalikan data mapel yang sudah diperbarui
        return $mapel;
    }

    // Menghapus data mata pelajaran berdasarkan kode dan mencatat aktivitas penghapusan
    public function deleteMapel($kode)
    {
        // Cari data mapel yang akan dihapus berdasarkan kode, gagal jika tidak ada
        $mapel = Mapel::where('kode', $kode)->firstOrFail();

        // Hapus data mapel tersebut
        $mapel->delete();

        // Catat aktivitas penghapusan mata pelajaran di activity_log
        ActivityLog::create([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'delete',
            'table_name' => 'mapel',
            'description' => 'Menghapus mata pelajaran: ' . $mapel->mata_pelajaran . ' (Kode: ' . $kode . ')',
        ]);
    }
}
