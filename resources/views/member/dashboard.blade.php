@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-3">Dashboard Ruang Member</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 bg-white p-6 rounded-lg shadow-md border h-fit">
            <h3 class="text-xl font-bold text-gray-700 mb-4">📢 Suarakan Opinimu</h3>
            
            <form action="/member/opini" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Judul Opini</label>
                    <input type="text" name="judul_opini" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ketik judul opini..." required>
                </div>
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Isi Opini</label>
                    <textarea name="isi_opini" id="editor_opini" rows="6" class="w-full border rounded-lg" required></textarea>
                </div>
                
                <button type="submit" class="w-full bg-blue-900 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-800 transition">
                    Kirim Opini
                </button>
            </form>
        </div>

        <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md border">
            <h3 class="text-xl font-bold text-gray-700 mb-4">🗂️ Riwayat Tulisan Saya</h3>
            
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-50 text-left text-gray-700">
                            <th class="border border-gray-200 px-4 py-2">Judul Opini</th>
                            <th class="border border-gray-200 px-4 py-2">Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        @forelse($opini as $op)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-200 px-4 py-2 font-medium text-gray-800">{{ $op->judul_opini }}</td>
                                <td class="border border-gray-200 px-4 py-2 text-sm">
                                    {{ $op->created_at->format('d M Y, H:i') }} WIB
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="border border-gray-200 px-4 py-8 text-center text-gray-400">
                                    Kamu belum pernah menulis opini. Yuk, mulai menulis!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
    CKEDITOR.replace('editor_opini');
</script>
@endsection