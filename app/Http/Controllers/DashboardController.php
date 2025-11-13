<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Pengaduan;
use App\Models\Permintaan;

class DashboardController extends Controller
{
    public function index()
{

    $totalAspirasi = Aspirasi::count();
    $totalPengaduan = Pengaduan::count();
    $totalPermintaan = Permintaan::count();

    return view('dashboard', [
        'totalAspirasi' => $totalAspirasi,
        'totalPengaduan' => $totalPengaduan,
        'totalPermintaan' => $totalPermintaan
    ]);
}

}
