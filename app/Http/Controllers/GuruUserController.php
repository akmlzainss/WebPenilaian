<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use App\Models\Nilai;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuruUserController extends Controller
{
    protected $activityLogService;

    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    // Dashboard utama guru
    public function dashboard()
    {
        if (Auth::user()->role !== 'guru') {
            return redirect()->route('login')->with('error', 'Akses ditolak.');
        }

        $guru = Auth::user()->guru;
        $jumlahMurid = Nilai::where('nip', $guru->nip)->distinct('nis')->count('nis');
        $jumlahNilai = Nilai::where('nip', $guru->nip)->count();

        $recentActivities = $this->activityLogService->getRecentActivities([
            'user_id' => Auth::user()->username,
            'user_type' => 'guru',
            'limit' => 5,
        ]) ?? collect();

        $recentStudents = Murid::whereExists(function ($q) use ($guru) {
            $q->selectRaw(1)
              ->from('nilai')
              ->whereColumn('nilai.nis', 'murid.nis')
              ->where('nilai.nip', $guru->nip)
              ->where('nilai.kode', $guru->kode);
        })
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get()
        ->map(function ($murid) {
            $murid->status = $murid->status ?? 'Aktif';
            $murid->status_color = $murid->status === 'Aktif' ? 'success' : 'danger';
            return $murid;
        }) ?? collect();

        $recentScores = Nilai::where('nip', $guru->nip)
            ->where('kode', $guru->kode)
            ->with(['murid', 'mapel'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($nilai) {
                $nilai->grade_color = $this->getGradeColor($nilai->nilai);
                return $nilai;
            }) ?? collect();

        $scoreRanges = [
            '90+' => [90, 100],
            '80-89' => [80, 89],
            '70-79' => [70, 79],
            '60-69' => [60, 69],
            '50-59' => [50, 59],
            '0-49'  => [0, 49],
        ];

        $chartLabels = array_keys($scoreRanges);
        $chartData = [];
        foreach ($scoreRanges as [$min, $max]) {
            $chartData[] = Nilai::where('nip', $guru->nip)
                ->where('kode', $guru->kode)
                ->whereBetween('nilai', [$min, $max])
                ->distinct('nis')
                ->count('nis');
        }

        return view('guru.dashboard', compact(
            'jumlahMurid', 'jumlahNilai', 'recentActivities',
            'recentStudents', 'recentScores', 'chartLabels', 'chartData'
        ));
    }

    // Menampilkan profil guru
    public function profil()
    {
        return view('guru.profil', [
            'guru' => Auth::user()->guru ?? redirect()->route('home')->with('error', 'Data guru tidak ditemukan.'),
        ]);
    }

    // Update password oleh guru
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Kata sandi lama salah.');
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        $this->activityLogService->logActivity([
            'user_type' => $user->role,
            'user_id' => $user->username,
            'action' => 'update',
            'table_name' => 'users',
            'description' => 'Guru mengubah kata sandi',
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Kata sandi diperbarui. Silakan login kembali.');
    }

    // Warna berdasarkan nilai
    private function getGradeColor($nilai)
    {
        return match(true) {
            $nilai >= 90 => 'success',
            $nilai >= 75 => 'info',
            $nilai >= 60 => 'warning',
            default       => 'danger',
        };
    }

    // Halaman tentang dan FAQ
    public function about() { return view('guru.about'); }
    public function faq() { return view('guru.faq'); }
}
