@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

<div class="w-full flex flex-col gap-6">

    {{-- CARD THUMBNAIL --}}
    <div class="bg-white p-8 rounded-xl shadow">
        <form id="formBerita" action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="font-semibold text-sm mb-2 block">Thumbnail</label>
            <input 
                type="file" 
                name="thumbnail" 
                class="w-full block text-sm border p-2 rounded"
                accept="image/*"
            >
    </div>

    {{-- CARD EDITOR --}}
    <div class="bg-white p-8 rounded-xl shadow">
            <input 
                type="text" 
                name="title"
                placeholder="Judul berita..."
                class="w-full text-3xl font-bold mb-5 outline-none border-0 focus:ring-0 placeholder-gray-400"
            >
            <textarea name="content" id="editor"></textarea>

            <button type="submit" 
                    class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                Upload Berita
            </button>
        </form>
    </div>

</div>

{{-- CKEDITOR --}}
<script>
ClassicEditor.create(document.querySelector('#editor'), {
    ckfinder: { uploadUrl: "{{ route('admin.ckeditor.upload').'?&_token='.csrf_token() }}" }
});
</script>
@endsection
