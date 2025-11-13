@extends('layouts.admin')

@section('title', 'Data Aspirasi')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-6 border-t-4 border-blue-500">

  {{-- 🔹 Filter Form --}}
  <form method="GET" action="{{ route('admin.aspirasi.index') }}" class="mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

      {{-- Keyword Search --}}
      <div>
        <label for="keyword" class="block text-sm font-semibold text-gray-700 mb-1">Kata Kunci</label>
        <input type="text" name="keyword" id="keyword" value="{{ request('keyword') }}"
                placeholder="Cari nama atau judul..."
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
      </div>

      {{-- Jenis Laporan --}}
      <div>
        <label for="jenis" class="block text-sm font-semibold text-gray-700 mb-1">Jenis Laporan</label>
        <select name="jenis" id="jenis"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
          <option value="">Semua</option>
          <option value="anonim" {{ request('jenis') == 'anonim' ? 'selected' : '' }}>Anonim</option>
          <option value="rahasia" {{ request('jenis') == 'rahasia' ? 'selected' : '' }}>Rahasia</option>
          <option value="biasa" {{ request('jenis') == 'biasa' ? 'selected' : '' }}>Biasa</option>
        </select>
      </div>

      {{-- Tanggal Awal --}}
      <div>
        <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Awal</label>
        <input type="date" name="start_date" id="start_date"
                value="{{ request('start_date') ?? now()->startOfMonth()->format('Y-m-d') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
      </div>

      {{-- Tanggal Akhir --}}
      <div>
        <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Akhir</label>
        <input type="date" name="end_date" id="end_date"
                value="{{ request('end_date') ?? now()->endOfMonth()->format('Y-m-d') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
      </div>
    </div>

    <div class="mt-4 flex justify-end space-x-2">
      <button type="submit"
              class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">
        Filter
      </button>
      <a href="{{ route('admin.aspirasi.index') }}"
          class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg text-sm font-semibold">
        Reset
      </a>
    </div>
  </form>

  {{-- 🔹 Table --}}
  <div class="overflow-x-auto">
    <table class="min-w-full text-sm text-gray-700 border-collapse">
      <thead>
        <tr class="bg-blue-600 text-white text-start">
          <th class="p-3 rounded-tl-lg">No</th>
          <th class="p-3">Nama</th>
          <th class="p-3">Judul</th>
          <th class="p-3">Jenis Laporan</th>
          <th class="p-3">Created At</th>
          <th class="p-3 rounded-tr-lg">Aksi</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-gray-200">
        @forelse ($aspirasis as $key => $item)
          <tr class="hover:bg-blue-50 transition-colors duration-200">
            <td class="p-3 text-center font-medium text-gray-800">{{ $loop->iteration }}</td>
            <td class="p-3">{{ $item->name ?? '-' }}</td>
            <td class="p-3 font-semibold">{{ $item->judul }}</td>
            <td class="p-3 text-center">
              @if ($item->is_anonymous)
                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Anonim</span>
              @elseif ($item->is_secret)
                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Rahasia</span>
              @else
                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">Biasa</span>
              @endif
            </td>
            <td class="p-3 text-center">{{ $item->created_at->format('d-m-Y') }}</td>

            <td class="p-3 text-center">
              <div class="flex justify-center space-x-2">
                <a href="{{ route('admin.aspirasi.show', $item->id) }}"
                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs font-semibold shadow-sm">Detail</a>
                <a href="#"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs font-semibold shadow-sm">Edit</a>
                <form action="#" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-semibold shadow-sm">
                    Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="p-5 text-center text-gray-500 italic">Belum ada data aspirasi.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
