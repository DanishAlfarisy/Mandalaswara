<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandalaswara Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">
    
    <nav class="bg-blue-900 text-white p-4 shadow-md flex justify-between items-center">
        <a href="/" class="text-2xl font-bold tracking-wider">MANDALASWARA</a>
        
        <form action="/berita/cari" method="GET" class="flex">
            <input type="text" name="keyword" placeholder="Cari berita..." class="px-3 py-1 rounded-l-md text-black focus:outline-none">
            <button type="submit" class="bg-blue-700 px-4 py-1 rounded-r-md hover:bg-blue-600">Cari</button>
        </form>

        <div>
            @auth
                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">Logout</button>
                </form>
            @else
                <a href="/login" class="px-4 py-2 hover:underline">Login</a>
                <a href="/register" class="bg-blue-700 px-4 py-2 rounded hover:bg-blue-600">Register</a>
            @endauth
        </div>
    </nav>

    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>