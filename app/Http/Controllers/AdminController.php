<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Aspirasi;
use App\Models\Permintaan;

class AdminController extends Controller
{
    public function index()
    {

        $totalAspirasi = Aspirasi::count();
        $totalPengaduan = Pengaduan::count();
        $totalPermintaan = Permintaan::count();

        return view('admin.dashboard', [
            'totalAspirasi' => $totalAspirasi,
            'totalPengaduan' => $totalPengaduan,
            'totalPermintaan' => $totalPermintaan
        ]);
    }
}
