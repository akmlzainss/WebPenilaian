<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/** Controller untuk mengelola user dan profil admin */
class AdminUserController extends Controller
{
    protected $activityLogService;

    /** Inisialisasi service log aktivitas */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    /** Tampilkan daftar semua user */
    public function index()
    {
        $users = User::all(); // Ambil semua data user
        return view('admin.user.index', compact('users')); // Kirim ke view
    }

    /** Tampilkan halaman profil admin */
    public function profil()
    {
        $user = Auth::user(); // Ambil data admin yang login
        return view('admin.profil', compact('user')); // Kirim ke view
    }

    /** Perbarui kata sandi admin */
    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user(); // Ambil data admin yang login

        // Cek kata sandi saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini salah']);
        }

        // Perbarui kata sandi
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Log aktivitas
        $this->activityLogService->logActivity([
            'user_type' => $user->role,
            'user_id' => $user->username,
            'action' => 'update',
            'table_name' => 'users',
            'description' => 'Admin mengubah kata sandi sendiri',
        ]);

        return redirect()->route('admin.profil')->with('success', 'Kata sandi berhasil diperbarui');
    }

    /** Tampilkan form ubah kata sandi user */
    public function editPassword($username)
    {
        $user = User::where('username', $username)->firstOrFail(); // Ambil data user
        return view('admin.user.edit_password', compact('user')); // Kirim ke view
    }

    /** Perbarui kata sandi user tertentu */
    public function updatePasswordOnly(Request $request, $username)
    {
        // Validasi input
        $request->validate([
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('username', $username)->firstOrFail(); // Ambil data user
        $user->password = Hash::make($request->new_password); // Perbarui kata sandi
        $user->save();

        // Log aktivitas
        $this->activityLogService->logActivity([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'update',
            'table_name' => 'users',
            'description' => 'Admin mengubah kata sandi pengguna: ' . $username,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'Kata sandi pengguna berhasil diperbarui');
    }
}