<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $activityLogService;

    // Konstruktor untuk menyuntikkan ActivityLogService
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    // Menampilkan halaman form tambah pengguna
    public function create()
    {
        return view('admin.user.create');
    }

    // Menyimpan data pengguna baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,guru,murid',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Mencatat aktivitas penambahan pengguna
        $this->activityLogService->logActivity([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'create',
            'table_name' => 'users',
            'description' => 'Menambahkan pengguna: ' . $user->username,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    // Menampilkan form edit data pengguna
    public function edit($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('admin.user.edit', compact('user'));
    }

    // Memperbarui data pengguna di database
    public function update(Request $request, $username)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $username . ',username',
            'role' => 'required|in:admin,guru,murid',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = User::where('username', $username)->firstOrFail();
        $data = $request->only(['username', 'role']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Mencatat aktivitas pembaruan pengguna
        $this->activityLogService->logActivity([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'update',
            'table_name' => 'users',
            'description' => 'Memperbarui pengguna: ' . $user->username,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil diperbarui');
    }

    // Menghapus data pengguna dari database
    public function destroy($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $user->delete();

        // Mencatat aktivitas penghapusan pengguna
        $this->activityLogService->logActivity([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'delete',
            'table_name' => 'users',
            'description' => 'Menghapus pengguna: ' . $username,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil dihapus');
    }
}
