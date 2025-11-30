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
    <x-aksesibilitas />
    

    <!-- 🔵 Navbar Melayang -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 bg-cyan-500/40 text-white shadow-md z-50 navbar-visible">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-23 w-full">
                <!-- Logo -->
            <div class="flex items-center space-x-8 shrink-0">
                    <a href="/" class="flex items-center space-x-3">
                        <!-- Ganti logo di sini -->
                        <img src="{{ asset('asset/IMG_4636.PNG') }}" alt="Logo Anti Perundungan" class="h-30 w-auto">
                        <div class="text-left leading-none">
                            <span class="text-lg font-bold tracking-wide m-0">KOMUNITAS PRAMUKA</span>
                            <span class="text-lg font-bold tracking-wide m-0">ANTI PERUNDUNGAN</span>
                        </div>
                    </a>
                <div class="hidden md:flex space-x-2">
                    <a href="{{ route('about') }}"
                        class="text-sm font-semibold px-3 py-1 rounded
                                {{ Request::routeIs('about') ? 'bg-cyan-400 text-white' : 'hover:text-white text-gray-100' }}">
                        TENTANG
                    </a>
                
                    <a href="{{ route('sejarah') }}"
                        class="text-sm font-semibold px-3 py-1 rounded
                                {{ Request::routeIs('sejarah') ? 'bg-cyan-400 text-white' : 'hover:text-white text-gray-100' }}">
                        SEJARAH
                    </a>
                
                    <a href="{{ route('search.index') }}"
                        class="text-sm font-semibold px-3 py-1 rounded
                                {{ Request::routeIs('search.index') ? 'bg-cyan-400 text-white' : 'hover:text-white text-gray-100' }}">
                        CARI
                    </a>
                
                    <a href="{{ route('berita.index') }}"
                        class="text-sm font-semibold px-3 py-1 rounded
                                {{ Request::routeIs('berita.index') ? 'bg-cyan-400 text-white' : 'hover:text-white text-gray-100' }}">
                        BERITA
                    </a>
                
                </div>
            </div>

                <!-- Tombol kanan -->
                <div class="flex items-center space-x-6 ">
                    <a href="{{ route('login') }}" class="border border-white text-sm font-semibold px-4 py-1 rounded hover:bg-white hover:text-cyan-500 transition">
                        <span>MASUK</span>
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
    <footer class="bg-cyan-800 text-gray-300 py-10 mt-10">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">

            <!-- Logo & Copyright -->
            <div>
                <img src="{{ asset('asset/logo.png') }}" class="h-10 mb-4" alt="Logo">
                <p class="text-sm">Powered by © {{ date('Y') }} SKYNUSA TECH</p>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-lg font-semibold mb-3 text-white">Contact</h4>
                <ul class="space-y-2 text-sm">
                    <li>Email: support@skynusa.com</li>
                    <li>Phone: +62 812-3456-7890</li>
                    <li>Address: Bali, Indonesia</li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h4 class="text-lg font-semibold mb-3 text-white">Customer Service</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">FAQ</a></li>
                    <li><a href="#" class="hover:text-white">Help Center</a></li>
                    <li><a href="#" class="hover:text-white">Terms & Conditions</a></li>
                    <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Blog & Social -->
            <div>
                <h4 class="text-lg font-semibold mb-3 text-white">Explore</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">Blog</a></li>
                    <li><a href="#" class="hover:text-white">News & Updates</a></li>
                </ul>

                <h4 class="text-lg font-semibold mt-5 mb-3 text-white">Follow Us</h4>
                <div class="flex gap-4 text-xl">
                    <a href="#" class="hover:text-white"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="hover:text-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-white"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="hover:text-white"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>

<script>
    let lastScrollTop = 0;
    const navbar = document.getElementById('navbar');

    function updateNavbarBackground() {
        if (window.scrollY <= 5) {
            // Di paling atas → transparan 40
            navbar.classList.remove("bg-cyan-500");
            navbar.classList.add("bg-cyan-500/40");
        } else {
            // Tidak di atas → solid 100
            navbar.classList.remove("bg-cyan-500/40");
            navbar.classList.add("bg-cyan-500");
        }
    }

    // Set awal ketika page load
    updateNavbarBackground();

    window.addEventListener('scroll', function () {
        const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

        // 🔵 Ubah transparansi navbar
        updateNavbarBackground();

        // 🔵 Deteksi arah scroll
        if (currentScroll > lastScrollTop && currentScroll > 80) {
            // Scroll ke bawah → sembunyikan navbar
            navbar.classList.remove('navbar-visible');
            navbar.classList.add('navbar-hidden');
        } else {
            // Scroll ke atas → tampilkan navbar
            navbar.classList.remove('navbar-hidden');
            navbar.classList.add('navbar-visible');
        }

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    }, false);
</script>


</body>
</html>
