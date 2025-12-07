@extends('layouts.admin')

@section('title', 'Detail Permintaan')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-8 border-t-4 border-green-500 max-w-5xl mx-auto">
  <h2 class="text-2xl font-bold text-green-600 mb-6">Detail Permintaan</h2>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-4 text-gray-700">
    <div>
      <p class="font-semibold text-gray-900">Nama Pemohon:</p>
      <p>{{ $permintaan->name ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Email:</p>
      <p>{{ $permintaan->email ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Nomor Telepon:</p>
      <p>{{ $permintaan->telp ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Judul Permintaan:</p>
      <p>{{ $permintaan->judul ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Asal Pemohon:</p>
      <p>{{ $permintaan->asal ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Instansi Tujuan:</p>
      <p>{{ $permintaan->instansi ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Jenis Laporan:</p>
      <p>
        @if($permintaan->is_anonymous)
          Anonim
        @elseif($permintaan->is_secret)
          Rahasia
        @else
          Biasa
        @endif
      </p>
    </div>

    <div>
      <p class="font-semibold text-gray-900">Status:</p>
      <p>{{ $permintaan->status }} </p>
    </div>

    <div class="md:col-span-2">
      <p class="font-semibold text-gray-900">Isi Permintaan:</p>
      <p class="mt-1 whitespace-pre-line">{{ $permintaan->isi ?? '-' }}</p>
    </div>

     @if($permintaan->lampiran)
      <div class="md:col-span-2">
        <p class="font-semibold mb-3 text-gray-900">Lampiran:</p>
        <a href="{{ asset($permintaan->lampiran) }}" target="_blank" class=" hover:bg-gray-500 text-gray-900 hover:text-white px-4 py-2 rounded-lg ">
          <i class="fa-solid fa-paperclip mr-2"></i> <span> Lihat Lampiran </span>
        </a>
      </div>
    @endif
  </div>

  <div class="mt-8 flex justify-between">

    {{-- Tombol Update Status --}}
    <form action="{{ route('admin.permintaan.updateStatus', $permintaan->id) }}" method="POST">
        @csrf
        <button type="submit"
            onclick="confirmUpdate({{ $permintaan->id }})"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">
          <i class="fa-solid fa-circle-arrow-up mr-2"></i> <span> Update Status </span>
      </button>
    </form>

    {{-- Kembali ke index --}}
    <a href="{{ route('admin.permintaan.index') }}" 
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
      <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
    </a>

</div>
</div>
@endsection

<script>
function confirmUpdate(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Status permintaan akan diperbarui.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, perbarui!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('updateStatusForm-' + id).submit();
        }
    });
}
</script>