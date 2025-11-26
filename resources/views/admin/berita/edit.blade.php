@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

<form id="formBerita" 
      action="{{ route('admin.berita.update', $berita->id) }}" 
      method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="w-full flex flex-col gap-6">

        {{-- CARD THUMBNAIL --}}
        <div class="bg-white p-8 rounded-xl shadow">
            <label class="font-semibold text-sm mb-2 block">Thumbnail</label>
            <input 
                type="file" 
                name="thumbnail" 
                class="w-full block text-sm border p-2 rounded mb-3"
                accept="image/*"
            >

            {{-- THUMBNAIL PREVIEW --}}
            <p class="text-xs text-gray-500 mb-2">Thumbnail saat ini:</p>
            <img src="{{ $berita->thumbnail 
                ? asset('storage/' . $berita->thumbnail)
                : asset('asset/bg-aduan.jpg') }}"
                class="w-48 h-32 object-cover rounded shadow">
        </div>

        {{-- CARD EDITOR --}}
        <div class="bg-white p-8 rounded-xl shadow">
            <input 
                type="text" 
                name="title"
                value="{{ old('title', $berita->title) }}"
                placeholder="Judul berita..."
                class="w-full text-3xl font-bold mb-5 outline-none border-0 focus:ring-0"
            >
            <textarea name="content" id="editor">{!! old('content', $berita->content) !!}</textarea>

            <button type="submit" 
                    class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                Perbarui Berita
            </button>
        </div>

    </div>
</form>

<script>
ClassicEditor.create(document.querySelector('#editor'), {
    ckfinder: { uploadUrl: "{{ route('admin.ckeditor.upload').'?&_token='.csrf_token() }}" }
});
</script>


@endsection
