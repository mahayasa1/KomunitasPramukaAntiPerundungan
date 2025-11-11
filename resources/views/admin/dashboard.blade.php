<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Anti Perundungan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        /* 🔹 Animasi navbar muncul & hilang */
        .navbar-hidden {
            transform: translateY(-100%);
            opacity: 0;
            transition: transform 0.4s ease, opacity 0.3s ease;
        }
        .navbar-visible {
            transform: translateY(0);
            opacity: 1;
            transition: transform 0.4s ease, opacity 0.3s ease;
        }

        /* 🔹 Efek blur transparan (opsional, tampil elegan) */
        .navbar-glass {
            backdrop-filter: blur(10px);
            background-color: rgba(6, 182, 212, 0.85); /* cyan-500 transparan */
        }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">

  <!-- 🔷 Navbar Melayang -->
  <nav id="navbar" class="fixed top-0 left-0 right-0 navbar-glass text-white shadow-md z-50 navbar-visible">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between items-center h-[100px]">
              <div class="flex items-center space-x-8">
                  <a href="/" class="flex items-center space-x-3">
                      <img src="{{ asset('asset/IMG_4636.PNG') }}" 
                           alt="Logo Anti Perundungan" 
                           class="h-24 md:h-28 w-auto object-contain drop-shadow-md">
                      <div class="text-left">
                          <span class="text-lg font-bold tracking-wide">KOMUNITAS PRAMUKA</span>
                          <span class="text-lg font-bold tracking-wide">ANTI PERUNDUNGAN</span>
                      </div>
                  </a>
              </div>

              <div class="flex items-center space-x-4">
                  <a href="{{ route('logout') }}" 
                     class="border border-white text-sm font-semibold px-4 py-1 rounded hover:bg-white hover:text-cyan-500 transition">
                      LOGOUT
                  </a>
              </div>
          </div>
      </div>
  </nav>

  <!-- 🟩 Konten Dashboard -->
  <main class="max-w-6xl mx-auto pt-[120px] pb-10 px-6">
    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Dashboard Admin</h2>

    {{-- ✅ ASPIRASI --}}
    <section id="aspirasi" class="mb-10">
      <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-blue-500">
        <h3 class="text-xl font-semibold text-blue-700 mb-4">Data Aspirasi</h3>
        <div class="overflow-x-auto">
          <table class="min-w-full border border-gray-200 text-sm text-gray-700">
            <thead class="bg-blue-600 text-white">
              <tr>
                <th class="p-3">No</th>
                <th class="p-3">Judul</th>
                <th class="p-3">Isi</th>
                <th class="p-3">Asal</th>
                <th class="p-3">Instansi</th>
                <th class="p-3">Lampiran</th>
                <th class="p-3">Anonim</th>
                <th class="p-3">Rahasia</th>
                <th class="p-3">Tanggal</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @forelse ($aspirasis as $key => $item)
                <tr class="hover:bg-blue-50 transition">
                  <td class="p-3 text-center">{{ $key + 1 }}</td>
                  <td class="p-3">{{ $item->judul }}</td>
                  <td class="p-3">{{ $item->isi }}</td>
                  <td class="p-3">{{ $item->asal ?? '-' }}</td>
                  <td class="p-3">{{ $item->instansi }}</td>
                  <td class="p-3 text-center">
                    @if ($item->lampiran)
                        <a href="{{ asset($item->lampiran) }}" target="_blank" class="text-blue-600 underline">
                            Lihat Lampiran
                        </a>
                    @else
                        -
                    @endif
                  </td>
                  <td class="p-3 text-center">{{ $item->is_anonymous ? 'Ya' : 'Tidak' }}</td>
                  <td class="p-3 text-center">{{ $item->is_secret ? 'Ya' : 'Tidak' }}</td>
                  <td class="p-3 text-center">{{ $item->created_at->format('d-m-Y') }}</td>
                </tr>
              @empty
                <tr><td colspan="9" class="p-4 text-center text-gray-500">Belum ada data</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </section>

    {{-- ✅ PENGADUAN --}}
    <section id="pengaduan" class="mb-10">
      <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-red-500">
        <h3 class="text-xl font-semibold text-red-700 mb-4">Data Pengaduan</h3>
        <div class="overflow-x-auto">
          <table class="min-w-full border border-gray-200 text-sm text-gray-700">
            <thead class="bg-red-600 text-white">
              <tr>
                <th class="p-3">No</th>
                <th class="p-3">Judul</th>
                <th class="p-3">Isi</th>
                <th class="p-3">Tanggal</th>
                <th class="p-3">Lokasi</th>
                <th class="p-3">Instansi</th>
                <th class="p-3">Lampiran</th>
                <th class="p-3">Anonim</th>
                <th class="p-3">Rahasia</th>
                <th class="p-3">Dibuat</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @forelse ($pengaduans as $key => $item)
                <tr class="hover:bg-red-50 transition">
                  <td class="p-3 text-center">{{ $key + 1 }}</td>
                  <td class="p-3">{{ $item->judul }}</td>
                  <td class="p-3">{{ $item->isi }}</td>
                  <td class="p-3">{{ $item->tanggal_pengaduan ?? '-' }}</td>
                  <td class="p-3">{{ $item->lokasi ?? '-' }}</td>
                  <td class="p-3">{{ $item->instansi }}</td>
                  <td class="p-3 text-center">
                    @if ($item->lampiran)
                        <a href="{{ asset($item->lampiran) }}" target="_blank" class="text-blue-600 underline">
                            Lihat Lampiran
                        </a>
                    @else
                        -
                    @endif
                  </td>
                  <td class="p-3 text-center">{{ $item->is_anonymous ? 'Ya' : 'Tidak' }}</td>
                  <td class="p-3 text-center">{{ $item->is_secret ? 'Ya' : 'Tidak' }}</td>
                  <td class="p-3 text-center">{{ $item->created_at->format('d-m-Y') }}</td>
                </tr>
              @empty
                <tr><td colspan="10" class="p-4 text-center text-gray-500">Belum ada data</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </section>

    {{-- ✅ PERMINTAAN --}}
    <section id="permintaan">
      <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-green-500">
        <h3 class="text-xl font-semibold text-green-700 mb-4">Data Permintaan</h3>
        <div class="overflow-x-auto">
          <table class="min-w-full border border-gray-200 text-sm text-gray-700">
            <thead class="bg-green-600 text-white">
              <tr>
                <th class="p-3">No</th>
                <th class="p-3">Judul</th>
                <th class="p-3">Isi</th>
                <th class="p-3">Asal</th>
                <th class="p-3">Instansi</th>
                <th class="p-3">Lampiran</th>
                <th class="p-3">Anonim</th>
                <th class="p-3">Rahasia</th>
                <th class="p-3">Tanggal</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @forelse ($permintaans as $key => $item)
                <tr class="hover:bg-green-50 transition">
                  <td class="p-3 text-center">{{ $key + 1 }}</td>
                  <td class="p-3">{{ $item->judul }}</td>
                  <td class="p-3">{{ $item->isi }}</td>
                  <td class="p-3">{{ $item->asal ?? '-' }}</td>
                  <td class="p-3">{{ $item->instansi }}</td>
                  <td class="p-3 text-center">
                    @if ($item->lampiran)
                        <a href="{{ asset($item->lampiran) }}" target="_blank" class="text-blue-600 underline">
                            Lihat Lampiran
                        </a>
                    @else
                        -
                    @endif
                  </td>
                  <td class="p-3 text-center">{{ $item->is_anonymous ? 'Ya' : 'Tidak' }}</td>
                  <td class="p-3 text-center">{{ $item->is_secret ? 'Ya' : 'Tidak' }}</td>
                  <td class="p-3 text-center">{{ $item->created_at->format('d-m-Y') }}</td>
                </tr>
              @empty
                <tr><td colspan="9" class="p-4 text-center text-gray-500">Belum ada data</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </main>

  <script>
      let lastScrollTop = 0;
      const navbar = document.getElementById('navbar');

      window.addEventListener('scroll', function() {
          const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

          if (currentScroll > lastScrollTop && currentScroll > 80) {
              navbar.classList.remove('navbar-visible');
              navbar.classList.add('navbar-hidden');
          } else {
              navbar.classList.remove('navbar-hidden');
              navbar.classList.add('navbar-visible');
          }

          lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
      }, false);
  </script>

</body>
</html>
