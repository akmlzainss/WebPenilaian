<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use App\Models\Nilai;
use App\Models\Mapel;
use App\Services\ActivityLogService;
use App\Services\ExportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/** Controller untuk mengelola data murid */
class MuridUserController extends Controller
{
    protected $activityLogService;
    protected $exportService;

    /** Inisialisasi service */
    public function __construct(ActivityLogService $activityLogService, ExportService $exportService)
    {
        $this->activityLogService = $activityLogService;
        $this->exportService = $exportService;
    }

    /** Tampilkan dashboard murid */
    public function dashboard()
    {
        if (Auth::user()->role !== 'murid') return redirect()->route('login')->with('error', 'Akses ditolak.');
        $murid = Auth::user()->murid;
        if (!$murid) return redirect()->route('home')->with('error', 'Data murid tidak ditemukan.');

        // Ambil data nilai dengan mapel dan guru yang unik berdasarkan kode dan nip
        $nilai = Nilai::select('kode', 'nip')
            ->where('nis', $murid->nis)
            ->distinct()
            ->with(['mapel', 'guru'])
            ->get();

        return view('murid.dashboard', ['murid' => $murid, 'nilai' => $nilai]);
    }

    /** Tampilkan profil murid */
    public function profil()
    {
        if (Auth::user()->role !== 'murid') return redirect()->route('login')->with('error', 'Akses ditolak.');
        $murid = Auth::user()->murid;
        if (!$murid) return redirect()->route('home')->with('error', 'Data murid tidak ditemukan.');
        return view('murid.profil', ['murid' => $murid]);
    }

    /** Update profil dan password murid */
    public function updateProfil(Request $request)
    {
        if (Auth::user()->role !== 'murid') return redirect()->route('login')->with('error', 'Akses ditolak.');
        $user = Auth::user();
        $murid = $user->murid;
        if (!$murid) return redirect()->route('home')->with('error', 'Data murid tidak ditemukan.');

        $request->validate(['no_telp' => 'required|string|max:20', 'current_password' => 'required', 'new_password' => 'required|min:6|confirmed']);
        if (!Hash::check($request->current_password, $user->password)) return redirect()->back()->with('error', 'Kata sandi lama salah.');
        $murid->update(['no_telp' => $request->no_telp]);
        $user->update(['password' => Hash::make($request->new_password)]);
        $this->activityLogService->logActivity(['user_type' => $user->role, 'user_id' => $user->username, 'action' => 'update', 'table_name' => 'users', 'description' => 'Murid mengubah profil dan kata sandi (NIS: ' . $murid->nis . ')']);
        return redirect()->route('murid.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    /** Tampilkan nilai dengan filter dan DataTables */
    public function nilai(Request $request)
    {
        if (Auth::user()->role !== 'murid') return redirect()->route('login')->with('error', 'Akses ditolak.');
        $murid = Auth::user()->murid;
        if (!$murid) return redirect()->route('home')->with('error', 'Data murid tidak ditemukan.');

        $query = Nilai::where('nis', $murid->nis)->with(['mapel', 'guru']);
        if ($request->filled('search')) $query->whereHas('mapel', fn($q) => $q->where('mata_pelajaran', 'like', "%{$request->search}%"));
        if ($request->filled('semester')) $query->where('semester', $request->semester);
        $sort = $request->get('sort', 'mapel.mata_pelajaran');
        $direction = $request->get('direction', 'asc');
        if ($sort === 'mapel.mata_pelajaran') {
            $query->join('mapel', 'nilai.kode', '=', 'mapel.kode')->orderBy('mapel.mata_pelajaran', $direction);
        } elseif ($sort === 'guru.nama') {
            $query->join('guru', 'nilai.nip', '=', 'guru.nip')->orderBy('guru.nama', $direction);
        } elseif ($sort === 'nilai') {
            $query->orderBy('nilai', $direction === 'asc' ? 'desc' : 'asc');
        } else {
            $query->orderBy($sort, $direction);
        }

        $nilai = $query->get(); // Data dikirim ke view untuk DataTables
        $semester_list = [1 => 'Semester 1', 2 => 'Semester 2'];

        return view('nilai.murid.index', compact('nilai', 'semester_list', 'murid'));
    }

    /** Export data nilai ke Excel, PDF, atau Word */
    public function export(Request $request)
    {
        if (Auth::user()->role !== 'murid') return redirect()->route('login')->with('error', 'Akses ditolak.');
        $murid = Auth::user()->murid;
        if (!$murid) return redirect()->route('home')->with('error', 'Data murid tidak ditemukan.');

        $nilai = Nilai::where('nis', $murid->nis)->with(['mapel', 'guru'])->get();
        $columns = ['Mata Pelajaran', 'Guru', 'Nilai', 'Predikat', 'Semester'];
        $dataMapper = fn($n) => [
            $n->mapel->mata_pelajaran ?? 'N/A',
            $n->guru->nama ?? 'N/A',
            $n->nilai,
            $n->predikat,
            $n->semester,
        ];

        $this->activityLogService->logActivity([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'export',
            'table_name' => 'nilai',
            'description' => 'Mengekspor data nilai oleh murid (NIS: ' . $murid->nis . ')',
        ]);

        return $this->exportService->export($nilai, $request->input('format', 'excel'), 'nilai.murid.export_pdf', 'nilai_data', $columns, $dataMapper);
    }

    /** API untuk mengambil data nilai */
    public function apiNilai(Request $request)
    {
        try {
            $user = $request->user();
            if (!$user || $user->role !== 'murid') return response()->json(['message' => 'Akses ditolak'], 403);
            $murid = $user->murid;
            if (!$murid) return response()->json(['message' => 'Data murid tidak ditemukan'], 404);
            $nilai = Nilai::where('nis', $murid->nis)->with(['mapel', 'guru'])->get();
            return response()->json([
                'murid' => ['nama' => $murid->nama, 'nis' => $murid->nis],
                'nilai' => $nilai,
                'message' => $nilai->isEmpty() ? 'Tidak ada data nilai' : null
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan server: ' . $e->getMessage()], 500);
        }
    }

    /** Tampilkan halaman About */
    public function about()
    {
        return view('murid.about');
    }

    /** Tampilkan halaman FAQ */
    public function faq()
    {
        return view('murid.faq');
    }
}