<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use App\Services\MuridService;
use App\Services\ExportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ActivityLogService;

/** Controller untuk mengelola data murid di halaman admin */
class AdminMuridController extends Controller
{
    protected $muridService;
    protected $exportService;
    protected $activityLogService;

    /** Inisialisasi service */
    public function __construct(MuridService $muridService, ExportService $exportService, ActivityLogService $activityLogService)
    {
        $this->muridService = $muridService;
        $this->exportService = $exportService;
        $this->activityLogService = $activityLogService;
    }

    /** Tampilkan daftar murid */
    public function index(Request $request)
    {
        $murids = $this->muridService->getFilteredMurid($request);
        $kelas_list = $this->muridService->getKelasList();
        $jenis_kelamin_list = $this->muridService->getJenisKelaminList();
        return view('murid.index', compact('murids', 'kelas_list', 'jenis_kelamin_list'));
    }

    /** Tampilkan form tambah murid */
    public function create()
    {
        $kelas_list = $this->muridService->getKelasList();
        return view('murid.create', compact('kelas_list'));
    }

    /** Simpan data murid baru */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => [
                'required',
                'unique:murid,nis',
                'unique:users,username',
                'regex:/^[0-9]+$/',
                function ($attribute, $value, $fail) {
                    if (!is_numeric($value)) {
                        $fail('NIS harus berupa angka saja.');
                    }
                },
            ],
            'kelas' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telp' => [
                'required',
                'regex:/^[0-9]+$/',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^[0-9]+$/', $value)) {
                        $fail('Nomor telepon harus berupa angka saja.');
                    }
                },
            ],
            'tgl_lahir' => 'required|date',
        ], [
            'nis.unique' => 'NIS sudah digunakan, silakan gunakan NIS lain.',
            'no_telp.regex' => 'Nomor telepon hanya boleh berisi angka.',
        ]);

        $this->muridService->createMurid($request);
        return redirect()->route('admin.murid.index')->with('success', 'Murid berhasil ditambahkan');
    }

    /** Tampilkan form edit murid */
    public function edit($nis)
    {
        $murid = Murid::where('nis', $nis)->firstOrFail();
        $kelas_list = $this->muridService->getKelasList();
        return view('murid.edit', compact('murid', 'kelas_list'));
    }

    /** Perbarui data murid */
    public function update(Request $request, $nis)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => [
                'required',
                'unique:murid,nis,' . $nis . ',nis',
                'unique:users,username,' . $nis . ',username',
                'regex:/^[0-9]+$/',
                function ($attribute, $value, $fail) {
                    if (!is_numeric($value)) {
                        $fail('NIS harus berupa angka saja.');
                    }
                },
            ],
            'kelas' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telp' => [
                'required',
                'regex:/^[0-9]+$/',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^[0-9]+$/', $value)) {
                        $fail('Nomor telepon harus berupa angka saja.');
                    }
                },
            ],
            'tgl_lahir' => 'required|date',
        ], [
            'nis.unique' => 'NIS sudah digunakan, silakan gunakan NIS lain.',
            'no_telp.regex' => 'Nomor telepon hanya boleh berisi angka.',
        ]);

        $this->muridService->updateMurid($request, $nis);
        return redirect()->route('admin.murid.index')->with('success', 'Murid berhasil diperbarui');
    }

    /** Hapus data murid */
    public function destroy($nis)
    {
        $this->muridService->deleteMurid($nis);
        return redirect()->route('admin.murid.index')->with('success', 'Murid berhasil dihapus');
    }

    /** Ekspor data murid */
    public function export(Request $request)
    {
        $murids = Murid::all();
        $columns = ['NIS', 'Nama', 'Kelas', 'Jenis Kelamin', 'No Telp', 'Tanggal Lahir'];
        $dataMapper = fn($m) => [
            $m->nis,
            $m->nama,
            $m->kelas,
            $m->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
            $m->no_telp,
            $m->tgl_lahir
        ];

        // Log aktivitas ekspor
        $this->activityLogService->logActivity([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'export',
            'table_name' => 'murid',
            'description' => 'Mengekspor data murid oleh admin',
        ]);

        return $this->exportService->export($murids, $request->input('format', 'excel'), 'murid.export_pdf', 'murid_data', $columns, $dataMapper);
    }
}