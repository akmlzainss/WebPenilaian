<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Murid;
use App\Models\Mapel;
use App\Models\Guru;
use App\Services\NilaiService;
use App\Services\ExportService;
use Illuminate\Http\Request;
use App\Services\ActivityLogService;
use Illuminate\Support\Facades\Auth;

/** Controller untuk mengelola data nilai di halaman admin */
class AdminNilaiController extends Controller
{
    protected $nilaiService;
    protected $exportService;
    protected $activityLogService;

    /** Inisialisasi service */
    public function __construct(NilaiService $nilaiService, ExportService $exportService, ActivityLogService $activityLogService)
    {
        $this->nilaiService = $nilaiService;
        $this->exportService = $exportService;
        $this->activityLogService = $activityLogService;
    }

    /** Tampilkan daftar nilai */
    public function index(Request $request)
    {
        $query = Nilai::select('nilai.*')->join('mapel', 'nilai.kode', '=', 'mapel.kode');

        if ($request->filled('search')) {
            $query->where('mapel.mata_pelajaran', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('semester')) {
            $query->where('nilai.semester', $request->semester);
        }

        $allowedSorts = ['mata_pelajaran', 'semester', 'nilai'];
        $sort = in_array($request->get('sort'), $allowedSorts) ? $request->get('sort') : 'mata_pelajaran';
        $direction = $request->get('direction', 'asc');

        if ($sort === 'nilai') {
            $query->orderBy('nilai', $direction === 'asc' ? 'desc' : 'asc');
        } else {
            $query->orderBy($sort === 'mata_pelajaran' ? 'mapel.mata_pelajaran' : 'nilai.' . $sort, $direction);
        }

        $nilai = $query->get();
        $semester_list = $this->nilaiService->getSemesterList();
        return view('nilai.admin.index', compact('nilai', 'semester_list'));
    }

    /** Tampilkan form tambah nilai */
    public function create()
    {
        $murids = Murid::all();
        $mapels = Mapel::all();
        $gurus = Guru::all();
        $semester_list = $this->nilaiService->getSemesterList();
        return view('nilai.admin.create', compact('murids', 'mapels', 'gurus', 'semester_list'));
    }

    /** Simpan data nilai baru */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|exists:murid,nis',
            'kode' => 'required|exists:mapel,kode',
            'nip' => 'required|exists:guru,nip',
            'nilai' => 'required|numeric|min:0|max:100',
            'predikat' => 'required|in:A,B,C,D',
            'semester' => 'required|in:1,2',
        ]);

        $this->nilaiService->createNilai($request);
        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil ditambahkan');
    }

    /** Tampilkan form edit nilai */
    public function edit($nis, $kode)
    {
        $nilai = Nilai::where('nis', $nis)->where('kode', $kode)->firstOrFail();
        $murids = Murid::all();
        $mapels = Mapel::all();
        $gurus = Guru::all();
        $semester_list = $this->nilaiService->getSemesterList();
        return view('nilai.admin.edit', compact('nilai', 'murids', 'mapels', 'gurus', 'semester_list'));
    }

    /** Perbarui data nilai */
    public function update(Request $request, $nis, $kode)
    {
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'predikat' => 'required|in:A,B,C,D,E',
            'semester' => 'required|in:1,2',
        ]);

        $nilai = Nilai::where('nis', $nis)->where('kode', $kode)->firstOrFail();
        $nilai->update([
            'nilai' => $request->nilai,
            'predikat' => $request->predikat,
            'semester' => $request->semester,
        ]);

        $this->activityLogService->logActivity([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'update',
            'table_name' => 'nilai',
            'description' => 'Memperbarui nilai untuk NIS: ' . $nilai->nis . ', Kode Mapel: ' . $nilai->kode . ', Guru NIP: ' . $nilai->nip,
        ]);

        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil diperbarui');
    }

    /** Hapus data nilai */
    public function destroy($nis, $kode)
    {
        $this->nilaiService->deleteNilai($nis, $kode);
        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil dihapus');
    }

    /** Ekspor data nilai */
    public function export(Request $request)
    {
        $nilai = Nilai::with('murid', 'mapel', 'guru')->get();
        $columns = ['NIS', 'Nama Murid', 'Mata Pelajaran', 'Guru', 'Nilai', 'Predikat', 'Semester'];
        $dataMapper = fn($n) => [
            $n->nis,
            $n->murid->nama ?? 'N/A',
            $n->mapel->mata_pelajaran ?? 'N/A',
            $n->guru->nama ?? 'N/A',
            $n->nilai,
            $n->predikat,
            $n->semester
        ];

        $this->activityLogService->logActivity([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'export',
            'table_name' => 'nilai',
            'description' => 'Mengekspor data nilai oleh admin',
        ]);

        return $this->exportService->export($nilai, $request->input('format', 'excel'), 'nilai.admin.export_pdf', 'nilai_data', $columns, $dataMapper);
    }
}