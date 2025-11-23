@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto pt-30 pb-10">

    <h1 class="text-3xl font-bold mb-6">Berita Terbaru</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @foreach ($berita as $item)
        <a href="{{ route('berita.show', $item->slug) }}" 
           class="bg-white rounded shadow hover:shadow-lg transition overflow-hidden">

            <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                 class="h-48 w-full object-cover">

            <div class="p-4">
                <h2 class="font-semibold text-lg">{{ $item->title }}</h2>
                <p class="text-gray-500 text-sm mt-2">
                    {{ Str::limit(strip_tags($item->content), 90) }}
                </p>
            </div>
        </a>
        @endforeach

    </div>

    <div class="mt-6">
        {{ $berita->links() }}
    </div>

</div>

@endsection
