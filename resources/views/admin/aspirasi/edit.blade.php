@extends('layouts.admin')

@section('title', 'Edit Aspirasi')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-8 border-t-4 border-yellow-500 max-w-5xl mx-auto">
  <h2 class="text-2xl font-bold text-yellow-600 mb-6">Edit Aspirasi</h2>

  <form action="{{ route('admin.aspirasi.update', $aspirasi->id) }}"
        method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-5 text-gray-700">

      <div>
        <label class="font-semibold">Nama</label>
        <input type="text" name="name" value="{{ old('name', $aspirasi->name) }}"
               class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold">Email</label>
        <input type="text" name="email" value="{{ old('email', $aspirasi->email) }}"
               class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold">Telepon</label>
        <input type="text" name="telp" value="{{ old('telp', $aspirasi->telp) }}"
               class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold">Judul Aspirasi</label>
        <input type="text" name="judul" value="{{ old('judul', $aspirasi->judul) }}"
               class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold">Asal</label>
        <input type="text" name="asal" value="{{ old('asal', $aspirasi->asal) }}"
               class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold">Instansi Tujuan</label>
        <input type="text" name="instansi" value="{{ old('instansi', $aspirasi->instansi) }}"
               class="w-full border rounded-lg p-2 mt-1">
      </div>

      <div>
        <label class="font-semibold">Jenis Aspirasi</label>
        <div class="flex gap-4 mt-2">
          <label><input type="checkbox" name="is_anonymous" value="1"
            {{ $aspirasi->is_anonymous ? 'checked' : '' }}> Anonim</label>
          <label><input type="checkbox" name="is_secret" value="1"
            {{ $aspirasi->is_secret ? 'checked' : '' }}> Rahasia</label>
        </div>
      </div>

      <div class="md:col-span-2">
        <label class="font-semibold">Isi Aspirasi</label>
        <textarea name="isi" rows="4"
          class="w-full border rounded-lg p-2 mt-1">{{ old('isi', $aspirasi->isi) }}</textarea>
      </div>

      <div class="md:col-span-2">
        <label class="font-semibold">Lampiran (PDF)</label>
        <input type="file" name="lampiran" class="w-full border rounded-lg p-2 mt-2">

        @if($aspirasi->lampiran)
        <p class="mt-2">
          File sekarang:
          <a href="{{ asset($aspirasi->lampiran) }}" class="text-blue-600 underline" target="_blank">
            Lihat Lampiran
          </a>
        </p>
        @endif
      </div>

    </div>

    <div class="mt-8 flex justify-between">
      <button class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg shadow">
        Simpan Perubahan
      </button>

      <a href="{{ route('admin.aspirasi.show', $aspirasi->id) }}"
         class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
        Kembali
      </a>
    </div>

  </form>
</div>
@endsection
