<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    public function index(Request $request)
    {
         $query = Permintaan::query();

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

    $permintaans = $query->latest()->paginate(10);

    return view('admin.permintaan.index', compact('permintaans'));
}

     public function show($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        return view('admin.permintaan.show', compact('permintaan'));
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
            'lampiran' => 'nullable|file|mimes:pdf|max:20480',    
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


        Permintaan::create($validated);
        return back()->with('success', 'Permintaan informasi berhasil dikirim!');
    }

    public function destroy($id)
    {
        Permintaan::findOrFail($id)->delete();
        return back()->with('success', 'Permintaan berhasil dihapus');
    }

    
     public function updateStatusFromDetail($id)
    {
        $permintaan = Permintaan::findOrFail($id);
    
        $steps = ['pending', 'verification', 'follow-up', 'feedback', 'finish'];
    
        $currentIndex = array_search($permintaan->status, $steps);
    
        if ($currentIndex !== false && $currentIndex < count($steps) - 1) {
            $permintaan->status = $steps[$currentIndex + 1];
            $permintaan->save();
        }
    
        return redirect()
            ->route('admin.permintaan.index')
            ->with('success', 'Status permintaan berhasil diperbarui!');
    }
}
