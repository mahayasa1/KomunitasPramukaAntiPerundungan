<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title>@yield('title', 'Komunitas Pramuka Anti Perundungan | Ciptakan Lingkungan Aman Bebas Bullying')</title>
    <meta name="description" content="@yield('description', 'Komunitas Pramuka Anti Perundungan adalah gerakan sosial untuk menciptakan lingkungan pramuka yang aman, nyaman, dan bebas dari segala bentuk perundungan. Kami menyediakan pusat laporan daring, pendampingan korban, penyuluhan ke sekolah, dan kampanye edukatif.')">
    <meta name="keywords" content="@yield('keywords', 'pramuka anti perundungan, anti bullying, lapor bullying, pendampingan korban, konseling gratis, penyuluhan anti perundungan, pencegahan bullying, komunitas pramuka, keselamatan anak, pendidikan karakter, stop bullying')">
    <meta name="author" content="Komunitas Pramuka Anti Perundungan">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:title" content="@yield('og_title', 'Komunitas Pramuka Anti Perundungan')">
    <meta property="og:description" content="@yield('og_description', 'Gerakan sosial untuk menciptakan lingkungan pramuka yang aman dan bebas bullying. Layanan: Pusat laporan daring, pendampingan korban, penyuluhan, dan konseling gratis.')">
    <meta property="og:image" content="@yield('og_image', asset('asset/IMG_4636.PNG'))">
    <meta property="og:site_name" content="Komunitas Pramuka Anti Perundungan">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="@yield('twitter_url', url()->current())">
    <meta property="twitter:title" content="@yield('twitter_title', 'Komunitas Pramuka Anti Perundungan')">
    <meta property="twitter:description" content="@yield('twitter_description', 'Gerakan sosial untuk menciptakan lingkungan pramuka yang aman dan bebas bullying. Layanan: Pusat laporan daring, pendampingan korban, penyuluhan, dan konseling gratis.')">
    <meta property="twitter:image" content="@yield('twitter_image', asset('asset/IMG_4636.PNG'))">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical', url()->current())">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    
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
        
        /* Mobile Menu */
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        .mobile-menu.active {
            max-height: 500px;
            transition: max-height 0.3s ease-in;
        }
        
        /* Hamburger Animation */
        .hamburger span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 5px 0;
            transition: 0.3s;
        }
        .hamburger.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }
        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }
        .hamburger.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased">
    <x-aksesibilitas />
    

    <!-- 🔵 Navbar Melayang -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 bg-cyan-500/40 text-white shadow-md z-50 navbar-visible" role="navigation" aria-label="Main navigation">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-3 lg:py-2">
            <!-- Logo & Navbar Links - Kiri -->
            <div class="hidden lg:flex items-center space-x-6">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-2 sm:space-x-3" aria-label="Home - Komunitas Pramuka Anti Perundungan">
                    <img src="{{ asset('asset/IMG_4636.PNG') }}" alt="Logo Komunitas Pramuka Anti Perundungan" class="h-12 sm:h-16 lg:h-20 w-auto">
                    <div class="text-left">
                        <span class="text-xs sm:text-sm lg:text-lg font-bold tracking-wide">KOMUNITAS PRAMUKA</span>
                        <span class="text-xs sm:text-sm lg:text-lg font-bold tracking-wide">ANTI PERUNDUNGAN</span>
                    </div>
                </a>

                <!-- Navbar Links -->
                <div class="flex items-center space-x-2">
                    <a href="{{ route('about') }}"
                        class="text-sm font-semibold px-3 py-1 rounded
                                {{ Request::routeIs('about') ? 'bg-cyan-400 text-white' : 'hover:text-white text-gray-100' }}"
                        aria-label="Tentang Komunitas Pramuka Anti Perundungan">
                        TENTANG
                    </a>
                    <a href="{{ route('sejarah') }}"
                        class="text-sm font-semibold px-3 py-1 rounded
                                {{ Request::routeIs('sejarah') ? 'bg-cyan-400 text-white' : 'hover:text-white text-gray-100' }}"
                        aria-label="Sejarah Gerakan Anti Perundungan">
                        SEJARAH
                    </a>
                    <a href="{{ route('search.index') }}"
                        class="text-sm font-semibold px-3 py-1 rounded
                                {{ Request::routeIs('search.index') ? 'bg-cyan-400 text-white' : 'hover:text-white text-gray-100' }}"
                        aria-label="Cari Informasi">
                        CARI
                    </a>
                    <a href="{{ route('berita.index') }}"
                        class="text-sm font-semibold px-3 py-1 rounded
                                {{ Request::routeIs('berita.index') ? 'bg-cyan-400 text-white' : 'hover:text-white text-gray-100' }}"
                        aria-label="Berita dan Artikel">
                        BERITA
                    </a>
                </div>
            </div>

            <!-- Logo untuk Mobile -->
            <a href="/" class="flex lg:hidden items-center space-x-2 sm:space-x-3" aria-label="Home - Komunitas Pramuka Anti Perundungan">
                <img src="{{ asset('asset/IMG_4636.PNG') }}" alt="Logo Komunitas Pramuka Anti Perundungan" class="h-12 sm:h-16 w-auto">
                <div class="text-left">
                    <span class="text-xs sm:text-sm font-bold tracking-wide">KOMUNITAS PRAMUKA</span>
                    <span class="text-xs sm:text-sm font-bold tracking-wide">ANTI PERUNDUNGAN</span>
                </div>
            </a>

            <!-- Tombol Masuk - Kanan (Desktop) -->
            <div class="hidden lg:block">
                <a href="{{ route('login') }}" 
                    class="border border-white text-sm font-semibold px-4 py-1 rounded hover:bg-white hover:text-cyan-500 transition" 
                    aria-label="Masuk ke Akun">
                    MASUK
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden p-2 focus:outline-none" aria-label="Toggle Menu">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu lg:hidden bg-cyan-500">
            <div class="py-4 space-y-2">
                <a href="{{ route('about') }}"
                    class="block text-sm font-semibold px-4 py-2 rounded
                            {{ Request::routeIs('about') ? 'bg-cyan-400 text-white' : 'hover:bg-cyan-400 text-gray-100' }}"
                    aria-label="Tentang Komunitas Pramuka Anti Perundungan">
                    TENTANG
                </a>
                <a href="{{ route('sejarah') }}"
                    class="block text-sm font-semibold px-4 py-2 rounded
                            {{ Request::routeIs('sejarah') ? 'bg-cyan-400 text-white' : 'hover:bg-cyan-400 text-gray-100' }}"
                    aria-label="Sejarah Gerakan Anti Perundungan">
                    SEJARAH
                </a>
                <a href="{{ route('search.index') }}"
                    class="block text-sm font-semibold px-4 py-2 rounded
                            {{ Request::routeIs('search.index') ? 'bg-cyan-400 text-white' : 'hover:bg-cyan-400 text-gray-100' }}"
                    aria-label="Cari Informasi">
                    CARI
                </a>
                <a href="{{ route('berita.index') }}"
                    class="block text-sm font-semibold px-4 py-2 rounded
                            {{ Request::routeIs('berita.index') ? 'bg-cyan-400 text-white' : 'hover:bg-cyan-400 text-gray-100' }}"
                    aria-label="Berita dan Artikel">
                    BERITA
                </a>
                <a href="{{ route('login') }}" 
                    class="block text-sm font-semibold px-4 py-2 rounded border border-white hover:bg-white hover:text-cyan-500 transition text-center" 
                    aria-label="Masuk ke Akun">
                    MASUK
                </a>
            </div>
        </div>
    </div>
