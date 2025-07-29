<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metadata dasar halaman -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Penilaian</title>

    <!-- Import Tailwind CSS untuk styling -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Import Lottie Player untuk animasi JSON -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- Styling tambahan untuk background halaman -->
    <style>
        body {
            background: linear-gradient(90deg, #5e72e4, #825ee4);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center">
    <!-- Container utama berisi dua kolom (animasi dan form login) -->
    <div class="bg-white shadow-lg rounded-lg flex max-w-4xl w-full overflow-hidden">

        <!-- Kolom kiri: Lottie Animation (hanya tampil di layar md ke atas) -->
        <div class="hidden md:flex items-center justify-center w-1/2 bg-indigo-100 p-6">
            <lottie-player 
                src="{{ asset('animations/book.json') }}" 
                background="transparent" 
                speed="1"
                style="width: 300px; height: 300px;" 
                loop autoplay>
            </lottie-player>
        </div>

        <!-- Kolom kanan: Form Login -->
        <div class="w-full md:w-1/2 p-8">
            <!-- Judul dan deskripsi login -->
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Welcome Back!</h1>
                <p class="text-gray-600">Login untuk mengakses sistem penilaian</p>
            </div>

            <!-- Menampilkan pesan error validasi jika ada -->
            @if ($errors->any())
                <div class="bg-red-500 text-white p-3 mb-4 rounded">
                    <ul class="text-sm list-disc list-inside">
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Menampilkan pesan sukses jika ada -->
            @if (session('success'))
                <div class="bg-green-500 text-white p-3 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form login -->
            <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
                @csrf <!-- Token CSRF untuk keamanan -->

                <!-- Input username -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input 
                        type="text" 
                        name="username" 
                        id="username" 
                        required 
                        autofocus
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-indigo-300">
                </div>

                <!-- Input password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-indigo-300">
                </div>

                <!-- Opsi Remember Me dan link lupa password -->
                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center text-sm text-gray-700">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        <span class="ml-2">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-indigo-500 hover:underline">Forgot password?</a>
                </div>

                <!-- Tombol submit -->
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition duration-150">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</body>

</html>
