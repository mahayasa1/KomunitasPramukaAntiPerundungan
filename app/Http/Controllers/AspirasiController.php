<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
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
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/lampiran'), $fileName);
        $validated['lampiran'] = 'uploads/lampiran/' . $fileName;
    }

        $validated['is_anonymous'] = $request->has('is_anonymous');
        $validated['is_secret'] = $request->has('is_secret');
        
        Aspirasi::create($validated);
        return back()->with('success', 'Aspirasi berhasil dikirim!');
    }
}
