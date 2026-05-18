<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Mandalaswara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background: linear-gradient(to bottom, #0090FF, #0090FF);" class="min-h-screen flex flex-col font-sans">
    
    <!-- Header Bar -->
    <div style="background-color: #0064B0;" class="shadow-md px-6 py-4 flex justify-center">
        <img src="{{ asset('images/logo.png') }}" alt="Mandalaswara Logo" class="h-12 w-auto">
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col justify-center items-center">

    <!-- Register Card -->
    <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-md">
        <h1 class="text-center text-2xl font-bold text-blue-600 mb-2">
            Daftar Akun
        </h1>
        <p class="text-center text-gray-600 mb-8">Buat akun baru untuk bergabung dengan Mandalaswara</p>

        <!-- Registration Form -->
        <form action="/register" method="POST">
            @csrf
            <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
            <input 
                type="text" 
                name="username" 
                placeholder="Masukkan username" 
                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-0 mb-4" 
                required
            >
            
            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
            <input 
                type="email" 
                name="email" 
                placeholder="Masukkan email" 
                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-0 mb-4" 
                required
            >
            
            <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
            <input 
                type="password" 
                name="password" 
                placeholder="Masukkan password" 
                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-0 mb-4" 
                required
            >
            
            <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
            <input 
                type="password" 
                name="password_confirmation" 
                placeholder="Konfirmasi password" 
                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-0 mb-6" 
                required
            >
            
            <button 
                type="submit" 
                style="background-color: #FC5E5E;"
                class="w-full text-white font-bold py-3 px-4 rounded-lg hover:opacity-90 transition"
            >
                Daftar
            </button>

            <p class="text-center text-gray-600 mt-4 text-sm">
                Sudah punya akun? <a href="/login" class="text-blue-600 hover:underline font-semibold">Masuk di sini</a>
            </p>
        </form>
    </div>

    </div>

    <!-- Footer Links -->
    <div class="py-6 flex gap-6 text-white text-sm justify-center">
        <a href="/" class="hover:underline">Home</a>
        <a href="#" class="hover:underline">Contact</a>
    </div>

</body>
</html>