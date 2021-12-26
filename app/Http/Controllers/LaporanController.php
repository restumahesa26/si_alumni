<?php

namespace App\Http\Controllers;

use App\Exports\AlumniExport;
use App\Exports\MahasiswaExport;
use App\Models\Alumni;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index_mahasiswa()
    {
        $items = Mahasiswa::oldest()->get();

        return view('pages.admin.laporan.mahasiswa.index', [
            'items' => $items
        ]);
    }

    public function pdf_mahasiswa()
    {
        $items = Mahasiswa::oldest()->get();

        if ($items->count() >= 1) {
            return view('pages.admin.laporan.mahasiswa.pdf', [
                'items' => $items
            ]);
        } else {
            return redirect()->back()->with(['error-pdf' => 'Data Kosong, Tidak Ada Yang Perlu Dicetak']);
        }
    }

    public function index_alumni()
    {
        $items = Alumni::oldest()->get();

        return view('pages.admin.laporan.alumni.index', [
            'items' => $items
        ]);
    }

    public function pdf_keseluruhan_alumni()
    {
        $items = Alumni::oldest()->get();

        if ($items->count() >= 1) {
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
        $items = Alumni::where('angkatan', $cari)->oldest()->get();

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
        $items = Alumni::whereYear('tanggal_wisuda', $cari)->oldest()->get();

        if ($items->count() >= 1) {
            return view('pages.admin.laporan.alumni.pdf', [
                'items' => $items
            ]);
        } else {
            return redirect()->back()->with(['error-pdf' => 'Data Kosong, Tidak Ada Yang Perlu Dicetak']);
        }
    }

    public function excel_mahasiswa()
    {
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }

    public function excel_alumni()
    {
        return Excel::download(new AlumniExport, 'alumni.xlsx');
    }
}
