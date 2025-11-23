<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index(Request $request)
{
    // ambil semua input filter
    $keyword     = $request->keyword;
    $start_date  = $request->start_date;
    $end_date    = $request->end_date;
    $kategori    = $request->kategori;

    // query dasar
    $query = Berita::query();

    // Filter: Keyword judul
    if (!empty($keyword)) {
        $query->where('title', 'LIKE', "%{$keyword}%");
    }

    // Filter: Tanggal Awal
    if (!empty($start_date)) {
        $query->whereDate('created_at', '>=', $start_date);
    }

    // Filter: Tanggal Akhir
    if (!empty($end_date)) {
        $query->whereDate('created_at', '<=', $end_date);
    }

    // Pagination
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
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path = $request->file('thumbnail')?->store('berita', 'public');

        Berita::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
            'thumbnail' => $path,
            'content' => $request->input('content'),
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diupload!');
    }


    public function edit($id)
    {
        $berita = berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $berita = Berita::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('berita', 'public');
            $berita->thumbnail = $path;
        }

        $berita->slug = Str::slug($request->title) . '-' . uniqid();
        $berita->title = $request->title;
        $berita->content = $request->input('content');
        $berita->save();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        Berita::findOrFail($id)->delete();
        return back()->with('success', 'Berita berhasil dihapus');
    }

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
