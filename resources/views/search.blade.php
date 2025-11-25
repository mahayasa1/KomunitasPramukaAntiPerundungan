@extends('layouts.app')

@section('title', 'Cari Laporan')

@section('content')

<div class="w-full h-23 bg-cyan-300 relative -z-10"></div>

<div class="pt-10 max-w-5xl mx-auto px-6 mb-20">

    <h1 class="text-3xl font-bold text-cyan-600 mb-8 text-center">
        Cek Status Laporan Anda
    </h1>

    {{-- FORM CARI --}}
    <form action="{{ route('search.find') }}" method="POST" class="bg-white shadow-md rounded-xl p-6 mb-10">
        @csrf

        {{-- EMAIL --}}
        <label class="block font-semibold mb-2">Masukkan Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required
               class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-cyan-500">

        @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror

        {{-- TELP --}}
        <label class="block font-semibold mt-4 mb-2">Masukkan No. Telepon</label>
        <input type="text" name="telp" value="{{ old('telp') }}" required
               class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-cyan-500">

        @error('telp')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror

        <button class="mt-5 bg-cyan-600 text-white px-6 py-2 rounded-lg hover:bg-cyan-700 transition">
            Cari Laporan
        </button>
        <a href="{{ route('index') }}" class="mt-5 bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">
            Kembali
        </a>
    </form>

    {{-- JIKA TIDAK DITEMUKAN --}}
    @isset($not_found)
        <div class="bg-red-100 text-red-600 border border-red-300 p-4 rounded-lg">
            Tidak ada laporan ditemukan dengan email & nomor telepon tersebut.
        </div>
    @endisset



    {{-- ============================ --}}
    {{--   TABEL HASIL PENCARIAN     --}}
    {{-- ============================ --}}
    @isset($results)

    <h2 class="text-xl font-bold mb-4">Hasil Pencarian:</h2>

    <table class="w-full bg-white shadow-lg rounded-lg overflow-hidden mb-10">
        <thead class="bg-cyan-600 text-white">
            <tr>
                <th class="p-3">No</th>
                <th class="p-3">Email</th>
                <th class="p-3">Telp</th>
                <th class="p-3">Judul</th>
                <th class="p-3">Kategori</th>
                <th class="p-3">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($results as $i => $row)
                @php $d = $row['data']; @endphp
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 text-center">{{ $i+1 }}</td>
                    <td class="p-3 text-center">{{ $d->email }}</td>
                    <td class="p-3 text-center">{{ $d->telp }}</td>
                    <td class="p-3 text-center">{{ $d->judul }}</td>
                    <td class="p-3 text-center uppercase">{{ $row['type'] }}</td>

                    <td class="p-3 text-center">
                        <a href="{{ route('search.detail', [$row['type'], $d->id]) }}"
                           class="bg-cyan-600 text-white px-4 py-2 rounded-lg hover:bg-cyan-700">
                            Lihat Status
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @endisset




    {{-- ============================ --}}
    {{--        DETAIL LAPORAN        --}}
    {{-- ============================ --}}
    @isset($laporan)

    <div class="bg-white shadow-lg p-8 rounded-xl mt-14">

        <h2 class="text-2xl font-bold mb-6 text-cyan-600">Detail Laporan</h2>

        <div class="space-y-2 mb-6">
            <p><strong>Jenis Laporan:</strong> {{ $jenis }}</p>
            <p><strong>Nama:</strong> {{ $laporan->name }}</p>
            <p><strong>Email:</strong> {{ $laporan->email }}</p>
            <p><strong>Telp:</strong> {{ $laporan->telp }}</p>
            <p><strong>Judul:</strong> {{ $laporan->judul }}</p>

            @if(isset($laporan->isi))
                <p><strong>Isi:</strong> {{ $laporan->isi }}</p>
            @endif

            <p>
                <strong>Status:</strong>
                <span class="uppercase text-cyan-700 font-semibold">
                    {{ $laporan->status }}
                </span>
            </p>
        </div>

        @php
            $step = [
                'pending' => 1,
                'verification' => 2,
                'follow-up' => 3,
                'feedback' => 4,
                'finish' => 5,
            ];
            $current = $step[$laporan->status] ?? 1;
        @endphp


        {{-- ============================ --}}
        {{--         PROGRESS BAR         --}}
        {{-- ============================ --}}
        <div class="relative flex justify-between items-center mt-10">

            <div class="absolute top-1/2 left-5 right-5 border-b border-gray-300 
                -translate-y-1/2 z-0"></div>

            {{-- STEP 1 --}}
            <div class="flex flex-col items-center">
                <div class="w-14 h-14 rounded-full flex items-center justify-center shadow relative z-10
                    {{ $current >= 1 ? 'bg-cyan-600 text-white' : 'bg-gray-200 text-gray-400' }}">
                    <i class="fa-solid fa-hourglass-start"></i>
                </div>
                <p class="font-semibold mt-3">Pending</p>
            </div>

            {{-- STEP 2 --}}
            <div class="flex flex-col items-center">
                <div class="w-14 h-14 rounded-full flex items-center justify-center shadow relative z-10
                    {{ $current >= 2 ? 'bg-cyan-600 text-white' : 'bg-gray-200 text-gray-400' }}">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <p class="font-semibold mt-3">Verifikasi</p>
            </div>

            {{-- STEP 3 --}}
            <div class="flex flex-col items-center">
                <div class="w-14 h-14 rounded-full flex items-center justify-center shadow relative z-10
                    {{ $current >= 3 ? 'bg-cyan-600 text-white' : 'bg-gray-200 text-gray-400' }}">
                    <i class="fa-solid fa-share"></i>
                </div>
                <p class="font-semibold mt-3">Tindak Lanjut</p>
            </div>

            {{-- STEP 4 --}}
            <div class="flex flex-col items-center">
                <div class="w-14 h-14 rounded-full flex items-center justify-center shadow relative z-10
                    {{ $current >= 4 ? 'bg-cyan-600 text-white' : 'bg-gray-200 text-gray-400' }}">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <p class="font-semibold mt-3">Feedback</p>
            </div>

            {{-- STEP 5 --}}
            <div class="flex flex-col items-center">
                <div class="w-14 h-14 rounded-full flex items-center justify-center shadow relative z-10
                    {{ $current >= 5 ? 'bg-cyan-600 text-white' : 'bg-gray-200 text-gray-400' }}">
                    <i class="fa-solid fa-check"></i>
                </div>
                <p class="font-semibold mt-3">Selesai</p>
            </div>

        </div>

    </div>

    @endisset

</div>

@endsection
