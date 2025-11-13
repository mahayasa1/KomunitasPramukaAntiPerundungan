<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{

    public function index(Request $request)
    {
        $query = Pengaduan::query();

    // 🔹 Filter keyword (nama atau judul)
    if ($request->filled('keyword')) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', "%{$request->keyword}%")
            ->orWhere('judul', 'like', "%{$request->keyword}%");
        });
    }

    // 🔹 Filter jenis laporan
    if ($request->filled('jenis')) {
        if ($request->jenis === 'anonim') {
            $query->where('is_anonymous', true);
        } elseif ($request->jenis === 'rahasia') {
            $query->where('is_secret', true);
        } elseif ($request->jenis === 'biasa') {
            $query->where('is_anonymous', false)->where('is_secret', false);
        }
    }

    // 🔹 Filter tanggal
    if ($request->filled('start_date')) {
        $query->whereDate('created_at', '>=', $request->start_date);
    }
    if ($request->filled('end_date')) {
        $query->whereDate('created_at', '<=', $request->end_date);
    }

    $pengaduans = $query->latest()->paginate(10);

    return view('admin.pengaduan.index', compact('pengaduans'));
}
     public function show($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }
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

    return redirect()->back()->with('success', 'Laporan berhasil dikirim!');


}

}
