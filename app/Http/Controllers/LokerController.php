<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\LokerTanyaJawab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LokerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Loker::all();

        return view('pages.admin.loker.index', [
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
        return view('pages.admin.loker.create');
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
            'jenis_pekerjaan' => 'required|string|max:30',
            'tempat_kerja' => 'required|string|max:50',
            'lokasi_kerja' => 'required|string|max:20',
            'isi' => 'required|string'
        ]);

        Loker::create([
            'user_id' => Auth::user()->id,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'tempat_kerja' => $request->tempat_kerja,
            'lokasi_kerja' => $request->lokasi_kerja,
            'isi' => $request->isi,
            'status' => '1',
        ]);

        return redirect()->route('loker.index')->with(['success' => 'Berhasil Menambah Lowongan Pekerjaan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loker  $loker
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Loker::findOrFail($id);
        $tanya_jawab = LokerTanyaJawab::where('loker_id', $id)->get();

        return view('pages.admin.loker.show', [
            'item' => $item, 'tanya_jawabs' => $tanya_jawab
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loker  $loker
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Loker::findOrFail($id);

        return view('pages.admin.loker.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loker  $loker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_pekerjaan' => 'required|string|max:30',
            'tempat_kerja' => 'required|string|max:50',
            'lokasi_kerja' => 'required|string|max:20',
            'isi' => 'required|string'
        ]);

        $item = Loker::findOrFail($id);

        $item->update([
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'tempat_kerja' => $request->tempat_kerja,
            'lokasi_kerja' => $request->lokasi_kerja,
            'isi' => $request->isi
        ]);

        return redirect()->route('loker.index')->with(['success' => 'Berhasil Mengubah Lowongan Pekerjaan']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loker  $loker
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Loker::findOrFail($id);

        $item->delete();

        return redirect()->route('loker.index')->with(['success' => 'Berhasil Menghapus Lowongan Pekerjaan']);
    }

    public function set_aktif($id)
    {
        $item = Loker::findOrFail($id);

        $item->update([
            'status' => '1'
        ]);

        return redirect()->route('loker.index')->with(['success' => 'Berhasil Mengaktifkan Lowongan Pekerjaan']);
    }

    public function set_non_aktif($id)
    {
        $item = Loker::findOrFail($id);

        $item->update([
            'status' => '0'
        ]);

        return redirect()->route('loker.index')->with(['success' => 'Berhasil Menonaktifkan Lowongan Pekerjaan']);
    }
}
