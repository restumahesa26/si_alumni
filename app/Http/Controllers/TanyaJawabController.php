<?php

namespace App\Http\Controllers;

use App\Models\BeritaKomentar;
use App\Models\DiskusiTanyaJawab;
use App\Models\LokerTanyaJawab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanyaJawabController extends Controller
{
    public function tanya_jawab_loker(Request $request, $id)
    {
        $request->validate([
            'tanya_jawab' => 'required|string'
        ]);

        LokerTanyaJawab::create([
            'user_id' => Auth::user()->id,
            'loker_id' => $id,
            'tanya_jawab' => $request->tanya_jawab
        ]);

        return redirect()->route('loker.show', $id);
    }

    public function hapus_tanya_jawab_loker($id)
    {
        $item = LokerTanyaJawab::findOrFail($id);

        if ($item->user_id === Auth::user()->id) {
            $item->delete();

            return redirect()->back();
        }else {
            return redirect()->back();
        }
    }

    public function tanya_jawab_diskusi(Request $request, $id)
    {
        $request->validate([
            'tanya_jawab' => 'required|string'
        ]);

        DiskusiTanyaJawab::create([
            'user_id' => Auth::user()->id,
            'diskusi_id' => $id,
            'tanya_jawab' => $request->tanya_jawab
        ]);

        return redirect()->route('diskusi.show', $id);
    }

    public function hapus_tanya_jawab_diskusi($id)
    {
        $item = DiskusiTanyaJawab::findOrFail($id);

        if ($item->user_id === Auth::user()->id) {
            $item->delete();

            return redirect()->back();
        }else {
            return redirect()->back();
        }
    }

    public function komentar_berita(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required|string'
        ]);

        BeritaKomentar::create([
            'user_id' => Auth::user()->id,
            'berita_id' => $id,
            'komentar' => $request->komentar
        ]);

        return redirect()->route('berita.show', $id);
    }

    public function hapus_komentar_berita($id)
    {
        $item = BeritaKomentar::findOrFail($id);

        if ($item->user_id === Auth::user()->id) {
            $item->delete();

            return redirect()->back();
        }else {
            return redirect()->back();
        }
    }
}
