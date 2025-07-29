<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Guru;
use App\Models\Murid;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';
    protected $fillable = [
        'user_type',
        'user_id', // Diperbarui dari username ke user_id
        'action',
        'table_name',
        'description',
        'created_at',
        'updated_at',
    ];

    /**
     * Mendapatkan nama pengguna berdasarkan user_type dan user_id.
     */
    public function getUserNameAttribute()
    {
        $userId = $this->getAttribute('user_id'); // Akses dengan aman

        if (is_null($userId)) {
            return 'Pengguna Tidak Diketahui';
        }

        if ($this->user_type === 'admin') {
            return $userId; // Untuk admin, user_id adalah username
        } elseif ($this->user_type === 'guru') {
            $guru = Guru::where('nip', $userId)->first();
            return $guru ? $guru->nama : 'Guru Tidak Diketahui';
        } elseif ($this->user_type === 'murid') {
            $murid = Murid::where('nis', $userId)->first();
            return $murid ? $murid->nama : 'Murid Tidak Diketahui';
        }

        return 'Pengguna Tidak Diketahui';
    }
}