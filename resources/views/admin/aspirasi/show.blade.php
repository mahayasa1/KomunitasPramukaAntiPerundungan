@extends('layouts.admin')

@section('title', 'Detail Aspirasi')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-8 border-t-4 border-blue-500 max-w-5xl mx-auto">
  <h2 class="text-2xl font-bold text-blue-600 mb-6">Detail Aspirasi</h2>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-4 text-gray-700">
    <div>
      <p class="font-semibold text-gray-900">Nama Pengusul:</p>
      <p>{{ $aspirasi->name ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Email:</p>
      <p>{{ $aspirasi->email ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Nomor Telepon:</p>
      <p>{{ $aspirasi->telp ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Judul Aspirasi:</p>
      <p>{{ $aspirasi->judul ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Asal Pengusul:</p>
      <p>{{ $aspirasi->asal ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Instansi Tujuan:</p>
      <p>{{ $aspirasi->instansi ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Jenis Laporan:</p>
      <p>
        @if($aspirasi->is_anonymous)
          Anonim
        @elseif($aspirasi->is_secret)
          Rahasia
        @else
          Biasa
        @endif
      </p>
    </div>

    <div class="md:col-span-2">
      <p class="font-semibold text-gray-900">Isi Aspirasi:</p>
      <p class="mt-1 whitespace-pre-line">{{ $aspirasi->isi ?? '-' }}</p>
    </div>

    @if($aspirasi->lampiran)
      <div class="md:col-span-2">
        <p class="font-semibold mb-3 text-gray-900">Lampiran:</p>
        <a href="{{ asset($aspirasi->lampiran) }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg ">
          Lihat Lampiran
        </a>
      </div>
    @endif
  </div>

  <div class="mt-8 text-right">
    <a href="{{ route('admin.aspirasi.index') }}" 
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
      ← Kembali
    </a>
  </div>
</div>
@endsection
