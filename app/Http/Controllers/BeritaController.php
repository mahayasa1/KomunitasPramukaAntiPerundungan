<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $keyword    = $request->keyword;
        $start_date = $request->start_date;
        $end_date   = $request->end_date;

        $query = Berita::query();

        // Filter: Keyword
        if (!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%");
        }

        // Filter tanggal
        if (!empty($start_date)) {
            $query->whereDate('created_at', '>=', $start_date);
        }
        if (!empty($end_date)) {
            $query->whereDate('created_at', '<=', $end_date);
        }

        $berita = $query->latest()->paginate(10)->appends($request->all());

        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required',
            'content'   => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $thumbnailPath = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('berita', 'public');
        }

        Berita::create([
            'title'     => $request->title,
            'slug'      => Str::slug($request->title) . '-' . uniqid(),
            'thumbnail' => $thumbnailPath,
            'content'   => $request->input('content'),
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diupload!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'     => 'required',
            'content'   => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $berita = Berita::findOrFail($id);

        // Jika ada upload thumbnail baru
        if ($request->hasFile('thumbnail')) {

            // Hapus thumbnail lama (jika ada)
            if ($berita->thumbnail && Storage::disk('public')->exists($berita->thumbnail)) {
                Storage::disk('public')->delete($berita->thumbnail);
            }

            $path = $request->file('thumbnail')->store('berita', 'public');
            $berita->thumbnail = $path;
        }

        $berita->title   = $request->title;
        $berita->slug    = Str::slug($request->title) . '-' . uniqid();
        $berita->content = $request->input('content');
        $berita->save();

        return redirect()->route('admin.berita.index')
                            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus thumbnail dari storage
        if ($berita->thumbnail && Storage::disk('public')->exists($berita->thumbnail)) {
            Storage::disk('public')->delete($berita->thumbnail);
        }

        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus!');
    }

    // CKEDITOR IMAGE UPLOAD
    public function ckeditorUpload(Request $request)
    {
        if ($request->hasFile('upload')) {

            $request->validate([
                'upload' => 'image|mimes:jpg,jpeg,png,webp,gif|max:20480'
            ]);

            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            $url = asset('uploads/' . $filename);

            return response()->json([
                'uploaded' => true,
                'fileName' => $filename,
                'url' => $url
            ]);
        }
    }

    // Untuk halaman user
    public function userIndex()
    {
        $berita = Berita::latest()->paginate(6);
        return view('berita.index', compact('berita'));
    }

    public function userShow($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('berita.show', compact('berita'));
    }
}
