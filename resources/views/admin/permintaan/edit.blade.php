@extends('layouts.admin')

@section('title', 'Edit Permintaan')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-8 border-t-4 border-green-500 max-w-5xl mx-auto">
  <h2 class="text-2xl font-bold text-green-600 mb-6">Edit Permintaan Informasi</h2>

  <form action="{{ route('admin.permintaan.update', $permintaan->id) }}"
        method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-5 text-gray-700">

      <div>
        <label class="font-semibold">Nama Pemohon</label>
        <input type="text" name="name" value="{{ old('name', $permintaan->name) }}"
               class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold">Email</label>
        <input type="text" name="email" value="{{ old('email', $permintaan->email) }}"
               class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold">Telepon</label>
        <input type="text" name="telp" value="{{ old('telp', $permintaan->telp) }}"
               class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold">Judul Permintaan</label>
        <input type="text" name="judul" value="{{ old('judul', $permintaan->judul) }}"
               class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold">Asal Pemohon</label>
        <input type="text" name="asal" value="{{ old('asal', $permintaan->asal) }}"
               class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold">Instansi Tujuan</label>
        <input type="text" name="instansi" value="{{ old('instansi', $permintaan->instansi) }}"
               class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold">Jenis Permintaan</label>
        <div class="flex gap-4 mt-2">
          <label><input type="checkbox" name="is_anonymous" value="1"
            {{ $permintaan->is_anonymous ? 'checked' : '' }}> Anonim</label>
          <label><input type="checkbox" name="is_secret" value="1"
            {{ $permintaan->is_secret ? 'checked' : '' }}> Rahasia</label>
        </div>
      </div>

      <div class="md:col-span-2">
        <label class="font-semibold">Isi Permintaan</label>
        <textarea name="isi" rows="4"
          class="w-full border rounded-lg p-2 mt-1">{{ old('isi', $permintaan->isi) }}</textarea>
      </div>

      <div class="md:col-span-2">
        <label class="font-semibold">Lampiran (PDF)</label>
        <input type="file" name="lampiran" class="w-full border rounded-lg p-2 mt-1">

        @if($permintaan->lampiran)
        <p class="mt-2">
          File sekarang:
          <a href="{{ asset($permintaan->lampiran) }}" class="text-blue-600 underline" target="_blank">
            Lihat Lampiran
          </a>
        </p>
        @endif
      </div>

    </div>

    <div class="mt-8 flex justify-between">
      <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
        Simpan Perubahan
      </button>

      <a href="{{ route('admin.permintaan.show', $permintaan->id) }}"
         class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
        Kembali
      </a>
    </div>

  </form>
</div>
@endsection
