<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLogService
{
    /**
     * Simpan aktivitas ke dalam tabel activity_logs.
     * 
     * @param array $logData Data aktivitas yang akan disimpan.
     */
    public function logActivity(array $logData)
    {
        // Ambil user_id dan user_type dari data atau dari user yang sedang login
        $userId = $logData['user_id'] ?? (Auth::check() ? Auth::user()->username : 'unknown');
        $userType = $logData['user_type'] ?? (Auth::check() ? Auth::user()->role : 'unknown');

        // Ambil data lain dari logData atau gunakan nilai default
        $action = $logData['action'] ?? 'unknown_action';
        $tableName = $logData['table_name'] ?? 'unknown_table';
        $description = $logData['description'] ?? 'No description provided';

        // Simpan data aktivitas ke database
        ActivityLog::create([
            'user_type' => $userType,
            'user_id' => $userId,
            'action' => $action,
            'table_name' => $tableName,
            'description' => $description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Ambil daftar aktivitas terbaru berdasarkan filter user_id dan user_type.
     * 
     * @param array $filters Filter opsional: user_id, user_type, limit.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecentActivities(array $filters = [])
    {
        $query = ActivityLog::query()
            ->where('user_id', $filters['user_id'] ?? Auth::user()->username)
            ->where('user_type', $filters['user_type'] ?? 'guru');

        if (isset($filters['limit'])) {
            $query->limit($filters['limit']);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
     * Ambil data log aktivitas dengan filter dari request.
     * 
     * @param Request $request Request berisi filter user_type, action, start_date, end_date.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredLogs(Request $request)
    {
        $query = ActivityLog::query();

        if ($request->filled('user_type')) {
            $query->where('user_type', $request->user_type);
        }

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * Ambil daftar tipe user unik dari log aktivitas.
     * 
     * @return \Illuminate\Support\Collection
     */
    public function getUserTypes()
    {
        return ActivityLog::distinct()->pluck('user_type');
    }

    /**
     * Ambil daftar aksi unik dari log aktivitas.
     * 
     * @return \Illuminate\Support\Collection
     */
    public function getActions()
    {
        return ActivityLog::distinct()->pluck('action');
    }
}
