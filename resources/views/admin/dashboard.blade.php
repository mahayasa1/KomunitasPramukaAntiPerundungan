@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
  {{--  MAIN CONTENT --}}
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

    {{-- Aspirasi --}}
    <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-blue-500 flex items-center justify-between hover:shadow-lg transition duration-300">
      <div>
        <h3 class="text-lg font-semibold text-blue-700 mb-2">Total Aspirasi</h3>
        <p class="text-4xl font-bold text-gray-800">{{ $totalAspirasi }}</p>
      </div>
      <div class="bg-blue-100 p-4 rounded-full">
        <i class="fa-solid fa-comments text-blue-600 text-4xl"></i>
      </div>
    </div>

    {{--  Pengaduan --}}
    <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-red-500 flex items-center justify-between hover:shadow-lg transition duration-300">
      <div>
        <h3 class="text-lg font-semibold text-red-700 mb-2">Total Pengaduan</h3>
        <p class="text-4xl font-bold text-gray-800">{{ $totalPengaduan }}</p>
      </div>
      <div class="bg-red-100 p-4 rounded-full">
        <i class="fa-solid fa-triangle-exclamation text-red-600 text-4xl"></i>
      </div>
    </div>

    {{--  Permintaan --}}
    <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-green-500 flex items-center justify-between hover:shadow-lg transition duration-300">
      <div>
        <h3 class="text-lg font-semibold text-green-700 mb-2">Total Permintaan</h3>
        <p class="text-4xl font-bold text-gray-800">{{ $totalPermintaan }}</p>
      </div>
      <div class="bg-green-100 p-4 rounded-full">
        <i class="fa-solid fa-bullhorn text-green-600 text-4xl"></i>
      </div>
    </div>

    {{--  Berita --}}
    <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-yellow-500 flex items-center justify-between hover:shadow-lg transition duration-300">
      <div>
        <h3 class="text-lg font-semibold text-yellow-700 mb-2">Total Berita</h3>
        <p class="text-4xl font-bold text-gray-800">{{ $totalBerita }}</p>
      </div>
      <div class="bg-yellow-100 p-4 rounded-full">
        <i class="fa-solid fa-newspaper text-yellow-600 text-4xl"></i>
      </div>
    </div>

  </div>
@endsection
