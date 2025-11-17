<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{

    public function index(Request $request)
{
    $query = Aspirasi::query();

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

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }


    // 🔹 Filter tanggal
    if ($request->filled('start_date')) {
        $query->whereDate('created_at', '>=', $request->start_date);
    }
    if ($request->filled('end_date')) {
        $query->whereDate('created_at', '<=', $request->end_date);
    }

    $aspirasis = $query->latest()->paginate(10);

    return view('admin.aspirasi.index', compact('aspirasis'));
}


    public function show($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        return view('admin.aspirasi.show', compact('aspirasi'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'telp' => 'required|string',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'asal' => 'required|string',
            'instansi' => 'required|string',
            'lampiran' => 'nullable|file|mimes:pdf|max:2048',
            'is_anonymous' => 'nullable|boolean',
            'is_secret' => 'nullable|boolean'
        ]);

          if ($request->hasFile('lampiran')) {
        $file = $request->file('lampiran');
        $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
        $file->move(public_path('uploads/lampiran'), $fileName);

        // Simpan path relatif ke database
        $validated['lampiran'] = 'uploads/lampiran/' . $fileName;
    }

        $validated['is_anonymous'] = $request->has('is_anonymous');
        $validated['is_secret'] = $request->has('is_secret');

        $validated['status'] = 'pending';
        
        Aspirasi::create($validated);
        return back()->with('success', 'Aspirasi berhasil dikirim!');
    }

    
    public function updateStatusFromDetail($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
    
        $steps = ['pending', 'verification', 'follow-up', 'feedback', 'finish'];
    
        $currentIndex = array_search($aspirasi->status, $steps);
    
        if ($currentIndex !== false && $currentIndex < count($steps) - 1) {
            $aspirasi->status = $steps[$currentIndex + 1];
            $aspirasi->save();
        }
    
        return redirect()
            ->route('admin.aspirasi.index')
            ->with('success', 'Status aspirasi berhasil diperbarui!');
    }

}
