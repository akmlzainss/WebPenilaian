<?php

namespace App\Services;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuruService
{
    /**
     * Mendapatkan daftar guru dengan filter pencarian, mata pelajaran, dan jenis kelamin,
     * serta pengurutan dan paginasi.
     *
     * @param Request $request Request HTTP yang berisi parameter filter dan sort.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator Hasil paginasi guru.
     */
    public function getFilteredGuru(Request $request)
    {
        $query = Guru::query();

        // Filter berdasarkan pencarian nama atau NIP
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nip', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kode mata pelajaran
        if ($request->filled('mapel')) {
            $query->where('kode', $request->mapel);
        }

        // Filter berdasarkan jenis kelamin
        if ($request->filled('jk')) {
            $query->where('jenis_kelamin', $request->jk);
        }

        // Sorting berdasarkan kolom dan arah (default: nama ascending)
        $sort = $request->get('sort', 'nama');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        // Mengembalikan hasil dalam bentuk paginasi 10 per halaman
        return $query->paginate(10);
    }

    /**
     * Mendapatkan daftar mata pelajaran dalam bentuk key-value untuk dropdown atau filter.
     *
     * @return \Illuminate\Support\Collection Daftar mapel (kode => mata_pelajaran).
     */
    public function getMapelList()
    {
        return Mapel::pluck('mata_pelajaran', 'kode');
    }

    /**
     * Mendapatkan daftar jenis kelamin yang tersedia.
     *
     * @return array Array berisi kode jenis kelamin dan labelnya.
     */
    public function getJenisKelaminList()
    {
        return ['L' => 'Laki-laki', 'P' => 'Perempuan'];
    }

    /**
     * Membuat data guru baru sekaligus akun user terkait,
     * serta mencatat aktivitas pembuatan pada log.
     *
     * @param Request $request Data input untuk membuat guru dan user.
     * @return Guru Data guru yang baru dibuat.
     */
    public function createGuru(Request $request)
    {
        // Buat akun user dengan username dan password sesuai NIP guru
        $user = User::create([
            'username' => $request->nip,
            'password' => Hash::make($request->nip),
            'role' => 'guru',
        ]);

        // Buat data guru dengan username_user sama dengan NIP
        $guru = Guru::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
            'tgl_lahir' => $request->tgl_lahir,
            'kode' => $request->kode,
            'username_user' => $request->nip,
        ]);

        // Catat aktivitas pembuatan data guru pada log
        ActivityLog::create([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'create',
            'table_name' => 'guru',
            'description' => 'Menambahkan guru: ' . $guru->nama . ' (NIP: ' . $guru->nip . ')',
            'created_at' => now(),
        ]);

        // Catat aktivitas pembuatan akun user guru pada log
        ActivityLog::create([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'create',
            'table_name' => 'users',
            'description' => 'Menambahkan akun pengguna untuk guru: ' . $guru->nama . ' (Username: ' . $user->username . ')',
            'created_at' => now(),
        ]);

        return $guru;
    }

    /**
     * Memperbarui data guru dan akun pengguna jika NIP berubah,
     * serta mencatat aktivitas update pada log.
     *
     * @param Request $request Data input untuk update guru.
     * @param string $nip NIP guru lama yang akan diperbarui.
     * @return Guru Data guru yang sudah diperbarui.
     */
    public function updateGuru(Request $request, $nip)
    {
        $guru = Guru::where('nip', $nip)->firstOrFail();
        $oldNip = $guru->nip;

        // Perbarui akun pengguna jika NIP berubah
        if ($oldNip !== $request->nip) {
            $user = User::where('username', $oldNip)->first();
            if ($user) {
                $user->update(['username' => $request->nip]);
                // Catat aktivitas update username akun user guru
                ActivityLog::create([
                    'user_type' => Auth::user()->role,
                    'user_id' => Auth::user()->username,
                    'action' => 'update',
                    'table_name' => 'users',
                    'description' => 'Memperbarui username pengguna untuk guru: ' . $guru->nama . ' dari ' . $oldNip . ' ke ' . $request->nip,
                    'created_at' => now(),
                ]);
            }
        }

        // Perbarui data guru
        $guru->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
            'tgl_lahir' => $request->tgl_lahir,
            'kode' => $request->kode,
            'username_user' => $request->nip,
        ]);

        // Catat aktivitas update data guru pada log
        ActivityLog::create([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'update',
            'table_name' => 'guru',
            'description' => 'Memperbarui guru: ' . $guru->nama . ' (NIP: ' . $guru->nip . ')',
            'created_at' => now(),
        ]);

        return $guru;
    }

    /**
     * Menghapus data guru beserta akun pengguna terkait,
     * serta mencatat aktivitas penghapusan pada log.
     *
     * @param string $nip NIP guru yang akan dihapus.
     * @return void
     */
    public function deleteGuru($nip)
    {
        $guru = Guru::where('nip', $nip)->firstOrFail();
        $nama = $guru->nama; // Simpan nama guru untuk log aktivitas
        $username = $guru->username_user;

        // Hapus akun pengguna terkait guru
        $user = User::where('username', $username)->first();
        if ($user) {
            $user->delete();

            // Catat aktivitas penghapusan akun pengguna guru
            ActivityLog::create([
                'user_type' => Auth::user()->role,
                'user_id' => Auth::user()->username,
                'action' => 'delete',
                'table_name' => 'users',
                'description' => 'Menghapus akun pengguna untuk guru: ' . $nama . ' (Username: ' . $username . ')',
                'created_at' => now(),
            ]);
        }

        // Hapus data guru
        $guru->delete();

        // Catat aktivitas penghapusan data guru
        ActivityLog::create([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'delete',
            'table_name' => 'guru',
            'description' => 'Menghapus guru: ' . $nama . ' (NIP: ' . $nip . ')',
            'created_at' => now(),
        ]);
    }
}
