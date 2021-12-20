<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\BeritaKomentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Berita::all();

        return view('pages.admin.berita.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:50',
            'isi' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $value = $request->file('thumbnail');
        $extension = $value->extension();
        $imageNames = uniqid('img_', microtime()) . '.' . $extension;
        Storage::putFileAs('public/assets/berita-thumbnail', $value, $imageNames);
        $thumbnailpath = storage_path('app/public/assets/berita-thumbnail/' . $imageNames);
        $img = Image::make($thumbnailpath)->resize(800, 600)->save($thumbnailpath);

        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'thumbnail' => $imageNames
        ]);

        return redirect()->route('berita.index')->with(['success' => 'Berhasil Menambah Berita']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Berita::findOrFail($id);
        $komentar = BeritaKomentar::where('berita_id', $id)->get();

        return view('pages.admin.berita.show', [
            'item' => $item, 'komentars' => $komentar
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Berita::findOrFail($id);

        return view('pages.admin.berita.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:50',
            'isi' => 'required|string'
        ]);

        $item = Berita::findOrFail($id);

        if($request->file('thumbnail')){
            $value = $request->file('thumbnail');
            $extension = $value->extension();
            $imageNames = uniqid('img_', microtime()) . '.' . $extension;
            Storage::putFileAs('public/assets/berita-thumbnail', $value, $imageNames);
            $thumbnailpath = storage_path('app/public/assets/berita-thumbnail/' . $imageNames);
            $img = Image::make($thumbnailpath)->resize(800, 600)->save($thumbnailpath);
        }else {
            $imageNames = $item->thumbnail;
        }

        $item->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'thumbnail' => $imageNames
        ]);

        return redirect()->route('berita.index')->with(['success' => 'Berhasil Mengubah Berita']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Berita::findOrFail($id);

        $item->delete();

        return redirect()->route('berita.index')->with(['success' => 'Berhasil Menghapus Berita']);
    }

    public function set_populer($id)
    {
        $item = Berita::findOrFail($id);

        $item->is_populer = '1';
        $item->save();

        return redirect()->route('berita.index')->with(['success' => 'Berhasil Mengset Populer']);
    }

    public function set_non_populer($id)
    {
        $item = Berita::findOrFail($id);

        $item->is_populer = '0';
        $item->save();

        return redirect()->route('berita.index')->with(['success' => 'Berhasil Mengset Tidak Populer']);
    }
}
