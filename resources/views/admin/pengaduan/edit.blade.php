@extends('layouts.admin')

@section('title', 'Edit Pengaduan')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-8 border-t-4 border-blue-500 max-w-5xl mx-auto">
  <h2 class="text-2xl font-bold text-blue-600 mb-6">Edit Pengaduan</h2>

  <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" 
        method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-5 text-gray-700">

      <div>
        <label class="font-semibold text-gray-900">Nama Pengadu</label>
        <input type="text" name="name" value="{{ old('name', $pengaduan->name) }}"
          class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold text-gray-900">Email</label>
        <input type="text" name="email" value="{{ old('email', $pengaduan->email) }}"
          class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold text-gray-900">Nomor Telepon</label>
        <input type="text" name="telp" value="{{ old('telp', $pengaduan->telp) }}"
          class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold text-gray-900">Judul Pengaduan</label>
        <input type="text" name="judul" value="{{ old('judul', $pengaduan->judul) }}"
          class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold text-gray-900">Tanggal Pengaduan</label>
        <input type="date" name="tanggal_pengaduan"
               value="{{ old('tanggal_pengaduan', $pengaduan->tanggal_pengaduan) }}"
          class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold text-gray-900">Lokasi</label>
        <input type="text" name="lokasi" value="{{ old('lokasi', $pengaduan->lokasi) }}"
          class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold text-gray-900">Instansi Tujuan</label>
        <input type="text" name="instansi" value="{{ old('instansi', $pengaduan->instansi) }}"
          class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold text-gray-900">Jenis Laporan</label>
        <div class="flex items-center gap-4 mt-2">
          <label><input type="checkbox" name="is_anonymous" value="1" 
            {{ $pengaduan->is_anonymous ? 'checked' : '' }}> Anonim</label>

          <label><input type="checkbox" name="is_secret" value="1" 
            {{ $pengaduan->is_secret ? 'checked' : '' }}> Rahasia</label>
        </div>
      </div>

      <div class="md:col-span-2">
        <label class="font-semibold text-gray-900">Isi Pengaduan</label>
        <textarea name="isi" rows="5"
          class="w-full border rounded-lg p-3 mt-1">{{ old('isi', $pengaduan->isi) }}</textarea>
      </div>

      <div class="md:col-span-2">
        <label class="font-semibold text-gray-900">Lampiran (PDF)</label>
        <input type="file" name="lampiran" class="w-full border p-2 rounded-lg mt-2">

        @if($pengaduan->lampiran)
          <p class="mt-2">
            File sekarang:
            <a href="{{ asset($pengaduan->lampiran) }}" target="_blank" class="text-blue-600 underline">
              Lihat Lampiran
            </a>
          </p>
        @endif
      </div>

    </div>

    <div class="mt-8 flex justify-between">
      <button type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
        <i class="fa-solid fa-save mr-2"></i> Simpan Perubahan
      </button>

      <a href="{{ route('admin.pengaduan.show', $pengaduan->id) }}"
         class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
        <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
      </a>
    </div>

  </form>
</div>
@endsection
