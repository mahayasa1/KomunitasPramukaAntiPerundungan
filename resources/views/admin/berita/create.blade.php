@extends('layouts.admin')

@section('content')

<!-- CKEditor CSS -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

<div class="flex w-full gap-6">

    {{-- LEFT AREA --}}
    <div class="flex-1 bg-white p-8 rounded shadow">

        <form id="formBerita" action="{{ route('admin.berita.store') }}" method="POST" name='upload' enctype="multipart/form-data">
            @csrf

            {{-- TITLE --}}
            <input 
                type="text" 
                name="title"
                placeholder="Tulis judul di sini..."
                class="w-full text-3xl font-bold mb-4 outline-none border-0 focus:ring-0 placeholder-gray-400"
            >

            {{-- CKEDITOR AREA --}}
            <textarea name="content" id="editor"></textarea>

    </div>

    {{-- RIGHT PANEL --}}
    <div class="w-80 bg-white p-6 rounded shadow">

        <h3 class="text-lg font-semibold mb-3">Informasi Berita</h3>

        {{-- THUMBNAIL --}}
        <label class="font-semibold text-sm">Thumbnail</label>
        <input type="file" name="thumbnail" class="w-full mb-4 block text-sm" accept="image/*">

        {{-- CHANNEL --}}
        {{-- <label class="font-semibold text-sm">Channel</label>
        <select name="channel" class="w-full p-2 border rounded mb-4 text-sm">
            <option value="">Pilih channel</option>
            <option value="news">News</option>
            <option value="event">Event</option>
        </select> --}}

        {{-- KEYWORD --}}
        {{-- <label class="font-semibold text-sm">Keyword</label>
        <input type="text" name="keyword" class="w-full p-2 border rounded mb-4 text-sm"> --}}

        {{-- DATE --}}
        {{-- <label class="font-semibold text-sm">Tanggal Publikasi</label>
        <input type="datetime-local" name="publish_at"
               class="w-full p-2 border rounded mb-4 text-sm"
               value="{{ now()->format('Y-m-d\TH:i') }}"> --}}

        <button type="submit" class="mt-4 w-full bg-blue-600 text-white py-2 rounded">
            Upload Berita
        </button>

        </form>
    </div>
</div>


{{-- CKEDITOR SCRIPT --}}
<script>
ClassicEditor.create(document.querySelector('#editor'), {
    ckfinder: {
        uploadUrl: "{{ route('admin.ckeditor.upload').'?_token='.csrf_token() }}"
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
        upload: {
            types: ['jpeg', 'jpg', 'png', 'gif', 'webp'] // hanya gambar ✔
        }
    }
})
.catch(error => {
    console.error(error);
});
</script>

@endsection
