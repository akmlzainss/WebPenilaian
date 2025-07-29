<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Services\GuruService;
use App\Services\ExportService;
use Illuminate\Http\Request;
use App\Services\ActivityLogService;
use Illuminate\Support\Facades\Auth;

/** Controller untuk mengelola data guru di halaman admin */
class AdminGuruController extends Controller
{
    protected $guruService;
    protected $exportService;
    protected $activityLogService;

    /** Inisialisasi service */
    public function __construct(GuruService $guruService, ExportService $exportService, ActivityLogService $activityLogService)
    {
        $this->guruService = $guruService;
        $this->exportService = $exportService;
        $this->activityLogService = $activityLogService;
    }

    /** Tampilkan daftar guru */
    public function index()
    {
        $gurus = Guru::with('mapel')->get();
        $mapel_list = Mapel::pluck('mata_pelajaran', 'kode')->toArray();
        $jenis_kelamin_list = ['L' => 'Laki-laki', 'P' => 'Perempuan'];
        return view('guru.index', compact('gurus', 'mapel_list', 'jenis_kelamin_list'));
    }

    /** Tampilkan form tambah guru */
    public function create()
    {
        $mapel = Mapel::all();
        return view('guru.create', compact('mapel'));
    }

    /** Simpan data guru baru */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => [
                'required',
                'unique:guru,nip',
                'unique:users,username',
                'regex:/^[0-9]+$/',
                function ($attribute, $value, $fail) {
                    if (!is_numeric($value)) {
                        $fail('NIP harus berupa angka saja.');
                    }
                },
            ],
            'email' => 'required|email|unique:guru,email',
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
            'kode' => 'required|exists:mapel,kode',
        ], [
            'nip.unique' => 'NIP sudah digunakan, silakan gunakan NIP lain.',
            'no_telp.regex' => 'Nomor telepon hanya boleh berisi angka.',
        ]);

        $this->guruService->createGuru($request);
        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil ditambahkan');
    }

    /** Tampilkan form edit guru */
    public function edit($nip)
    {
        $guru = Guru::where('nip', $nip)->firstOrFail();
        $mapel = Mapel::all();
        return view('guru.edit', compact('guru', 'mapel'));
    }

    /** Perbarui data guru */
    public function update(Request $request, $nip)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => [
                'required',
                'unique:guru,nip,' . $nip . ',nip',
                'unique:users,username,' . $nip . ',username',
                'regex:/^[0-9]+$/',
                function ($attribute, $value, $fail) {
                    if (!is_numeric($value)) {
                        $fail('NIP harus berupa angka saja.');
                    }
                },
            ],
            'email' => 'required|email|unique:guru,email,' . $nip . ',nip',
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
            'kode' => 'required|exists:mapel,kode',
        ], [
            'nip.unique' => 'NIP sudah digunakan, silakan gunakan NIP lain.',
            'no_telp.regex' => 'Nomor telepon hanya boleh berisi angka.',
        ]);

        $this->guruService->updateGuru($request, $nip);
        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil diperbarui');
    }

    /** Hapus data guru */
    public function destroy($nip)
    {
        $this->guruService->deleteGuru($nip);
        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil dihapus');
    }

    /** Ekspor data guru */
    public function export(Request $request)
    {
        $guru = Guru::all();
        $columns = ['NIP', 'Nama', 'Email', 'Jenis Kelamin', 'No Telp', 'Tanggal Lahir', 'Kode Mapel'];
        $dataMapper = fn($g) => [
            $g->nip,
            $g->nama,
            $g->email,
            $g->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
            $g->no_telp,
            $g->tgl_lahir,
            $g->kode
        ];

        // Log aktivitas ekspor
        $this->activityLogService->logActivity([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'export',
            'table_name' => 'guru',
            'description' => 'Mengekspor data guru oleh admin',
        ]);

        return $this->exportService->export($guru, $request->input('format', 'excel'), 'guru.export_pdf', 'guru_data', $columns, $dataMapper);
    }
}