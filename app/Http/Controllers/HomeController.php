<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Berita;
use App\Models\Diskusi;
use App\Models\DiskusiTanyaJawab;
use App\Models\Loker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $berita = Berita::all();
        $alumniLaki = Alumni::where('jenis_kelamin', 'L')->count();
        $alumniPerempuan = Alumni::where('jenis_kelamin', 'P')->count();

        return view('pages.user.home', [
            'beritas' => $berita, 'laki' => $alumniLaki, 'perempuan' => $alumniPerempuan
        ]);
    }

    public function daftar_alumni()
    {
        $alumniLaki = Alumni::where('jenis_kelamin', 'L')->count();
        $alumniPerempuan = Alumni::where('jenis_kelamin', 'P')->count();
        $alumni = Alumni::all();

        return view('pages.user.daftar-alumni', [
            'laki' => $alumniLaki, 'perempuan' => $alumniPerempuan, 'alumnis' => $alumni
        ]);
    }

    public function berita()
    {
        $berita = Berita::all();

        return view('pages.user.berita', [
            'beritas' => $berita
        ]);
    }

    public function detail_berita($id)
    {
        $berita = Berita::findOrFail($id);

        return view('pages.user.detail-berita', [
            'berita' => $berita
        ]);
    }

    public function loker()
    {
        $loker = Loker::all();
        $loker2 = Loker::orderBy('created_at', 'DESC')->get();

        return view('pages.user.loker', [
            'lokers' => $loker, 'loker2' => $loker2
        ]);
    }

    public function detail_loker($id)
    {
        $loker = Loker::findOrFail($id);
        $loker2 = Loker::orderBy('created_at', 'DESC')->get();

        return view('pages.user.detail-loker', [
            'loker' => $loker, 'loker2' => $loker2
        ]);
    }

    public function diskusi()
    {
        $diskusi = Diskusi::orderBy('created_at', 'DESC')->get();

        return view('pages.user.diskusi', [
            'diskusis' => $diskusi
        ]);
    }

    public function detail_diskusi($id)
    {
        $diskusi = Diskusi::findOrFail($id);
        $tanya_jawab = DiskusiTanyaJawab::where('diskusi_id', $id)->orderBy('created_at', 'DESC')->get();

        return view('pages.user.detail-diskusi', [
            'diskusi' => $diskusi, 'tanya_jawabs' => $tanya_jawab
        ]);
    }

    public function kirim_jawaban_diskusi(Request $request, $id)
    {
        $request->validate([
            'tanya_jawab' => 'required|string|max:255'
        ]);

        DiskusiTanyaJawab::create([
            'user_id' => Auth::user()->id,
            'diskusi_id' => $id,
            'tanya_jawab' => $request->tanya_jawab
        ]);

        return redirect()->route('user.detail-diskusi', $id);
    }

    public function hapus_jawaban_diskusi($id)
    {
        $item = DiskusiTanyaJawab::findOrFail($id);

        if ($item->user_id === Auth::user()->id) {
            $item->delete();

            return redirect()->back();
        }else {
            return redirect()->back();
        }
    }
}
