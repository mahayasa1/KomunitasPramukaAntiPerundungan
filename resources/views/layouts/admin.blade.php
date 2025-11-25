<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - Admin</title>
  <script src="https://kit.fontawesome.com/5b5e103a5b.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link rel="stylesheet" href="https://unpkg.com/trix/dist/trix.css">
  <script src="https://unpkg.com/trix/dist/trix.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans antialiased" x-data="{ sidebarOpen: true }">

  {{-- 🧭 SIDEBAR --}}
  <aside 
    class="fixed z-30 top-0 left-0 h-full bg-cyan-600 text-white flex flex-col shadow-lg transform transition-all duration-300"
    :class="sidebarOpen ? 'w-64' : 'w-20'">
    
    {{-- 🔷 LOGO & TITLE --}}
    <div class="flex flex-col items-center justify-center py-4 border-b border-cyan-500 transition-all duration-300 relative">
      <img src="{{ asset('asset/IMG_4636.PNG') }}" class="h-28 w-auto object-contain mb-2" alt="Logo">

      <div class="text-center leading-tight overflow-hidden transition-all duration-300" 
           :class="sidebarOpen ? 'opacity-100 max-h-20' : 'opacity-0 max-h-0'">
        <h1 class="text-sm font-bold tracking-wide">KOMUNITAS PRAMUKA</h1>
        <h2 class="text-sm font-bold">ANTI PERUNDUNGAN</h2>
      </div>
    </div>

    {{-- 🔹 NAVIGATION --}}
    <nav class="flex-1 px-3 py-6 space-y-2">
      <template x-for="item in [
        { icon: 'fa-gauge-high', text: 'Dashboard', link: '{{ route('admin.dashboard') }}' },
        { icon: 'fa-comments', text: 'Data Aspirasi', link: '{{ route('admin.aspirasi.index') }}' },
        { icon: 'fa-triangle-exclamation', text: 'Data Pengaduan', link: '{{ route('admin.pengaduan.index') }}' },
        { icon: 'fa-bullhorn', text: 'Data Permintaan', link: '{{ route('admin.permintaan.index') }}' },
        { icon: 'fa-newspaper', text: 'Data Berita', link: '{{ route('admin.berita.index') }}' },
      ]" :key="item.text">
        <a :href="item.link"
          class="group relative flex items-center gap-3 py-2 px-3 rounded font-semibold transition transform hover:scale-[1.05] hover:bg-cyan-500 hover:shadow-lg">
          
          <i :class="'fa-solid ' + item.icon + ' w-5 text-center'"></i>
          
          <span class="transition-all duration-300 whitespace-nowrap"
                :class="sidebarOpen ? 'opacity-100 ml-1' : 'opacity-0 hidden'">
            <span x-text="item.text"></span>
          </span>
        
          <!-- Tooltip ketika sidebar tertutup -->
          <span 
            x-show="!sidebarOpen"
            x-transition
            x-text="item.text"
            class="absolute left-full ml-2 px-2 py-1 text-sm bg-cyan-700 rounded shadow-lg opacity-0 group-hover:opacity-100 whitespace-nowrap">
          </span>
        
        </a>
      </template>

    </nav>

    {{-- 🔸 LOGOUT --}}
    <div class="px-4 pb-6">
      <a href="{{ route('logout') }}" 
         class="group relative flex items-center justify-center gap-2 bg-cyan-600 text-white font-semibold py-2 rounded hover:bg-cyan-500 transition">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span class="transition-all duration-300"
              :class="sidebarOpen ? 'opacity-100 ml-1' : 'opacity-0 hidden'">
          Logout
        </span>

        {{-- Tooltip logout --}}
        <span 
          x-show="!sidebarOpen"
          class="absolute left-full ml-2 px-2 py-1 text-sm bg-cyan-700 rounded opacity-0 group-hover:opacity-100 whitespace-nowrap pointer-events-none transition-all duration-300">
          Logout
        </span>
      </a>
    </div>
  </aside>

  {{-- 🟦 HEADER --}}
  <header class="fixed top-0 left-0 right-0 bg-cyan-600 text-white z-20 h-16 flex items-center shadow-md transition-all duration-300"
          :class="sidebarOpen ? 'pl-72' : 'pl-24'">
          <button 
      @click="sidebarOpen = !sidebarOpen"
      class="absolute align-middle top-1/ transform-translate-y-1/2  text-white flex items-center justify-center shadow-lg transition duration-300">
      <i class="fa-solid fa-bars text- transition-transform duration-300"
          :class="sidebarOpen ? 'rotate-0' : 'rotate-0'"></i>
    </button>
    <h1 class=" ml-8 text-2xl font-semibold">@yield('title', 'Dashboard')</h1>
  </header>

  {{-- 🟢 MAIN CONTENT --}}
  <main class="pt-20 transition-all duration-300" 
        :class="sidebarOpen ? 'ml-64' : 'ml-20'">
        <div class="p-10">
      @yield('content')
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('welcome'))
<script>
    Swal.fire({
        title: "Welcome Admin {{ auth()->user()->name }}!",
        text: "{{ session('welcome') }}",
        icon: "success",
        timer: 2500,
        showConfirmButton: false
    });
</script>
@endif


</body>
</html>
