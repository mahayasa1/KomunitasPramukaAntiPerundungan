@extends('layouts.app')

@section('title', 'Layanan Aspirasi dan Pengaduan')

@section('content')
{{-- 🟦 HERO SECTION --}}
<section 
  class="relative text-white flex flex-col justify-center items-center text-center shadow-lg overflow-hidden min-h-screen"
  style="
    background-image: url('{{ asset('asset/bg-aduan.jpg') }}');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
  "
>
  {{-- Overlay transparan biru --}}
  <div class="absolute inset-0 bg-cyan-500 opacity-30"></div>
  {{-- Gradasi agar teks lebih terbaca --}}
  <div class="absolute inset-0 bg-linear-to-b from-black/30 via-transparent to-black/40"></div>

  {{-- Konten utama --}}
  <div class="relative z-10 px-6">
    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight drop-shadow-lg">
      Layanan Aspirasi dan Pengaduan Online Rakyat
    </h1>
    <p class="mt-4 text-lg md:text-xl text-gray-100 drop-shadow">
      Sampaikan laporan Anda langsung kepada Kami
    </p>
    <div class="w-24 h-1 bg-white mx-auto mt-6 rounded-full"></div>

    {{-- Tombol Mulai --}}
    <div class="mt-12 flex justify-center">
      <a 
        href="#formSection"
        class="inline-flex items-center gap-3 bg-white text-cyan-700 font-semibold text-lg px-8 py-3 rounded-full shadow-lg hover:bg-cyan-100 hover:shadow-xl transition-all duration-300 group"
      >
        <span>Mulai</span>
        <svg xmlns="http://www.w3.org/2000/svg" 
             fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" 
             class="w-6 h-6 animate-bounce-slow group-hover:translate-y-1 transition-transform duration-300">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
      </a>
    </div>
  </div>
</section>


{{-- 💠 FORM SECTION --}}
<section 
  id="formSection" 
  class="relative py-24 bg-linear-to-b from-cyan-100 via-white to-cyan-50 scroll-mt-24 overflow-hidden"
>
  {{-- Pola dots lembut --}}
  <div 
    class="absolute inset-0 opacity-30 bg-[radial-linear(circle_at_1px_1px,_#a5f3fc_1px, transparent_1px)] [bg-size:22px_22px]"
  ></div>

  {{-- Efek neon glow --}}
  <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none">
    <div class="w-[600px] h-[600px] bg-cyan-300/30 blur-[130px] rounded-full absolute -top-40 -left-60 animate-pulse-slow"></div>
    <div class="w-[550px] h-[550px] bg-pink-300/30 blur-[150px] rounded-full absolute top-20 right-0 animate-pulse-slow delay-500"></div>
  </div>

  {{-- FORM UTAMA --}}
  <div 
    class="relative z-10 max-w-4xl mx-auto bg-white/90 backdrop-blur-md p-10 rounded-3xl shadow-2xl border border-white/40"
    x-data="{ tab: 'pengaduan' }"
  >
    {{-- Tabs --}}
    <div class="flex justify-center flex-wrap gap-3 mb-8">
      <button 
        @click="tab='pengaduan'" 
        :class="tab==='pengaduan' ? 'bg-cyan-600 text-white shadow-lg shadow-cyan-300/40' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'" 
        class="px-5 py-2 rounded-lg font-semibold transition-all duration-200">
        Pengaduan
      </button>
      <button 
        @click="tab='aspirasi'" 
        :class="tab==='aspirasi' ? 'bg-cyan-600 text-white shadow-lg shadow-cyan-300/40' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'" 
        class="px-5 py-2 rounded-lg font-semibold transition-all duration-200">
        Aspirasi
      </button>
      <button 
        @click="tab='permintaan'" 
        :class="tab==='permintaan' ? 'bg-cyan-600 text-white shadow-lg shadow-cyan-300/40' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'" 
        class="px-5 py-2 rounded-lg font-semibold transition-all duration-200">
        Permintaan Informasi
      </button>
    </div>

    {{-- Tab contents --}}
    <div x-show="tab==='pengaduan'" x-cloak>
      @include('partials.pengaduan')
    </div>

    <div x-show="tab==='aspirasi'" x-cloak>
      @include('partials.aspirasi')
    </div>

    <div x-show="tab==='permintaan'" x-cloak>
      @include('partials.permintaan')
    </div>
  </div>
</section>

{{-- ✅ FLASH POPUP --}}
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: '{{ session('success') }}',
      confirmButtonColor: '#06b6d4',
      confirmButtonText: 'OK',
    }).then(() => {
      // Reload tapi tidak scroll ke atas
      const scrollPos = window.scrollY;
      location.reload();
      setTimeout(() => window.scrollTo(0, scrollPos), 100);
    });
  });
</script>
@endif

{{-- Smooth scroll --}}
<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) target.scrollIntoView({ behavior: 'smooth' });
      });
    });
  });
</script>

{{-- 🔹 Animasi custom --}}
<style>
  @keyframes bounce-slow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(6px); }
  }
  .animate-bounce-slow { animation: bounce-slow 1.8s infinite; }

  @keyframes pulse-slow {
    0%, 100% { opacity: 0.4; transform: scale(1); }
    50% { opacity: 0.7; transform: scale(1.05); }
  }
  .animate-pulse-slow { animation: pulse-slow 6s ease-in-out infinite; }
  .delay-500 { animation-delay: 3s; }
</style>
@endsection
