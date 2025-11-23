@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

<div class="w-full flex flex-col lg:flex-row gap-6">

    {{-- EDITOR AREA --}}
    <div class="flex-1 bg-white p-8 rounded-xl shadow">
        <form id="formBerita" action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- JUDUL --}}
            <input 
                type="text" 
                name="title"
                placeholder="Judul berita..."
                class="w-full text-3xl font-bold mb-5 outline-none border-0 focus:ring-0 placeholder-gray-400"
            >

            {{-- CKEDITOR --}}
            <textarea name="content" id="editor"></textarea>

            {{-- THUMBNAIL --}}
            <label class="font-semibold text-sm mt-4 block">Thumbnail</label>
            <input 
                type="file" 
                name="thumbnail" 
                class="w-full mb-4 block text-sm border p-2 rounded"
                accept="image/*"
            >

            <button type="submit" 
                    class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                Upload Berita
            </button>
        </form>
    </div>

</div>

{{-- CKEDITOR SCRIPT --}}
<script>
ClassicEditor.create(document.querySelector('#editor'), {
    ckfinder: {
        uploadUrl: "{{ route('admin.ckeditor.upload').'?&_token='.csrf_token() }}"
    },
    toolbar: [
        'undo', 'redo', '|',
        'heading', '|',
        'bold', 'italic', 'underline', '|',
        'link', 'blockQuote', 'code', '|',
        'bulletedList', 'numberedList', '|',
        'alignment:left', 'alignment:center', 'alignment:right', 
        '|', 'insertImage'
    ],
    image: {
        toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side'],
        upload: { types: ['jpeg', 'jpg', 'png', 'gif', 'webp'] }
    }
})
.catch(error => {
    console.error(error);
});
</script>

{{-- Alpine.js: Sidebar langsung tertutup saat halaman load --}}
<script>
document.addEventListener('alpine:init', () => {
    Alpine.store('sidebar', {
        sidebarOpen: false
    });
});
</script>

@endsection
