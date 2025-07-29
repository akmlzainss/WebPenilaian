<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use App\Models\Mapel;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/** Controller untuk guru mencari data murid */
class GuruMuridController extends Controller
{
    protected $activityLogService;

    /** Inisialisasi service log aktivitas */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    /** Cari murid berdasarkan filter */
    public function search(Request $request)
    {
        // Ambil daftar kelas dan jenis kelamin untuk filter
        $kelas_list = Murid::distinct()->pluck('kelas')->sort();
        $jenis_kelamin_list = ['L' => 'Laki-laki', 'P' => 'Perempuan'];

        // Dapatkan data guru yang login
        $guru = Auth::user()->guru;
        if (!$guru) {
            return redirect()->route('guru.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Ambil mata pelajaran yang diajar guru
        $mapel = Mapel::where('kode', $guru->kode)->first();
        if (!$mapel) {
            return redirect()->route('guru.dashboard')->with('error', 'Mata pelajaran tidak ditemukan.');
        }
        $mata_pelajaran = $mapel->mata_pelajaran;

        // Query dasar untuk murid
        $query = Murid::query();

        // Filter murid berdasarkan mata pelajaran guru
        $mapel_code = $guru->kode;
        $query->whereExists(function ($subQuery) use ($mapel_code) {
            $subQuery->selectRaw(1)
                ->from('nilai')
                ->whereColumn('nilai.nis', 'murid.nis')
                ->where('nilai.kode', $mapel_code);
        });

        // Filter pencarian berdasarkan nama
        if ($search = $request->input('search')) {
            $query->where('nama', 'like', '%' . $search . '%');
        }

        // Filter berdasarkan kelas
        if ($kelas = $request->input('kelas')) {
            $query->where('kelas', $kelas);
        }

        // Filter berdasarkan jenis kelamin
        if ($jenis_kelamin = $request->input('jenis_kelamin')) {
            $query->where('jenis_kelamin', $jenis_kelamin);
        }

        // Sorting data
        $sort = $request->input('sort', 'nama');
        $direction = $request->input('direction', 'asc');
        $query->orderBy($sort, $direction);

        // Ambil hasil query
        $murids = $query->get();

        // Catat log aktivitas pencarian
        $this->activityLogService->logActivity([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'search',
            'table_name' => 'murid',
            'description' => 'Guru mencari murid dengan filter: ' . json_encode($request->only(['search', 'kelas', 'jenis_kelamin', 'sort', 'direction'])),
        ]);

        return view('murid.search', compact('murids', 'kelas_list', 'jenis_kelamin_list', 'mata_pelajaran'));
    }
}