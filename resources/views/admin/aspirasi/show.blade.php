@extends('layouts.admin')

@section('title', 'Detail Aspirasi')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-8 border-t-4 border-blue-500 max-w-5xl mx-auto">
  <h2 class="text-2xl font-bold text-blue-600 mb-6">Detail Aspirasi</h2>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-4 text-gray-700">
    <div>
      <p class="font-semibold text-gray-900">Nama Pengusul:</p>
      <p>{{ $aspirasi->name ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Email:</p>
      <p>{{ $aspirasi->email ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Nomor Telepon:</p>
      <p>{{ $aspirasi->telp ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Judul Aspirasi:</p>
      <p>{{ $aspirasi->judul ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Asal Pengusul:</p>
      <p>{{ $aspirasi->asal ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Instansi Tujuan:</p>
      <p>{{ $aspirasi->instansi ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Jenis Laporan:</p>
      <p>
        @if($aspirasi->is_anonymous)
          Anonim
        @elseif($aspirasi->is_secret)
          Rahasia
        @else
          Biasa
        @endif
      </p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Status:</p>
      <p>{{ $aspirasi->status }} </p>
    </div>

    <div class="md:col-span-2">
      <p class="font-semibold text-gray-900">Isi Aspirasi:</p>
      <p class="mt-1 whitespace-pre-line">{{ $aspirasi->isi ?? '-' }}</p>
    </div>

    @if($aspirasi->lampiran)
      <div class="md:col-span-2">
        <p class="font-semibold mb-3 text-gray-900">Lampiran:</p>
        <a href="{{ asset($aspirasi->lampiran) }}" target="_blank" class=" hover:bg-gray-500 text-gray-900 hover:text-white px-4 py-2 rounded-lg ">
          <i class="fa-solid fa-paperclip mr-2"></i> <span> Lihat Lampiran </span>
        </a>
      </div>
    @endif
  </div>

  <div class="mt-8 flex justify-between">

    {{-- Tombol Update Status --}}
    <form id="updateStatusForm-{{ $aspirasi->id }}" action="{{ route('admin.aspirasi.updateStatus', $aspirasi->id) }}" method="POST">
        @csrf
        <button type="button"
            onclick="confirmUpdate({{ $aspirasi->id }})"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">
          <i class="fa-solid fa-circle-arrow-up mr-2"></i> <span> Update Status </span>
        </button>
    </form>

    {{-- Kembali ke index --}}
    <a href="{{ route('admin.aspirasi.index') }}" 
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
      <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
    </a>

</div>
</div>
@endsection

<script>
function confirmUpdate(id) {
    Swal.fire({
        title: 'Konfirmasi Update',
        text: "Apakah Anda yakin ingin mengupdate status aspirasi ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#4F46E5',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Update!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('updateStatusForm-' + id).submit();
        }
    });
}
</script>  