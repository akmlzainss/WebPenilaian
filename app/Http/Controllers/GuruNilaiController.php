<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Nilai;
use App\Models\Murid;
use App\Models\Mapel;
use App\Services\NilaiService;
use App\Services\ActivityLogService;
use App\Services\ExportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/** Controller untuk mengelola nilai oleh guru */
class GuruNilaiController extends Controller
{
    protected $nilaiService;
    protected $activityLogService;
    protected $exportService;

    /** Inisialisasi service */
    public function __construct(NilaiService $nilaiService, ActivityLogService $activityLogService, ExportService $exportService)
    {
        $this->nilaiService = $nilaiService;
        $this->activityLogService = $activityLogService;
        $this->exportService = $exportService;
    }

    /** Tampilkan daftar nilai */
    public function index(Request $request)
    {
        $guru = Guru::where('username_user', Auth::user()->username)->firstOrFail();
        $query = Nilai::where('kode', $guru->kode)->where('nip', $guru->nip)->with('murid', 'mapel');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('murid', function ($q2) use ($request) {
                    $q2->where('nama', 'like', '%' . $request->search . '%')
                       ->orWhere('nis', 'like', '%' . $request->search . '%');
                })->orWhere('predikat', 'like', '%' . $request->search . '%')
                  ->orWhere('semester', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('nilai_min')) $query->where('nilai', '>=', $request->nilai_min);
        if ($request->filled('nilai_max')) $query->where('nilai', '<=', $request->nilai_max);
        if ($request->filled('predikat')) $query->where('predikat', $request->predikat);
        if ($request->filled('semester')) $query->where('semester', $request->semester);

        $sort = $request->get('sort', 'murid.nama');
        $direction = $request->get('direction', 'asc');
        if ($sort === 'murid.nama') {
            $query->join('murid', 'nilai.nis', '=', 'murid.nis')->orderBy('murid.nama', $direction);
        } elseif ($sort === 'nilai') {
            $query->orderBy('nilai', $direction === 'asc' ? 'desc' : 'asc');
        } else {
            $query->orderBy($sort, $direction);
        }

        $nilai = $query->get();
        $predikat_list = ['A' => 'A (Sangat Baik)', 'B' => 'B (Baik)', 'C' => 'C (Cukup)', 'D' => 'D (Kurang)'];
        $semester_list = $this->nilaiService->getSemesterList();

        return view('nilai.guru.index', compact('nilai', 'predikat_list', 'semester_list'));
    }

    /** Tampilkan form tambah nilai */
    public function create()
    {
        $murids = Murid::all();
        $guru = Guru::where('username_user', Auth::user()->username)->firstOrFail();
        $semester_list = $this->nilaiService->getSemesterList();
        return view('nilai.guru.create', compact('murids', 'guru', 'semester_list'));
    }

    /** Simpan data nilai baru */
    public function store(Request $request)
    {
        $guru = Guru::where('username_user', Auth::user()->username)->firstOrFail();
        $request->validate([
            'nis' => 'required|exists:murid,nis',
            'kode' => 'required|exists:mapel,kode|in:' . $guru->kode,
            'nip' => 'required|exists:guru,nip|in:' . $guru->nip,
            'nilai' => 'required|numeric|min:0|max:100',
            'predikat' => 'required|in:A,B,C,D',
            'semester' => 'required|in:1,2',
        ]);
        $this->nilaiService->createNilai($request);
        return redirect()->route('guru.nilai.index')->with('success', 'Nilai berhasil ditambahkan');
    }

    /** Tampilkan form edit nilai */
    public function edit($nis, $kode)
    {
        $nilai = Nilai::where('nis', $nis)->where('kode', $kode)->firstOrFail();
        $murids = Murid::all();
        $guru = Guru::where('username_user', Auth::user()->username)->firstOrFail();
        $semester_list = $this->nilaiService->getSemesterList();
        if ($nilai->kode !== $guru->kode || $nilai->nip !== $guru->nip) abort(403, 'Unauthorized action.');
        return view('nilai.guru.edit', compact('nilai', 'murids', 'guru', 'semester_list'));
    }

    /** Perbarui data nilai */
    public function update(Request $request, $nis, $kode)
    {
        $guru = Guru::where('username_user', Auth::user()->username)->firstOrFail();
        $request->validate([
            'nis' => 'required|exists:murid,nis',
            'kode' => 'required|exists:mapel,kode|in:' . $guru->kode,
            'nip' => 'required|exists:guru,nip|in:' . $guru->nip,
            'nilai' => 'required|numeric|min:0|max:100',
            'predikat' => 'required|in:A,B,C,D',
            'semester' => 'required|in:1,2',
        ]);
        $this->nilaiService->updateNilai($request, $nis, $kode);
        return redirect()->route('guru.nilai.index')->with('success', 'Nilai berhasil diperbarui');
    }

    /** Hapus data nilai */
    public function destroy($nis, $kode)
    {
        $guru = Guru::where('username_user', Auth::user()->username)->firstOrFail();
        $nilai = Nilai::where('nis', $nis)->where('kode', $kode)->firstOrFail();
        if ($nilai->kode !== $guru->kode || $nilai->nip !== $guru->nip) abort(403, 'Unauthorized action.');
        $this->nilaiService->deleteNilai($nis, $kode);
        return redirect()->route('guru.nilai.index')->with('success', 'Nilai berhasil dihapus');
    }

    /** Ekspor data nilai */
    public function export(Request $request)
    {
        $guru = Guru::where('username_user', Auth::user()->username)->firstOrFail();
        $nilai = Nilai::where('kode', $guru->kode)->where('nip', $guru->nip)->with('murid', 'mapel')->get();
        $columns = ['NIS', 'Nama Murid', 'Mata Pelajaran', 'Nilai', 'Predikat', 'Semester'];
        $dataMapper = fn($n) => [
            $n->nis,
            $n->murid->nama ?? 'N/A',
            $n->mapel->mata_pelajaran ?? 'N/A',
            $n->nilai,
            $n->predikat,
            $n->semester,
        ];
        $this->activityLogService->logActivity([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'export',
            'table_name' => 'nilai',
            'description' => 'Mengekspor data nilai oleh guru',
        ]);
        return $this->exportService->export($nilai, $request->input('format', 'excel'), 'nilai.guru.export_pdf', 'nilai_data', $columns, $dataMapper);
    }
}