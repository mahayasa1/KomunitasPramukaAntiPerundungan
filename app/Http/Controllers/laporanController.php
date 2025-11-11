<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Pengaduan;
use App\Models\Permintaan;

class LaporanController extends Controller
{
    public function index()
    {
        $aspirasis = Aspirasi::latest()->get();
        $pengaduans = Pengaduan::latest()->get();
        $permintaans = Permintaan::latest()->get();

        return view('laporan', compact('aspirasis', 'pengaduans', 'permintaans'));
    }
}
