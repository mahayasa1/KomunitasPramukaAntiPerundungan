@extends('layouts.admin')

@section('title', 'List Berita')

@section('content')

{{-- 🔶 CARD FILTER --}}
<div class="bg-white shadow-lg rounded-xl p-6 border-t-4 border-yellow-300 mb-6">
    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-800 rounded-lg">
        {{ session('success') }}
    </div>
@endif
    <form method="GET" action="{{ route('admin.berita.index') }}">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            {{-- Keyword Search --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Kata Kunci</label>
                <input type="text" name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="Cari judul berita..."
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
            </div>

            {{-- Tanggal Awal --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Awal</label>
                <input type="date" name="start_date"
                        value="{{ request('start_date') ?? now()->startOfMonth()->format('Y-m-d') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
            </div>

            {{-- Tanggal Akhir --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Akhir</label>
                <input type="date" name="end_date"
                        value="{{ request('end_date') ?? now()->endOfMonth()->format('Y-m-d') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
            </div>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end mt-4 gap-2">
            <button type="submit"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white text-sm hover:bg-blue-700 transition">
                Filter
            </button>

            <a href="{{ route('admin.berita.index') }}"
               class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 text-sm hover:bg-gray-300 transition">
                Reset
            </a>
        </div>
    </form>
</div>

{{-- 🔶 CARD TABEL BERITA --}}
<div class="bg-white shadow-lg rounded-xl p-6 border-t-4 border-yellow-300">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-700">List Berita</h2>
        <a href="{{ route('admin.berita.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm text-sm transition">
            + Tambah Berita
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 border-collapse overflow-hidden">
            <thead class="bg-yellow-500 text-white">
                <tr>
                    <th class="p-3 rounded-tl-lg">No</th>
                    <th class="p-3">Judul</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3 rounded-tr-lg">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($berita as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-3 text-center">{{ $loop->iteration }}</td>
                    <td class="p-3">{{ $item->title }}</td>
                    <td class="p-3 text-center">{{ $item->created_at->format('d M Y') }}</td>
                    <td class="p-3 text-center">
                        <div class="flex items-center justify-center gap-3">
                            {{-- DETAIL --}}
                            <a href="#"
                                class="p-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition"
                                title="Detail">
                                <i class="fa-solid fa-circle-info"></i>
                            </a>

                            {{-- EDIT --}}
                            <a href="{{ route('admin.berita.edit', $item->id) }}"
                                class="p-2 rounded-lg bg-amber-400 text-white hover:bg-amber-500 transition"
                                title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>

                            {{-- HAPUS --}}
                            <form action="{{ route('admin.berita.destroy', $item->id) }}" 
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
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $berita->links() }}
    </div>
</div>
{{-- 🔶 ALERT POPUP MODAL --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text: "{{ session('success') }}",
        timer: 2500,
        showConfirmButton: false,
    });
</script>
@endif

@if($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan!',
        html: `
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        `,
        showConfirmButton: true,
    });
</script>
@endif


@endsection
