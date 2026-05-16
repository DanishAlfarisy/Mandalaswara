@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg border border-gray-200">
    <h2 class="text-3xl font-bold text-center text-blue-900 mb-6">Login Mandalaswara</h2>
    
    <form action="/login" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Username</label>
            <input type="text" name="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Password</label>
            <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <button type="submit" class="w-full bg-blue-900 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-800 transition">Masuk</button>
    </form>
</div>
@endsection