<?php

namespace App\Http\Controllers;

use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/** Controller untuk autentikasi pengguna */
class AuthController extends Controller
{
    protected $activityLogService;

    /** Inisialisasi service log aktivitas */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    /** Tampilkan form login */
    public function showLoginForm()
    {
        return view('login'); // Kirim ke view login
    }

    /** Proses login pengguna */
    public function login(Request $request)
    {
        // Validasi kredensial
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $remember = $request->has('remember'); // Cek opsi "ingat saya"

        // Coba autentikasi
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // Regen session untuk keamanan

            // Log aktivitas login
            $this->activityLogService->logActivity([
                'user_type' => Auth::user()->role,
                'user_id' => Auth::user()->username,
                'action' => 'login',
                'table_name' => 'system',
                'description' => 'Pengguna login ke sistem',
            ]);

            // Arahkan berdasarkan opsi "ingat saya"
            if ($remember) {
                return redirect()->intended('home');
            } else {
                return redirect()->route('login');
            }
        }

        // Kembali dengan error jika gagal
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    /** Proses login via API */
    public function apiLogin(Request $request)
    {
        // Validasi kredensial
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Coba autentikasi
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Username atau password salah'], 401);
        }

        $user = Auth::user(); // Ambil data user
        // Cek role hanya untuk murid
        if ($user->role !== 'murid') {
            return response()->json(['message' => 'Akses hanya untuk role murid'], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken; // Buat token

        // Log aktivitas login API
        $this->activityLogService->logActivity([
            'user_type' => $user->role,
            'user_id' => $user->username,
            'action' => 'login',
            'table_name' => 'system',
            'description' => 'Pengguna murid login via API',
        ]);

        return response()->json(['token' => $token, 'user' => $user]); // Kembalikan token dan data user
    }

    /** Proses logout pengguna */
    public function logout(Request $request)
    {
        // Log aktivitas logout
        $this->activityLogService->logActivity([
            'user_type' => Auth::user()->role,
            'user_id' => Auth::user()->username,
            'action' => 'logout',
            'table_name' => 'system',
            'description' => 'Pengguna logout dari sistem',
        ]);

        Auth::logout(); // Logout pengguna
        $request->session()->invalidate(); // Invalidasi session
        $request->session()->regenerateToken(); // Regen token keamanan

        $cookie = Cookie::forget(Auth::getRecallerName()); // Hapus cookie "ingat saya"
        return redirect('/')->withCookie($cookie); // Kembali ke halaman utama
    }

    /** Proses logout via API */
    public function apiLogout(Request $request)
    {
        $request->user()->tokens()->delete(); // Hapus semua token user

        // Log aktivitas logout API
        $this->activityLogService->logActivity([
            'user_type' => $request->user()->role,
            'user_id' => $request->user()->username,
            'action' => 'logout',
            'table_name' => 'system',
            'description' => 'Pengguna logout via API',
        ]);

        return response()->json(['message' => 'Logout berhasil']); // Kembalikan respons sukses
    }
}