</nav>

    <!-- Konten -->

    <main class="pb-10" role="main">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-cyan-800 text-gray-300 py-6 sm:py-8 lg:py-10 mt-10" role="contentinfo">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">

        <!-- Logo & Copyright -->
        <div class="text-left">
            <img src="{{ asset('asset/logo.png') }}" class="h-8 sm:h-10 mb-3 sm:mb-4" alt="Logo SKYNUSA TECH">
            <p class="text-xs sm:text-sm">Powered by © {{ date('Y') }} SKYNUSA TECH</p>
        </div>

        <!-- Contact -->
        <div class="text-left">
            <h4 class="text-base sm:text-lg font-semibold mb-2 sm:mb-3 text-white">Contact</h4>
            <ul class="space-y-1 sm:space-y-2 text-xs sm:text-sm">
                <li><a href="mailto:Pramukagercep@gmail.com" class="hover:text-white break-all">Pramukagercep@gmail.com</a></li>
                <li><a href="tel:+6281234567890" class="hover:text-white">+62 812-3456-7890</a></li>
                <li class="text-xs">Jl. Tantular No.11, Dangin Puri Klod, Denpasar, Bali</li>
            </ul>
        </div>

        <!-- Customer Service -->
        <div class="text-left">
            <h4 class="text-base sm:text-lg font-semibold mb-2 sm:mb-3 text-white">Customer Service</h4>
            <ul class="space-y-1 sm:space-y-2 text-xs sm:text-sm">
                <li><a href="#" class="hover:text-white">FAQ</a></li>
                <li><a href="#" class="hover:text-white">Help Center</a></li>
                <li><a href="#" class="hover:text-white">Terms & Conditions</a></li>
                <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
            </ul>
        </div>

        <!-- Blog & Social -->
        <div class="text-left">
            <h4 class="text-base sm:text-lg font-semibold mb-2 sm:mb-3 text-white">Explore</h4>
            <ul class="space-y-1 sm:space-y-2 text-xs sm:text-sm">
                <li><a href="{{ route('berita.index') }}" class="hover:text-white">Blog</a></li>
                <li><a href="#" class="hover:text-white">News & Updates</a></li>
            </ul>

            <h4 class="text-base sm:text-lg font-semibold mt-4 sm:mt-5 mb-2 sm:mb-3 text-white">Follow Us</h4>
            <div class="flex gap-3 sm:gap-4 text-lg sm:text-xl">
                <a href="#" class="hover:text-white" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="#" class="hover:text-white" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-white" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                <a href="#" class="hover:text-white" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
</footer>

<script>
    let lastScrollTop = 0;
    const navbar = document.getElementById('navbar');
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburger = document.querySelector('.hamburger');

    // Mobile Menu Toggle
    mobileMenuBtn.addEventListener('click', function() {
        mobileMenu.classList.toggle('active');
        hamburger.classList.toggle('active');
    });

    // Close mobile menu when clicking a link
    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
            hamburger.classList.remove('active');
        });
    });

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

        // Close mobile menu when scrolling
        if (mobileMenu.classList.contains('active')) {
            mobileMenu.classList.remove('active');
            hamburger.classList.remove('active');
        }

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