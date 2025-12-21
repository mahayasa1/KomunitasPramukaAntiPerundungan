<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - Admin Dashboard</title>
  
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
  
  <script src="https://kit.fontawesome.com/5b5e103a5b.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link rel="stylesheet" href="https://unpkg.com/trix/dist/trix.css">
  <script src="https://unpkg.com/trix/dist/trix.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @vite('resources/css/app.css')
  
  <style>
    [x-cloak] { display: none !important; }
    
    /* Smooth transitions */
    * {
      transition-property: margin, padding, width;
      transition-duration: 300ms;
      transition-timing-function: ease-in-out;
    }
    
    /* Mobile menu overlay */
    .mobile-overlay {
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(2px);
    }
  </style>
</head>

<body class="bg-gray-100 font-sans antialiased" x-data="{ sidebarOpen: window.innerWidth >= 1024, mobileMenuOpen: false }" x-cloak>

  {{-- 🧭 SIDEBAR --}}
  <aside 
    class="fixed top-0 left-0 h-full bg-cyan-600 text-white flex flex-col shadow-lg transform transition-transform duration-300"
    :class="{
      'w-64': sidebarOpen || mobileMenuOpen,
      'w-20': !sidebarOpen && !mobileMenuOpen && window.innerWidth >= 1024,
      '-translate-x-full': !mobileMenuOpen && window.innerWidth < 1024,
      'translate-x-0': mobileMenuOpen || window.innerWidth >= 1024,
      'z-50': mobileMenuOpen,
      'z-40': !mobileMenuOpen
    }">
    
    {{-- 🔷 LOGO & TITLE --}}
    <div class="flex flex-col items-center justify-center py-4 border-b border-cyan-500 transition-all duration-300 relative">
      <img src="{{ asset('asset/IMG_4636.PNG') }}" 
           class="transition-all duration-300"
           :class="(sidebarOpen || mobileMenuOpen) ? 'h-24 sm:h-28' : 'h-12'"
           alt="Logo Komunitas Pramuka Anti Perundungan">

      <div class="text-center leading-tight overflow-hidden transition-all duration-300 px-2" 
           :class="(sidebarOpen || mobileMenuOpen) ? 'opacity-100 max-h-20 mt-2' : 'opacity-0 max-h-0'">
        <h1 class="text-xs sm:text-sm font-bold tracking-wide">KOMUNITAS PRAMUKA</h1>
        <h2 class="text-xs sm:text-sm font-bold">ANTI PERUNDUNGAN</h2>
      </div>
      
      {{-- Close button for mobile --}}
      <button 
        @click="mobileMenuOpen = false"
        class="lg:hidden absolute top-4 right-4 text-white hover:bg-cyan-500 rounded p-2">
        <i class="fa-solid fa-times"></i>
      </button>
    </div>

    {{-- 🔹 NAVIGATION --}}
    <nav class="flex-1 px-3 py-6 space-y-2 overflow-y-auto">
      <a href="{{ route('admin.dashboard') }}"
        @click="if (window.innerWidth < 1024) mobileMenuOpen = false"
        class="group relative flex items-center py-2.5 px-3 rounded font-semibold transition transform hover:scale-[1.02] hover:bg-cyan-500 hover:shadow-lg"
        :class="(sidebarOpen || mobileMenuOpen) ? 'gap-3' : 'justify-center'">
        <i class="fa-solid fa-gauge-high text-lg w-5 text-center"></i>
        <span class="text-sm whitespace-nowrap" x-show="sidebarOpen || mobileMenuOpen" x-transition>Dashboard</span>
        <span x-show="!sidebarOpen && !mobileMenuOpen" class="hidden lg:block absolute left-full ml-2 px-2 py-1 text-sm bg-cyan-700 rounded shadow-lg opacity-0 group-hover:opacity-100 whitespace-nowrap pointer-events-none z-50">Dashboard</span>
      </a>

      <a href="{{ route('admin.aspirasi.index') }}"
        @click="if (window.innerWidth < 1024) mobileMenuOpen = false"
        class="group relative flex items-center py-2.5 px-3 rounded font-semibold transition transform hover:scale-[1.02] hover:bg-cyan-500 hover:shadow-lg"
        :class="(sidebarOpen || mobileMenuOpen) ? 'gap-3' : 'justify-center'">
        <i class="fa-solid fa-comments text-lg w-5 text-center"></i>
        <span class="text-sm whitespace-nowrap" x-show="sidebarOpen || mobileMenuOpen" x-transition>Data Aspirasi</span>
        <span x-show="!sidebarOpen && !mobileMenuOpen" class="hidden lg:block absolute left-full ml-2 px-2 py-1 text-sm bg-cyan-700 rounded shadow-lg opacity-0 group-hover:opacity-100 whitespace-nowrap pointer-events-none z-50">Data Aspirasi</span>
      </a>

      <a href="{{ route('admin.pengaduan.index') }}"
        @click="if (window.innerWidth < 1024) mobileMenuOpen = false"
        class="group relative flex items-center py-2.5 px-3 rounded font-semibold transition transform hover:scale-[1.02] hover:bg-cyan-500 hover:shadow-lg"
        :class="(sidebarOpen || mobileMenuOpen) ? 'gap-3' : 'justify-center'">
        <i class="fa-solid fa-triangle-exclamation text-lg w-5 text-center"></i>
        <span class="text-sm whitespace-nowrap" x-show="sidebarOpen || mobileMenuOpen" x-transition>Data Pengaduan</span>
        <span x-show="!sidebarOpen && !mobileMenuOpen" class="hidden lg:block absolute left-full ml-2 px-2 py-1 text-sm bg-cyan-700 rounded shadow-lg opacity-0 group-hover:opacity-100 whitespace-nowrap pointer-events-none z-50">Data Pengaduan</span>
      </a>

      <a href="{{ route('admin.permintaan.index') }}"
        @click="if (window.innerWidth < 1024) mobileMenuOpen = false"
        class="group relative flex items-center py-2.5 px-3 rounded font-semibold transition transform hover:scale-[1.02] hover:bg-cyan-500 hover:shadow-lg"
        :class="(sidebarOpen || mobileMenuOpen) ? 'gap-3' : 'justify-center'">
        <i class="fa-solid fa-bullhorn text-lg w-5 text-center"></i>
        <span class="text-sm whitespace-nowrap" x-show="sidebarOpen || mobileMenuOpen" x-transition>Data Permintaan</span>
        <span x-show="!sidebarOpen && !mobileMenuOpen" class="hidden lg:block absolute left-full ml-2 px-2 py-1 text-sm bg-cyan-700 rounded shadow-lg opacity-0 group-hover:opacity-100 whitespace-nowrap pointer-events-none z-50">Data Permintaan</span>
      </a>

      <a href="{{ route('admin.berita.index') }}"
        @click="if (window.innerWidth < 1024) mobileMenuOpen = false"
        class="group relative flex items-center py-2.5 px-3 rounded font-semibold transition transform hover:scale-[1.02] hover:bg-cyan-500 hover:shadow-lg"
        :class="(sidebarOpen || mobileMenuOpen) ? 'gap-3' : 'justify-center'">
        <i class="fa-solid fa-newspaper text-lg w-5 text-center"></i>
        <span class="text-sm whitespace-nowrap" x-show="sidebarOpen || mobileMenuOpen" x-transition>Data Berita</span>
        <span x-show="!sidebarOpen && !mobileMenuOpen" class="hidden lg:block absolute left-full ml-2 px-2 py-1 text-sm bg-cyan-700 rounded shadow-lg opacity-0 group-hover:opacity-100 whitespace-nowrap pointer-events-none z-50">Data Berita</span>
      </a>
    </nav>

    {{-- 🔸 LOGOUT --}}
    <div class="px-3 sm:px-4 pb-4 sm:pb-6">
      <a href="{{ route('logout') }}" 
         @click="if (window.innerWidth < 1024) mobileMenuOpen = false"
         class="group relative flex items-center bg-cyan-700 hover:bg-cyan-500 text-white font-semibold py-2.5 rounded transition"
         :class="(sidebarOpen || mobileMenuOpen) ? 'gap-2 justify-center' : 'justify-center'">
        <i class="fa-solid fa-right-from-bracket text-lg"></i>
        <span class="text-sm" x-show="sidebarOpen || mobileMenuOpen" x-transition>Logout</span>

        {{-- Tooltip logout (desktop only) --}}
        <span 
          x-show="!sidebarOpen && !mobileMenuOpen"
          class="hidden lg:block absolute left-full ml-2 px-2 py-1 text-sm bg-cyan-700 rounded opacity-0 group-hover:opacity-100 whitespace-nowrap pointer-events-none transition-all duration-300 z-50">
          Logout
        </span>
      </a>
    </div>
  </aside>

  {{-- Mobile Overlay --}}
  <div 
    x-show="mobileMenuOpen"
    @click="mobileMenuOpen = false"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="lg:hidden fixed inset-0 z-40 mobile-overlay">
  </div>

  {{-- 🟦 HEADER --}}
  <header class="fixed top-0 left-0 right-0 bg-cyan-600 text-white flex items-center shadow-md transition-all duration-300 px-4 z-30"
          style="height: 3.5rem;"
          :class="window.innerWidth >= 1024 ? (sidebarOpen ? 'lg:pl-72' : 'lg:pl-24') : 'pl-4'">
    
    {{-- Hamburger Menu (Mobile) --}}
    <button 
      @click="mobileMenuOpen = true"
      class="lg:hidden text-white p-2 hover:bg-cyan-500 rounded transition mr-3 flex-shrink-0">
      <i class="fa-solid fa-bars text-xl"></i>
    </button>
    
    {{-- Toggle Sidebar (Desktop) --}}
    <button 
      @click="sidebarOpen = !sidebarOpen"
      class="hidden lg:block text-white p-2 hover:bg-cyan-500 rounded transition mr-3 flex-shrink-0">
      <i class="fa-solid fa-bars text-xl"></i>
    </button>
    
    <h1 class="text-base sm:text-lg lg:text-xl font-semibold truncate flex-1 min-w-0">
      @yield('title', 'Dashboard')
    </h1>
    
    {{-- User Info (Optional) --}}
    <div class="ml-auto flex items-center gap-2 sm:gap-3 flex-shrink-0">
      <span class="hidden sm:inline text-xs sm:text-sm truncate max-w-[120px]">
        Admin: {{ auth()->user()->name ?? 'User' }}
      </span>
      <div class="w-8 h-8 sm:w-9 sm:h-9 bg-cyan-500 rounded-full flex items-center justify-center flex-shrink-0">
        <i class="fa-solid fa-user text-sm"></i>
      </div>
    </div>
  </header>

  {{-- 🟢 MAIN CONTENT --}}
  <main class="transition-all duration-300 min-h-screen" 
        style="padding-top: 4rem;"
        :class="window.innerWidth >= 1024 ? (sidebarOpen ? 'lg:ml-64' : 'lg:ml-20') : 'ml-0'">
    <div class="p-4 sm:p-6 lg:p-10">
      @yield('content')
    </div>
  </main>

  {{-- Welcome Alert --}}
  @if(session('welcome'))
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: "Welcome Admin {{ auth()->user()->name }}!",
        text: "{{ session('welcome') }}",
        icon: "success",
        timer: 2500,
        showConfirmButton: false
      });
    });
  </script>
  @endif

  {{-- Handle window resize --}}
  <script>
    window.addEventListener('resize', function() {
      if (window.innerWidth >= 1024) {
        Alpine.store('global', { mobileMenuOpen: false });
      }
    });
  </script>

</body>
</html>