<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
   public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'email' => 'required|string',
        'telp' => 'required|string', 
        'judul' => 'required|string|max:255',
        'isi' => 'required|string',
        'tanggal_pengaduan' => 'required|date',
        'lokasi' => 'required|string',
        'instansi' => 'required|string',
        'lampiran' => 'nullable|file|mimes:pdf|max:20480', // max 10MB
        'is_anonymous' => 'nullable|boolean',
        'is_secret' => 'nullable|boolean'
    ]);

    // ==== upload file ====
    if ($request->hasFile('lampiran')) {
        $file = $request->file('lampiran');
        $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
        $file->move(public_path('uploads/lampiran'), $fileName);

        // Simpan path relatif ke database
        $validated['lampiran'] = 'uploads/lampiran/' . $fileName;
    }

    // ==== checkbox ====
    $validated['is_anonymous'] = $request->boolean('is_anonymous');
    $validated['is_secret'] = $request->boolean('is_secret');

    // ==== simpan data ====
    Pengaduan::create($validated);

    return back()->with('success', 'Pengaduan berhasil dikirim!');
}

}
