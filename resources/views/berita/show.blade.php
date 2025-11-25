@extends('layouts.app')

@section('content')

<div class="w-full h-23 bg-cyan-300 relative -z-10"></div>

<div class="max-w-4xl mx-auto pt-30 py-10">

    {{-- Breadcrumb --}}
    <div class="text-sm mb-4 text-gray-500">
        <a href="{{ route('berita.index') }}" class="hover:text-blue-600">Berita</a> 
        <span class="mx-1">/</span>
        <span class="text-gray-700">{{ $berita->title }}</span>
    </div>

    {{-- Judul --}}
    <h1 class="text-4xl font-bold mb-3 leading-tight">
        {{ $berita->title }}
    </h1>

    {{-- Tanggal --}}
    <p class="text-gray-500 mb-6">
        Dipublikasikan: {{ $berita->created_at->format('d M Y') }}
    </p>

    {{-- Thumbnail --}}
    @if($berita->thumbnail)
        <div class="mb-8">
            <img src="{{ asset('storage/' . $berita->thumbnail) }}"
                 class="rounded-lg w-full max-h-[450px] object-cover shadow">
        </div>
    @endif

    {{-- Konten --}}
    <article class="prose prose-lg max-w-none prose-headings:font-bold prose-img:rounded-lg 
                   prose-img:shadow prose-a:text-blue-600 prose-a:no-underline hover:prose-a:underline
                   prose-ul:list-disc prose-ol:list-decimal prose-li:leading-relaxed">

        {!! $berita->content !!}

    </article>

</div>

@endsection
