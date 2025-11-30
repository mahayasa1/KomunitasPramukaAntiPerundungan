@extends('layouts.admin')

@section('title', 'Data Aspirasi')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-6 border-t-4 border-blue-500 mb-6">

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-800 rounded-lg">
        {{ session('success') }}
    </div>
@endif

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

      <div>
        <label for="status" class="block text-sm font-semibold text-gray-700 mb-1"> Status </label>
        <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
            <option hidden value="">-- Status --</option>
            <option value="pending"      {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
            <option value="verification" {{ request('status')=='verification' ? 'selected' : '' }}>Verification</option>
            <option value="follow-up"    {{ request('status')=='follow-up' ? 'selected' : '' }}>Follow Up</option>
            <option value="feedback"     {{ request('status')=='feedback' ? 'selected' : '' }}>Feedback</option>
            <option value="finish"       {{ request('status')=='finish' ? 'selected' : '' }}>Finish</option>
        </select>
      </div>
    </div>
    <div class="mt-4 flex justify-end space-x-2">
      <button type="submit"
              class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">
        Filter
      </button>
      <a href="{{ route('admin.permintaan.index') }}"
          class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg text-sm font-semibold">
        Reset
      </a>
    </div>
  </form>
</div>

<div class="bg-white shadow-lg rounded-xl p-6 border-t-4 border-blue-500">
  {{-- 🔹 Table --}}
  <div class="overflow-x-auto">
    <table class="min-w-full text-sm text-gray-700 border-collapse">
      <thead>
        <tr class="bg-blue-600 text-white text-start">
          <th class="p-3 rounded-tl-lg">No</th>
          <th class="p-3">Nama</th>
          <th class="p-3">Judul</th>
          <th class="p-3">Jenis Laporan</th>
          <th class="p-3">Status</th>
          <th class="p-3">Create At</th>
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
            <td class="p-3 text-center">{{ $item->status }}</td>
            <td class="p-3 text-center">{{ $item->created_at->format('d-m-Y') }}</td>

              <td class="p-3 text-center">
              <div class="flex items-center justify-center gap-3">
                  {{-- DETAIL --}}
                  <a href="{{ route('admin.aspirasi.show', $item->id) }}"
                      class="p-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition"
                      title="Detail">
                      <i class="fa-solid fa-circle-info"></i>
                  </a>
                
                  {{-- EDIT --}}
                  <a href="{{ route('admin.aspirasi.edit', $item->id) }}"
                      class="p-2 rounded-lg bg-amber-400 text-white hover:bg-amber-500 transition"
                      title="Edit">
                      <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                
                  {{-- HAPUS --}}
                  <form action="{{ route('admin.aspirasi.destroy', $item->id) }}" 
                        method="POST" 
                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                          class="p-2 rounded-lg bg-red-500 text-white hover:bg-red-600 transition"
                          title="Hapus">
                          <i class="fa-solid fa-trash"></i>
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
