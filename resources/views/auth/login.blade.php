<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk atau Daftar - Mandalaswara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background: linear-gradient(to bottom, #0090FF, #0090FF);" class="min-h-screen flex flex-col font-sans">
    
    <!-- Header Bar -->
    <div style="background-color: #0064B0;" class="shadow-md px-6 py-4 flex justify-center">
        <img src="{{ asset('images/logo.png') }}" alt="Mandalaswara Logo" class="h-12 w-auto">
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col justify-center items-center">

    <!-- Login Card -->
    <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-md">
        <h1 class="text-center text-2xl font-bold mb-8">
            <span style="color: #0090FF;">Masuk</span> <span class="text-gray-400">atau</span> <span style="color: #0090FF;">Daftar</span>
        </h1>

        <!-- Google Login Button -->
        <button onclick="handleGoogleLogin()" class="w-full border-2 border-gray-300 rounded-lg py-3 px-4 mb-4 hover:bg-gray-50 transition flex items-center justify-center gap-2 font-medium">
            <svg class="w-5 h-5" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            Lanjutkan dengan Google
        </button>

        <!-- Apple Login Button -->
        <button onclick="handleAppleLogin()" class="w-full border-2 border-gray-300 rounded-lg py-3 px-4 mb-6 hover:bg-gray-50 transition flex items-center justify-center gap-2 font-medium">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.05 13.5c-.91 0-1.82.55-2.25 1.51.5 1.38 1.86 2.36 3.52 2.36 1.95 0 3.5-1.5 3.5-3.5 0-.5-.1-.99-.29-1.42-1.02 1.04-2.41 1.55-4.48 1.55z"/>
                <path d="M12.5 6c2.49 0 3.29 2.39 3.29 5.5 0 .84-.07 1.76-.28 2.73-.29 1.33-.84 2.56-1.68 3.51-.59.66-1.44 1.16-2.33 1.16s-1.74-.5-2.33-1.16c-.84-.95-1.39-2.18-1.68-3.51-.21-.97-.28-1.89-.28-2.73 0-3.11.8-5.5 3.29-5.5z"/>
                <path d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm0 22C6.48 22 2 17.52 2 12S6.48 2 12 2s10 4.48 10 10-4.48 10-10 10z"/>
            </svg>
            Lanjutkan dengan Apple ID
        </button>

        <div class="relative mb-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">Atau</span>
            </div>
        </div>

        <!-- Email Form -->
        <form action="/login" method="POST">
            @csrf
            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
            <input 
                type="email" 
                name="email" 
                placeholder="Masukkan email anda" 
                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-0 mb-4" 
                required
            >
            
            <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
            <input 
                type="password" 
                name="password" 
                placeholder="Masukkan password" 
                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-0 mb-6" 
                required
            >
            
            <button 
                type="submit" 
                style="background-color: #FC5E5E;"
                class="w-full text-white font-bold py-3 px-4 rounded-lg hover:opacity-90 transition mb-4"
            >
                Lanjut
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm">
            Belum punya akun? <a href="/register" class="text-blue-600 hover:underline font-semibold">Daftar di sini</a>
        </p>
    </div>

    </div>

    <!-- Footer Links -->
    <div class="py-6 flex gap-6 text-white text-sm justify-center">
        <a href="/" class="hover:underline">Home</a>
        <a href="#" class="hover:underline">Contact</a>
    </div>

    <script>
        function handleGoogleLogin() {
            // TODO: Implement Google OAuth
            console.log('Google login clicked');
        }

        function handleAppleLogin() {
            // TODO: Implement Apple OAuth
            console.log('Apple login clicked');
        }
    </script>

</body>
</html>