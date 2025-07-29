<?php

namespace App\Services;

use App\Models\Murid;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MuridService
{
    // Mengambil daftar murid dengan filter pencarian, filter kelas, dan jenis kelamin
    public function getFilteredMurid(Request $request, $isGuruSearch = false)
    {
        $query = Murid::query();

        // Jika ada input pencarian, cari berdasarkan nama atau nis murid
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nis', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan kelas jika ada input kelas
        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        // Filter berdasarkan jenis kelamin jika ada input jenis_kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Ambil parameter sorting dan arah sorting, default sort berdasarkan nama ascending
        $sort = $request->get('sort', 'nama');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        // Kembalikan hasil query sebagai collection (get all)
        return $query->get();
    }

    // Mengambil daftar kelas unik dari data murid
    public function getKelasList()
    {
        // Ambil kolom kelas dan buat list kelas unik (distinct)
        return Murid::select('kelas')->distinct()->pluck('kelas')->toArray();
    }

    // Mengembalikan list jenis kelamin dalam format array key => value
    public function getJenisKelaminList()
    {
        return ['L' => 'Laki-laki', 'P' => 'Perempuan'];
    }

    // Membuat data murid baru sekaligus membuat akun user untuk login murid
    public function createMurid(Request $request)
    {
        // Membuat akun user dengan username = nis dan password yang sudah di-hash (nis juga sebagai password default)
        $user = User::create([
            'username' => $request->nis,
            'password' => Hash::make($request->nis),
            'role' => 'murid',
        ]);

        // Membuat data murid dengan mengisi data dari request dan menghubungkan username_user dengan nis
        $murid = Murid::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
            'tgl_lahir' => $request->tgl_lahir,
            'username_user' => $request->nis,
        ]);

        // Catat aktivitas pembuatan murid pada tabel activity_log
        ActivityLog::create([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::id(),
            'action' => 'create',
            'table_name' => 'murid',
            'description' => 'Menambahkan murid: ' . $murid->nama . ' (NIS: ' . $murid->nis . ')',
            'created_at' => now(),
        ]);

        // Catat aktivitas pembuatan akun user pada tabel activity_log
        ActivityLog::create([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::id(),
            'action' => 'create',
            'table_name' => 'users',
            'description' => 'Menambahkan akun pengguna untuk murid: ' . $murid->nama . ' (Username: ' . $user->username . ')',
            'created_at' => now(),
        ]);

        // Kembalikan data murid yang baru dibuat
        return $murid;
    }

    // Memperbarui data murid dan akun user terkait berdasarkan nis lama
    public function updateMurid(Request $request, $nis)
    {
        // Cari murid berdasarkan nis lama, jika tidak ada akan error
        $murid = Murid::where('nis', $nis)->firstOrFail();
        $oldNis = $murid->nis;

        // Jika nis berubah, maka update username user juga
        if ($oldNis !== $request->nis) {
            $user = User::where('username', $oldNis)->first();
            if ($user) {
                $user->update(['username' => $request->nis]);

                // Catat aktivitas update username user
                ActivityLog::create([
                    'user_type' => Auth::user()->role,
                    'user_id' => Auth::id(),
                    'action' => 'update',
                    'table_name' => 'users',
                    'description' => 'Memperbarui username pengguna untuk murid: ' . $murid->nama . ' dari ' . $oldNis . ' ke ' . $request->nis,
                    'created_at' => now(),
                ]);
            }
        }

        // Update data murid dengan data baru dari request
        $murid->update([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
            'tgl_lahir' => $request->tgl_lahir,
            'username_user' => $request->nis,
        ]);

        // Catat aktivitas update murid
        ActivityLog::create([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::id(),
            'action' => 'update',
            'table_name' => 'murid',
            'description' => 'Memperbarui murid: ' . $murid->nama . ' (NIS: ' . $murid->nis . ')',
            'created_at' => now(),
        ]);

        // Kembalikan data murid yang sudah diperbarui
        return $murid;
    }

    // Menghapus data murid dan akun user terkait berdasarkan nis
    public function deleteMurid($nis)
    {
        // Cari data murid berdasarkan nis, gagal jika tidak ditemukan
        $murid = Murid::where('nis', $nis)->firstOrFail();
        $nama = $murid->nama;

        // Hapus akun user terkait berdasarkan username yang sama dengan nis murid
        $user = User::where('username', $nis)->first();
        if ($user) {
            $user->delete();

            // Catat aktivitas penghapusan akun user
            ActivityLog::create([
                'user_type' => Auth::user()->role,
                'user_id' => Auth::id(),
                'action' => 'delete',
                'table_name' => 'users',
                'description' => 'Menghapus akun pengguna untuk murid: ' . $nama . ' (Username: ' . $nis . ')',
                'created_at' => now(),
            ]);
        }

        // Hapus data murid
        $murid->delete();

        // Catat aktivitas penghapusan murid
        ActivityLog::create([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::id(),
            'action' => 'delete',
            'table_name' => 'murid',
            'description' => 'Menghapus murid: ' . $nama . ' (NIS: ' . $nis . ')',
            'created_at' => now(),
        ]);
    }
}
