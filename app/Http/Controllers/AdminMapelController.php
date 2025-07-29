<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Services\MapelService;
use App\Services\ExportService;
use Illuminate\Http\Request;
use App\Services\ActivityLogService;
use Illuminate\Support\Facades\Auth;

/** Controller untuk mengelola mata pelajaran di halaman admin */
class AdminMapelController extends Controller
{
    protected $mapelService;
    protected $exportService;
    protected $activityLogService;

    /** Inisialisasi service */
    public function __construct(MapelService $mapelService, ExportService $exportService, ActivityLogService $activityLogService)
    {
        $this->mapelService = $mapelService;
        $this->exportService = $exportService;
        $this->activityLogService = $activityLogService;
    }

    /** Tampilkan daftar mata pelajaran */
    public function index(Request $request)
    {
        $mapels = $this->mapelService->getFilteredMapel($request);
        return view('mata_pelajaran.index', compact('mapels'));
    }

    /** Tampilkan form tambah mata pelajaran */
    public function create()
    {
        return view('mata_pelajaran.create');
    }

    /** Simpan mata pelajaran baru */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:mapel,kode',
            'mata_pelajaran' => 'required',
        ]);

        $this->mapelService->createMapel($request);
        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil ditambahkan');
    }

    /** Tampilkan form edit mata pelajaran */
    public function edit($kode)
    {
        $mapel = Mapel::where('kode', $kode)->firstOrFail();
        return view('mata_pelajaran.edit', compact('mapel'));
    }

    /** Perbarui data mata pelajaran */
    public function update(Request $request, $kode)
    {
        $request->validate([
            'kode' => 'required|unique:mapel,kode,' . $kode . ',kode',
            'mata_pelajaran' => 'required',
        ]);

        $this->mapelService->updateMapel($request, $kode);
        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil diperbarui');
    }

    /** Hapus mata pelajaran */
    public function destroy($kode)
    {
        $this->mapelService->deleteMapel($kode);
        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil dihapus');
    }

    /** Ekspor data mata pelajaran */
    public function export(Request $request)
    {
        $mapels = Mapel::all();
        $columns = ['Kode', 'Mata Pelajaran'];
        $dataMapper = fn($m) => [$m->kode, $m->mata_pelajaran];

        // Log aktivitas ekspor
        $this->activityLogService->logActivity([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'export',
            'table_name' => 'mapel',
            'description' => 'Mengekspor data mata pelajaran oleh admin',
        ]);

        return $this->exportService->export($mapels, $request->input('format', 'excel'), 'mata_pelajaran.export_pdf', 'mapel_data', $columns, $dataMapper);
    }
}