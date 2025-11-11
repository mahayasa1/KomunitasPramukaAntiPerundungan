<form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <div>
        <label for="nama" class="block font-semibold text-gray-700">Nama Pengusul *</label>
        <input type="text" id="name" name="name" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label for="email" class="block font-semibold text-gray-700">Email *</label>
        <input type="email" id="email" name="email" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label for="telp" class="block font-semibold text-gray-700">Nomor Telepon *</label>
        <input type="text" id="telp" name="telp" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label for="judul" class="block font-semibold text-gray-700">Judul Pengaduan *</label>
        <input type="text" id="judul" name="judul" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label for="isi" class="block font-semibold text-gray-700">Isi Pengaduan *</label>
        <textarea id="isi" name="isi" rows="4" class="w-full border rounded px-3 py-2" required></textarea>
    </div>

    <div>
        <label for="tanggal_pengaduan" class="block font-semibold text-gray-700">Tanggal Kejadian *</label>
        <input type="date" id="tanggal_pengaduan" name="tanggal_pengaduan" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label for="lokasi" class="block font-semibold text-gray-700">Lokasi Kejadian *</label>
        <input type="text" id="lokasi" name="lokasi" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label for="instansi" class="block font-semibold text-gray-700">Instansi Tujuan *</label>
        <input type="text" id="instansi" name="instansi" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label for="lampiran" class="block font-semibold text-gray-700">Lampiran (Opsional)</label>
        <input type="file" id="lampiran" name="lampiran" accept="pdf" class="w-full border rounded px-3 py-2">
    </div>

    <div class="flex items-center space-x-4">
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="is_anonymous" value="1">
            <span>Anonim</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="is_secret" value="1">
            <span>Rahasia</span>
        </label>
    </div>

    <button type="submit" class="bg-cyan-600 text-white px-6 py-2 rounded-lg hover:bg-cyan-700">
        Kirim Pengaduan
    </button>
</form>
