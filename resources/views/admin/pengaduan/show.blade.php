@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-8 border-t-4 border-red-500 max-w-5xl mx-auto">
  <h2 class="text-2xl font-bold text-red-600 mb-6">Detail Pengaduan</h2>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-4 text-gray-700">
    <div>
      <p class="font-semibold text-gray-900">Nama Pengadu:</p>
      <p>{{ $pengaduan->name ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Email:</p>
      <p>{{ $pengaduan->email ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Nomor Telepon:</p>
      <p>{{ $pengaduan->telp ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Judul Pengaduan:</p>
      <p>{{ $pengaduan->judul ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Tanggal Pengaduan:</p>
      <p>{{ $pengaduan->tanggal_pengaduan ? \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->format('d M Y') : '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Lokasi:</p>
      <p>{{ $pengaduan->lokasi ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Instansi Tujuan:</p>
      <p>{{ $pengaduan->instansi ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Jenis Laporan:</p>
      <p>
        @if($pengaduan->is_anonymous)
          Anonim
        @elseif($pengaduan->is_secret)
          Rahasia
        @else
          Biasa
        @endif
      </p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Status:</p>
      <p>{{ $pengaduan->status }} </p>
    </div>

    <div class="md:col-span-2">
      <p class="font-semibold text-gray-900">Isi Pengaduan:</p>
      <p class="mt-1 whitespace-pre-line">{{ $pengaduan->isi ?? '-' }}</p>
    </div>

    @if($pengaduan->lampiran)
      <div class="md:col-span-2">
        <p class="font-semibold mb-3 text-gray-900">Lampiran:</p>
        <a href="{{ asset($pengaduan->lampiran) }}" target="_blank" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
          Lihat Lampiran
        </a>
      </div>
    @endif
  </div>

  <div class="mt-8 text-right">
    <a href="{{ route('admin.pengaduan.index') }}" 
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
      ← Kembali
    </a>
  </div>
</div>
@endsection
