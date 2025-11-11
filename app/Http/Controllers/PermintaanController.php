<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;

class PermintaanController extends Controller
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
            'lampiran' => 'nullable|file|mimes:pdf|max:20480',    
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


        Permintaan::create($validated);
        return back()->with('success', 'Permintaan informasi berhasil dikirim!');
    }

    
}
