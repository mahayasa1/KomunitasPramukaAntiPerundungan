<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Aspirasi;
use App\Models\Permintaan;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'aspirasis' => Aspirasi::latest()->get(),
            'pengaduans' => Pengaduan::latest()->get(),
            'permintaans' => Permintaan::latest()->get(),
        ]);
    }
}
