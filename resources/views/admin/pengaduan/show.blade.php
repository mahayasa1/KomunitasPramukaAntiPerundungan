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
        <a href="{{ asset($pengaduan->lampiran) }}" target="_blank" class=" hover:bg-gray-500 text-gray-900 hover:text-white px-4 py-2 rounded-lg ">
          <i class="fa-solid fa-paperclip mr-2"></i> <span> Lihat Lampiran </span>
        </a>
      </div>
    @endif
  </div>

  <div class="mt-8 flex justify-between">

    {{-- Tombol Update Status --}}
    <form action="{{ route('admin.pengaduan.updateStatus', $pengaduan->id) }}" method="POST">
        @csrf
        <button type="submit"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">
          <i class="fa-solid fa-circle-arrow-up mr-2"></i> <span> Update Status </span>
        </button>
    </form>

    {{-- Kembali ke index --}}
    <a href="{{ route('admin.pengaduan.index') }}" 
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
      <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
    </a>

</div>
</div>
@endsection
