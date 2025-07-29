<?php

namespace App\Http\Controllers;

use App\Services\ActivityLogService;
use Illuminate\Http\Request;

/**
 * Controller untuk mengelola log aktivitas di halaman admin
 */
class AdminActivityLogController extends Controller
{
    protected $activityLogService;

    /**
     * Constructor untuk menginisialisasi service log aktivitas
     *
     * @param ActivityLogService $activityLogService Service untuk mengelola log aktivitas
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    /**
     * Menampilkan daftar log aktivitas dengan filter berdasarkan request
     *
     * @param Request $request Permintaan HTTP yang berisi parameter filter (jika ada)
     * @return \Illuminate\View\View Mengembalikan view dengan data log, tipe user, dan aksi
     */
    public function index(Request $request)
    {
        // Mendapatkan daftar log aktivitas yang telah difilter berdasarkan request
        $activities = $this->activityLogService->getFilteredLogs($request);

        // Mendapatkan daftar tipe user untuk filter
        $user_types = $this->activityLogService->getUserTypes();

        // Mendapatkan daftar aksi untuk filter
        $actions = $this->activityLogService->getActions();

        // Mengembalikan view dengan data yang telah disiapkan
        return view('activity_log.index', compact('activities', 'user_types', 'actions'));
    }
}