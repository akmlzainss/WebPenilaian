<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guru;
use App\Models\Murid;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Controller untuk mengelola fungsi utama admin, seperti dashboard dan pengaturan
 */
class AdminController extends Controller
{
    /**
     * Mengarahkan pengguna ke halaman berdasarkan peran (role) mereka
     *
     * @return \Illuminate\Http\RedirectResponse Mengarahkan ke halaman sesuai peran
     */
    public function redirectBasedOnRole()
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data pengguna yang sedang login
        $user = Auth::user();
        $role = $user->role ?? null;

        // Validasi peran pengguna
        if (!$role) {
            return redirect()->route('login')->with('error', 'Peran pengguna tidak ditemukan.');
        }

        // Arahkan ke halaman sesuai peran
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.index');
            case 'guru':
                return redirect()->route('guru.dashboard');
            case 'murid':
                return redirect()->route('murid.dashboard');
            default:
                return redirect()->route('login')->with('error', 'Peran tidak valid.');
        }
    }

    /**
     * Menampilkan dashboard admin dengan statistik dan grafik
     *
     * @return \Illuminate\View\View Mengembalikan view dashboard admin dengan data statistik
     */
    public function admin()
    {
        // Statistik jumlah data
        $totalUser = User::count();
        $totalGuru = Guru::count();
        $totalMurid = Murid::count();
        $totalMapel = Mapel::count();

        // Data untuk Line Chart: Nilai rata-rata per mata pelajaran
        $mapels = Mapel::with('nilai')->get();
        $mapelLabels = $mapels->pluck('mata_pelajaran')->toArray();
        $averageScores = $mapels->map(function ($mapel) {
            return $mapel->nilai->avg('nilai') ?? 0;
        })->toArray();

        // Data untuk Doughnut Chart: Distribusi nilai berdasarkan rentang
        $scoreDistributionRaw = Nilai::selectRaw('
            SUM(CASE WHEN nilai BETWEEN 90 AND 100 THEN 1 ELSE 0 END) as range_90_100,
            SUM(CASE WHEN nilai BETWEEN 80 AND 89 THEN 1 ELSE 0 END) as range_80_89,
            SUM(CASE WHEN nilai BETWEEN 70 AND 79 THEN 1 ELSE 0 END) as range_70_79,
            SUM(CASE WHEN nilai BETWEEN 60 AND 69 THEN 1 ELSE 0 END) as range_60_69,
            SUM(CASE WHEN nilai < 60 THEN 1 ELSE 0 END) as range_below_60
        ')->first()->toArray();

        // Konversi data distribusi nilai ke array numerik
        $scoreDistribution = array_values($scoreDistributionRaw);

        // Ambil aktivitas terakhir (dibatasi 50 data untuk efisiensi)
        $recentActivities = ActivityLog::orderBy('created_at', 'desc')->limit(50)->get();

        // Kembalikan view dashboard dengan data yang telah disiapkan
        return view('admin.index', compact(
            'totalUser',
            'totalGuru',
            'totalMurid',
            'totalMapel',
            'mapelLabels',
            'averageScores',
            'scoreDistribution',
            'recentActivities'
        ));
    }

    /**
     * Menampilkan halaman "About Us" untuk admin
     *
     * @return \Illuminate\View\View Mengembalikan view halaman About Us
     */
    public function about()
    {
        return view('admin.about');
    }

    /**
     * Menampilkan halaman FAQ untuk admin
     *
     * @return \Illuminate\View\View Mengembalikan view halaman FAQ
     */
    public function faq()
    {
        return view('admin.faq');
    }

    /**
     * Menampilkan halaman pengaturan untuk admin
     *
     * @return \Illuminate\View\View Mengembalikan view halaman pengaturan
     */
    public function settings()
    {
        return view('admin.settings');
    }

    /**
     * Menampilkan halaman profil admin
     *
     * @return \Illuminate\View\View Mengembalikan view halaman profil dengan data pengguna
     */
    public function profile()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }
}