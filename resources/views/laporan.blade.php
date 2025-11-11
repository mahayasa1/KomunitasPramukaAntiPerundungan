@extends('layouts.app')

@section('title', 'Layanan Aspirasi dan Pengaduan')

@section('content')
<div class="bg-cyan-600 text-white py-10 text-center shadow">
    <h1 class="text-3xl font-bold">Layanan Aspirasi dan Pengaduan</h1>
    <p class="text-wihte mt-2">Sampaikan laporan Anda langsung kepada Kami</p>
</div>

<div class="max-w-4xl mx-auto bg-white mt-10 p-8 rounded-2xl shadow" x-data="{ tab: 'pengaduan' }">

    <div class="flex justify-center space-x-4 mb-6">
        <button @click="tab='pengaduan'" :class="tab==='pengaduan' ? 'bg-cyan-500 text-white' : 'bg-gray-200 text-gray-700'" class="px-4 py-2 rounded-lg font-semibold">Pengaduan</button>
        <button @click="tab='aspirasi'" :class="tab==='aspirasi' ? 'bg-cyan-500 text-white' : 'bg-gray-200 text-gray-700'" class="px-4 py-2 rounded-lg font-semibold">Aspirasi</button>
        <button @click="tab='permintaan'" :class="tab==='permintaan' ? 'bg-cyan-500 text-white' : 'bg-gray-200 text-gray-700'" class="px-4 py-2 rounded-lg font-semibold">Permintaan Informasi</button>
    </div>

    @if(session('success'))
        <div class="p-3 bg-green-100 text-green-800 rounded mb-4">{{ session('success') }}</div>
    @endif

    {{-- PENGADUAN --}}
    <div x-show="tab==='pengaduan'">
        @include('partials.pengaduan')
        {{-- <ul class="space-y-2">
            @foreach($pengaduans as $p)
                <li class="p-3 border rounded bg-cyan-50">
                    <strong>{{ $p->judul }}</strong> - {{ $p->lokasi }} ({{ $p->tanggal_pengaduan }})<br>
                    <span class="text-gray-700">{{ $p->isi }}</span>
                </li>
            @endforeach
        </ul> --}}
    </div>

    {{-- ASPIRASI --}}
    <div x-show="tab==='aspirasi'">
        @include('partials.aspirasi')
        {{-- <ul class="space-y-2">
            @foreach($aspirasis as $a)
                <li class="p-3 border rounded bg-cyan-50">
                    <strong>{{ $a->judul }}</strong> - {{ $a->asal }}<br>
                    <span class="text-gray-700">{{ $a->isi }}</span>
                </li>
            @endforeach
        </ul> --}}
    </div>

    {{-- PERMINTAAN --}}
    <div x-show="tab==='permintaan'">
        @include('partials.permintaan')
        {{-- <ul class="space-y-2">
            @foreach($permintaans as $pm)
                <li class="p-3 border rounded bg-cyan-50">
                    <strong>{{ $pm->judul }}</strong> - {{ $pm->asal }}<br>
                    <span class="text-gray-700">{{ $pm->isi }}</span>
                </li>
            @endforeach
        </ul> --}}
    </div>
</div>
@endsection
