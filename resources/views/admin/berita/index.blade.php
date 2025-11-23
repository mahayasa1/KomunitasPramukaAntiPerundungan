@extends('layouts.admin')

@section('content')
<div class="p-6">

    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">List Berita</h2>
        <a href="{{ route('admin.berita.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah</a>
    </div>

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Judul</th>
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($berita as $item)
            <tr>
                <td class="p-2 border">{{ $item->title }}</td>
                <td class="p-2 border">{{ $item->created_at->format('d M Y') }}</td>
                <td class="p-2 border">
                    <a href="{{ route('admin.berita.edit', $item->id) }}" class="text-blue-600">Edit</a> |
                    <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus berita?')" class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $berita->links() }}
    </div>

</div>
@endsection
