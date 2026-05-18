@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">MandalaSwara Opini</h1>
        <a href="#" class="text-white hover:underline">Terbaru | Trending</a>
    </div>

    <div class="grid md:grid-cols-4 gap-6">
        @foreach($opiniArticles ?? array_fill(0,8,[
            'title'=>'Opini Sample',
            'image'=>'https://picsum.photos/300/200?random=20'
        ]) as $opini)
            <div class="bg-red-600 rounded overflow-hidden hover:scale-105 transition-transform cursor-pointer">
                <img src="{{ $opini['image'] }}" class="w-full h-40 object-cover">
                <div class="p-2 text-white font-semibold">{{ $opini['title'] }}</div>
            </div>
        @endforeach
    </div>

</div>
@endsection