@extends('layouts.admin')

@section('title', 'Data Pengaduan')

@section('content')

<div class="bg-white shadow-lg rounded-xl p-6 border-t-4 border-red-500">

  {{-- FILTER FORM --}}
  <form method="GET" action="{{ route('admin.pengaduan.index') }}" class="mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

      {{-- Keyword Search --}}
      <div>
        <label for="keyword" class="block text-sm font-semibold text-gray-700 mb-1">Kata Kunci</label>
        <input type="text" name="keyword" id="keyword" value="{{ request('keyword') }}"
          placeholder="Cari nama atau judul..."
          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
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

      {{-- Jenis --}}
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

      {{-- Status --}}
      <div>
        <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
        <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
          <option hidden value="">-- Status --</option>
          <option value="pending">Pending</option>
          <option value="verification">Verification</option>
          <option value="follow-up">Follow Up</option>
          <option value="feedback">Feedback</option>
          <option value="finish">Finish</option>
        </select>
      </div>

    </div>

    <div class="mt-4 flex justify-end space-x-2">
      <button type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">
        Filter
      </button>
      <a href="{{ route('admin.pengaduan.index') }}"
        class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg text-sm font-semibold">
        Reset
      </a>
    </div>
  </form>

  {{-- TABLE WRAPPER --}}
  <div class="relative">

    <div class="overflow-x-auto">
      <table class="min-w-full text-sm text-gray-700 border-collapse">
        <thead>
          <tr class="bg-red-600 text-white text-center">
            <th class="p-3 rounded-tl-lg">No</th>
            <th class="p-3">Nama</th>
            <th class="p-3">Judul</th>
            <th class="p-3">Jenis laporan</th>
            <th class="p-3">Status</th>
            <th class="p-3">Create At</th>
            <th class="p-3 rounded-tr-lg">Aksi</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
          @forelse ($pengaduans as $key => $item)
          <tr class="hover:bg-red-50 transition-colors duration-200">
            <td class="p-3 text-center font-medium">{{ $key + 1 }}</td>
            <td class="p-3 font-semibold">{{ $item->name }}</td>
            <td class="p-3">{{ $item->judul }}</td>

            {{-- Jenis --}}
            <td class="p-3 text-center">
              @if ($item->is_anonymous)
              <span class="px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Anonim</span>
              @elseif ($item->is_secret)
              <span class="px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Rahasia</span>
              @else
              <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">Biasa</span>
              @endif
            </td>

            <td class="p-3 text-center">{{ $item->status }}</td>
            <td class="p-3 text-center">{{ $item->created_at->format('d-m-Y') }}</td>

            {{-- ACTION BUTTON --}}
            <td class="p-3 text-center">
    <button onclick="toggleDropdown({{ $item->id }})"
        class="px-3 py-2 bg-gray-200 rounded-lg text-sm font-semibold shadow hover:bg-gray-300 transition">
        ⋮
    </button>

    {{-- DROPDOWN MENU --}}
    <div id="dropdown-{{ $item->id }}"
            class="dropdown-menu hidden fixed bg-white border border-gray-200 rounded-xl shadow-xl z-9999 w-48 overflow-hidden">

            {{-- DETAIL --}}
            <a href="{{ route('admin.pengaduan.show', $item->id) }}"
               class="flex items-center gap-2 px-4 py-3 text-gray-700 font-medium hover:bg-blue-500 hover:text-white transition">
                <i class="fa-solid fa-circle-info"></i><span>Detail</span>
            </a>
          
            {{-- EDIT --}}
            <a href="{{ route('admin.pengaduan.edit', $item->id) }}"
               class="flex items-center gap-2 px-4 py-3 text-gray-700 font-medium hover:bg-amber-400 hover:text-white transition">
                <i class="fa-solid fa-pen-to-square"></i><span>Edit</span>
            </a>
          
            {{-- HAPUS --}}
            <form action="{{ route('admin.pengaduan.destroy', $item->id) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="flex items-center gap-2 w-full text-left px-4 py-3 text-gray-700 font-medium hover:bg-red-500 hover:text-white transition">
                    <i class="fa-solid fa-trash"></i><span>Hapus</span>
                </button>
            </form>
          
        </div>
    </td>

          </tr>

          @empty
          <tr>
            <td colspan="13" class="p-5 text-center text-gray-500 italic">Belum ada data pengaduan.</td>
          </tr>
          @endforelse

        </tbody>
      </table>
    </div>

  </div>
</div>

@endsection


{{-- DROPDOWN SCRIPT FIX --}}
<script>
function toggleDropdown(id) {
  const el = document.getElementById("dropdown-" + id);
  const btn = event.target;

  // Tutup semua dropdown lain
  document.querySelectorAll('.dropdown-menu').forEach(d => {
      if (d !== el) d.classList.add('hidden');
  });

  // Toggle dropdown
  el.classList.toggle('hidden');

  if (!el.classList.contains('hidden')) {

      const rect = btn.getBoundingClientRect();

      el.style.top = (rect.bottom + 5) + "px";
      el.style.left = (rect.left - 120) + "px";
  }
}
</script>
