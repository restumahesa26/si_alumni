<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Diskusi;
use App\Models\Dosen;
use App\Models\Loker;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $mahasiswa = Mahasiswa::count();
        $alumni = Alumni::count();
        $loker = Loker::where('status', '1')->count();
        $diskusi = Diskusi::where('status', '1')->count();

        return view('pages.admin.dashboard', [
            'mahasiswa' => $mahasiswa,
            'alumni' => $alumni,
            'loker' => $loker,
            'diskusi' => $diskusi,
        ]);
    }
}
