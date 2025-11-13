@extends('layouts.admin')

@section('title', 'Detail Permintaan')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-8 border-t-4 border-green-500 max-w-5xl mx-auto">
  <h2 class="text-2xl font-bold text-green-600 mb-6">Detail Permintaan</h2>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-4 text-gray-700">
    <div>
      <p class="font-semibold text-gray-900">Nama Pemohon:</p>
      <p>{{ $permintaan->name ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Email:</p>
      <p>{{ $permintaan->email ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Nomor Telepon:</p>
      <p>{{ $permintaan->telp ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Judul Permintaan:</p>
      <p>{{ $permintaan->judul ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Asal Pemohon:</p>
      <p>{{ $permintaan->asal ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Instansi Tujuan:</p>
      <p>{{ $permintaan->instansi ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Jenis Laporan:</p>
      <p>
        @if($permintaan->is_anonymous)
          Anonim
        @elseif($permintaan->is_secret)
          Rahasia
        @else
          Biasa
        @endif
      </p>
    </div>

    <div class="md:col-span-2">
      <p class="font-semibold text-gray-900">Isi Permintaan:</p>
      <p class="mt-1 whitespace-pre-line">{{ $permintaan->isi ?? '-' }}</p>
    </div>

    @if($permintaan->lampiran)
      <div class="md:col-span-2">
        <p class="font-semibold mb-3 text-gray-900">Lampiran:</p>
        <a href="{{ asset($permintaan->lampiran) }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
          Lihat Lampiran
        </a>
      </div>
    @endif
  </div>

  <div class="mt-8 text-right">
    <a href="{{ route('admin.permintaan.index') }}" 
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
      ← Kembali
    </a>
  </div>
</div>
@endsection
