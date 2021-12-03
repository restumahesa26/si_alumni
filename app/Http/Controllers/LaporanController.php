<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index_mahasiswa()
    {
        $items = Mahasiswa::all();

        return view('pages.admin.laporan.mahasiswa.index', [
            'items' => $items
        ]);
    }

    public function pdf_mahasiswa()
    {
        $items = Mahasiswa::all();

        if ($items >= 1) {
            return view('pages.admin.laporan.mahasiswa.pdf', [
                'items' => $items
            ]);
        } else {
            return redirect()->back()->with(['error-pdf' => 'Data Kosong, Tidak Ada Yang Perlu Dicetak']);
        }
    }

    public function index_alumni()
    {
        $items = Alumni::all();

        return view('pages.admin.laporan.alumni.index', [
            'items' => $items
        ]);
    }

    public function pdf_keseluruhan_alumni()
    {
        $items = Alumni::all();

        if ($items >= 1) {
            return view('pages.admin.laporan.alumni.pdf', [
                'items' => $items
            ]);
        } else {
            return redirect()->back()->with(['error-pdf' => 'Data Kosong, Tidak Ada Yang Perlu Dicetak']);
        }
    }

    public function pdf_angkatan_alumni(Request $request)
    {
        $cari = $request->angkatan;
        $items = Alumni::where('angkatan', $cari)->get();

        if ($items->count() >= 1) {
            return view('pages.admin.laporan.alumni.pdf', [
                'items' => $items
            ]);
        } else {
            return redirect()->back()->with(['error-pdf' => 'Data Kosong, Tidak Ada Yang Perlu Dicetak']);
        }
    }

    public function pdf_tahun_lulus_alumni(Request $request)
    {
        $cari = $request->tahun_lulus;
        $items = Alumni::whereYear('tanggal_wisuda', $cari)->get();

        if ($items->count() >= 1) {
            return view('pages.admin.laporan.alumni.pdf', [
                'items' => $items
            ]);
        } else {
            return redirect()->back()->with(['error-pdf' => 'Data Kosong, Tidak Ada Yang Perlu Dicetak']);
        }
    }
}
