<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '')</title>
    <script src="https://kit.fontawesome.com/5b5e103a5b.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        /* Animasi sembunyi & muncul navbar */
        .navbar-hidden {
            transform: translateY(-100%);
            transition: transform 0.4s ease;
        }
        .navbar-visible {
            transform: translateY(0);
            transition: transform 0.4s ease;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased">

    <!-- 🔵 Navbar Melayang -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 bg-cyan-500/40 text-white shadow-md z-50 navbar-visible">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-23">
                <!-- Logo -->
            <div class="flex items-center space-x-8">
                    <a href="/" class="flex items-center space-x-3">
                        <!-- Ganti logo di sini -->
                        <img src="{{ asset('asset/IMG_4636.PNG') }}" alt="Logo Anti Perundungan" class="h-30 w-auto">
                        <div class="text-left leading-none">
                            <span class="text-lg font-bold tracking-wide m-0">KOMUNITAS PRAMUKA</span>
                            <span class="text-lg font-bold tracking-wide m-0">ANTI PERUNDUNGAN</span>
                        </div>
                    </a>
                    <div class="hidden md:flex space-x-6">
                        <a href="" class="hover:text-gray-200 text-sm font-semibold">TENTANG</a>
                        <a href="" class="hover:text-gray-200 text-sm font-semibold">SEJARAH</a>
                    </div>
                </div>

                <!-- Tombol kanan -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-gray-200 flex items-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H3m12 0l-3-3m3 3l-3 3m6-6v6m0 0a9 9 0 11-9-9"/>
                        </svg>
                        <span>MASUK</span>
                    </a>

                    <a href="{{ route('register') }}" class="border border-white text-sm font-semibold px-4 py-1 rounded hover:bg-white hover:text-cyan-500 transition">
                        DAFTAR
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten -->

    <main class=" pb-10">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 text-center text-sm text-gray-500 py-4 mt-10">
        © {{ date('Y') }} 
    </footer>

    <script>
        let lastScrollTop = 0;
        const navbar = document.getElementById('navbar');

        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll > lastScrollTop && currentScroll > 80) {
                // Scroll ke bawah -> sembunyikan navbar
                navbar.classList.remove('navbar-visible');
                navbar.classList.add('navbar-hidden');
            } else {
                // Scroll ke atas -> tampilkan navbar
                navbar.classList.remove('navbar-hidden');
                navbar.classList.add('navbar-visible');
            }

            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
        }, false);
    </script>
</body>
</html>
