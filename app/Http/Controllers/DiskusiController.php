<?php

namespace App\Http\Controllers;

use App\Models\Diskusi;
use App\Models\DiskusiTanyaJawab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiskusiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Diskusi::all();

        return view('pages.admin.diskusi.index', [
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
        return view('pages.admin.diskusi.create');
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
            'isi' => 'required|string'
        ]);

        Diskusi::create([
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => '1',
        ]);

        return redirect()->route('diskusi.index')->with(['success' => 'Berhasil Menambah Diskusi']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diskusi  $diskusi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Diskusi::findOrFail($id);
        $tanya_jawab = DiskusiTanyaJawab::where('diskusi_id', $id)->get();

        return view('pages.admin.diskusi.show', [
            'item' => $item, 'tanya_jawabs' => $tanya_jawab
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diskusi  $diskusi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Diskusi::findOrFail($id);

        return view('pages.admin.diskusi.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diskusi  $diskusi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:50',
            'isi' => 'required|string'
        ]);

        $item = Diskusi::findOrFail($id);

        $item->update([
            'judul' => $request->judul,
            'isi' => $request->isi
        ]);

        return redirect()->route('diskusi.index')->with(['success' => 'Berhasil Mengubah Diskusi']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diskusi  $diskusi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Diskusi::findOrFail($id);

        $item->delete();

        return redirect()->route('diskusi.index')->with(['success' => 'Berhasil Mengubah Diskusi']);
    }

    public function set_aktif($id)
    {
        $item = Diskusi::findOrFail($id);

        $item->update([
            'status' => '1'
        ]);

        return redirect()->route('diskusi.index')->with(['success' => 'Berhasil Mengaktifkan Diskusi']);
    }

    public function set_non_aktif($id)
    {
        $item = Diskusi::findOrFail($id);

        $item->update([
            'status' => '0'
        ]);

        return redirect()->route('diskusi.index')->with(['success' => 'Berhasil Menonaktifkan Diskusi']);
    }
}
