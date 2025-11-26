<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Aspirasi;
use App\Models\Permintaan;
use App\Models\Berita;

class AdminController extends Controller
{
    public function index()
    {

        $totalAspirasi = Aspirasi::count();
        $totalPengaduan = Pengaduan::count();
        $totalPermintaan = Permintaan::count();
        $totalBerita = Berita::count();

        return view('admin.dashboard', [
            'totalAspirasi' => $totalAspirasi,
            'totalPengaduan' => $totalPengaduan,
            'totalPermintaan' => $totalPermintaan,
            'totalBerita' => $totalBerita,
        ]);
    }
}
