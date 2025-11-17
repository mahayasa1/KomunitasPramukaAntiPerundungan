<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Aspirasi;
use App\Models\Permintaan;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function find(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'telp'  => 'required'
        ]);

        // Ambil semua laporan berdasarkan email + telp
        $pengaduan  = Pengaduan::where('email', $request->email)->where('telp', $request->telp)->get();
        $aspirasi   = Aspirasi::where('email', $request->email)->where('telp', $request->telp)->get();
        $permintaan = Permintaan::where('email', $request->email)->where('telp', $request->telp)->get();

        // Gabungkan hasil ke 1 collection
        $results = $this->combineResults($pengaduan, $aspirasi, $permintaan);

        if ($results->isEmpty()) {
            return view('search', [
                'not_found' => true
            ]);
        }

        return view('search', [
            'results' => $results
        ]);
    }

    // ======================
    // 🔥 DETAIL PAGE FIXED
    // ======================
    public function detail($type, $id)
    {
        // Ambil laporan berdasarkan jenis
        if ($type == 'pengaduan') {
            $laporan = Pengaduan::findOrFail($id);
        } elseif ($type == 'aspirasi') {
            $laporan = Aspirasi::findOrFail($id);
        } else {
            $laporan = Permintaan::findOrFail($id);
        }

        // Ambil lagi seluruh laporan berdasarkan email+telp
        $email = $laporan->email;
        $telp  = $laporan->telp;

        $pengaduan  = Pengaduan::where('email', $email)->where('telp', $telp)->get();
        $aspirasi   = Aspirasi::where('email', $email)->where('telp', $telp)->get();
        $permintaan = Permintaan::where('email', $email)->where('telp', $telp)->get();

        // Gabungkan ulang untuk menampilkan tabel di atas
        $results = $this->combineResults($pengaduan, $aspirasi, $permintaan);

        return view('search', [
            'laporan' => $laporan,
            'jenis'   => ucfirst($type),
            'results' => $results
        ]);
    }

    // ================================
    // 🔧 HELPER PENGGABUNG HASIL
    // ================================
    private function combineResults($pengaduan, $aspirasi, $permintaan)
    {
        $results = collect();

        foreach ($pengaduan as $p) {
            $results->push([
                'type' => 'pengaduan',
                'data' => $p
            ]);
        }

        foreach ($aspirasi as $a) {
            $results->push([
                'type' => 'aspirasi',
                'data' => $a
            ]);
        }

        foreach ($permintaan as $pm) {
            $results->push([
                'type' => 'permintaan',
                'data' => $pm
            ]);
        }

        return $results;
    }
}
