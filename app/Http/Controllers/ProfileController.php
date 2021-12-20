<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('pages.admin.profile', [
            'item' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        $request->validate([
            'nama' => 'required|string|max:40',
        ]);

        if ($request->password) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()]
            ]);
        }

        if ($request->email != $user->email) {
            $request->validate([
                'email' => 'required|string|max:50|email|unique:users'
            ]);
        }

        $user->nama = $request->nama;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('dashboard');
    }

    public function update_akun(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        if (Auth::user()->role === 'MAHASISWA') {
            $item = Mahasiswa::where('user_id', Auth::user()->id)->first();
        }elseif (Auth::user()->role === 'ALUMNI') {
            $item = Alumni::where('user_id', Auth::user()->id)->first();
        }

        $request->validate([
            'nama' => 'required|string|max:40'
        ]);

        if (Auth::user()->role !== 'ADMIN') {
            $request->validate([
                'npm' => 'required|string|max:9'
            ]);
        }

        if ($request->password) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()]
            ]);
        }

        if ($request->foto) {
            $value = $request->file('foto');
            $extension = $value->extension();
            $imageNames = uniqid('img_', microtime()) . '.' . $extension;
            Storage::putFileAs('public/assets/foto-profil', $value, $imageNames);
            $thumbnailpath = storage_path('app/public/assets/foto-profil/' . $imageNames);
            $img = Image::make($thumbnailpath)->resize(600, 800)->save($thumbnailpath);
        }

        if (Auth::user()->role == 'ADMIN') {
            $user->email = $request->email;
        }
        $user->nama = $request->nama;
        if (Auth::user()->role !== 'ADMIN') {
            $user->npm = $request->npm;
        }
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if (Auth::user()->role !== 'ADMIN') {
            if ($request->foto) {
                $item->foto = $imageNames;
            }
            $item->save();
        }

        return redirect()->route('user.data-saya')->with(['success' => 'Berhasil Mengupdate Data Akun']);
    }

    public function data_pribadi(Request $request)
    {
        $request->validate([
            'agama' => 'required|string|max:10',
            'tempat_lahir' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:50',
            'no_hp' => 'required|string',
            'golongan_darah' => 'required|in:A,B,AB,O',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'angkatan' => 'required|numeric|digits:4',
        ]);

        if ($request->email !== Auth::user()->email) {
            $request->validate([
                'email' => 'required|string|max:255|email|unique:users'
            ]);
        }

        if (Auth::user()->role === 'ALUMNI') {
            $request->validate([
                'status' => 'required|in:Kawin,Belum Kawin',
                'asal_slta' => 'required|string|max:30',
                'ipk' => 'required|numeric|between:0.01,4.00',
            ]);
        }

        if (Auth::user()->role == 'MAHASISWA') {
            $item = Mahasiswa::where('user_id', Auth::user()->id)->first();
            $user = User::findOrFail(Auth::user()->id);

            $item->agama = $request->agama;
            $item->tempat_lahir = $request->tempat_lahir;
            $item->tanggal_lahir = $request->tanggal_lahir;
            $item->jenis_kelamin = $request->jenis_kelamin;
            $item->alamat = $request->alamat;
            $item->no_hp = $request->no_hp;
            $user->email = $request->email;
            $item->golongan_darah = $request->golongan_darah;
            $item->tinggi_badan = $request->tinggi_badan;
            $item->berat_badan = $request->berat_badan;
            $item->angkatan = $request->angkatan;
            $item->save();
            $user->save();
        }elseif (Auth::user()->role == 'ALUMNI') {
            $item = Alumni::where('user_id', Auth::user()->id)->first();
            $user = User::findOrFail(Auth::user()->id);

            $item->agama = $request->agama;
            $item->tempat_lahir = $request->tempat_lahir;
            $item->tanggal_lahir = $request->tanggal_lahir;
            $item->jenis_kelamin = $request->jenis_kelamin;
            $item->alamat = $request->alamat;
            $item->no_hp = $request->no_hp;
            $user->email = $request->email;
            $item->golongan_darah = $request->golongan_darah;
            $item->tinggi_badan = $request->tinggi_badan;
            $item->berat_badan = $request->berat_badan;
            $item->status = $request->status;
            $item->asal_slta = $request->asal_slta;
            $item->ipk = $request->ipk;
            $item->angkatan = $request->angkatan;
            $item->save();
            $user->save();
        }

        return redirect()->route('user.data-saya')->with(['success' => 'Berhasil Mengupdate Data Pribadi']);
    }

    public function data_orang_tua(Request $request)
    {
        $request->validate([
            'nama_ayah' => 'required|string|max:40',
            'nama_ibu' => 'required|string|max:40',
            'alamat_orang_tua' => 'required|string|max:50',
            'pekerjaan_ayah' => 'required|string|max:20',
            'pekerjaan_ibu' => 'required|string|max:20',
        ]);

        if (Auth::user()->role === 'ALUMNI') {
            $item = Alumni::where('user_id', Auth::user()->id)->first();
        }elseif (Auth::user()->role === 'MAHASISWA') {
            $item = Mahasiswa::where('user_id', Auth::user()->id)->first();
        }

        $item->nama_ayah = $request->nama_ayah;
        $item->nama_ibu = $request->nama_ibu;
        $item->alamat_orang_tua = $request->alamat_orang_tua;
        $item->pekerjaan_ayah = $request->pekerjaan_ayah;
        $item->pekerjaan_ibu = $request->pekerjaan_ibu;
        $item->save();

        return redirect()->route('user.data-saya')->with(['success' => 'Berhasil Mengupdate Data Orang Tua']);
    }

    public function data_skripsi(Request $request)
    {
        $request->validate([
            'judul_skripsi' => 'required|string|max:255',
            'bobot_sks' => 'required|numeric',
            'tanggal_seminar_proposal' => 'required|date',
            'tanggal_sidang' => 'required|date',
            'tanggal_wisuda' => 'required|date',
        ]);

        $item = Alumni::where('user_id', Auth::user()->id)->first();

        $item->judul_skripsi = $request->judul_skripsi;
        $item->bobot_sks = $request->bobot_sks;
        $item->tanggal_seminar_proposal = $request->tanggal_seminar_proposal;
        $item->tanggal_sidang = $request->tanggal_sidang;
        $item->tanggal_wisuda = $request->tanggal_wisuda;
        $item->save();

        return redirect()->route('user.data-saya')->with(['success' => 'Berhasil Mengupdate Data Skripsi']);
    }

    public function data_bimbingan_skripsi(Request $request)
    {
        $request->validate([
            'tanggal_mulai_bimbingan' => 'required|date',
            'dosen_pembimbing_1' => 'required|string|max:40',
            'dosen_pembimbing_2' => 'required|string|max:40',
            'dosen_penguji_1' => 'required|string|max:40',
            'dosen_penguji_2' => 'required|string|max:40',
            'jumlah_sks' => 'required|numeric|digits:3',
        ]);

        $item = Alumni::where('user_id', Auth::user()->id)->first();

        $item->tanggal_mulai_bimbingan = $request->tanggal_mulai_bimbingan;
        $item->dosen_pembimbing_1 = $request->dosen_pembimbing_1;
        $item->dosen_pembimbing_2 = $request->dosen_pembimbing_2;
        $item->dosen_penguji_1 = $request->dosen_penguji_1;
        $item->dosen_penguji_2 = $request->dosen_penguji_2;
        $item->jumlah_sks = $request->jumlah_sks;
        $item->save();

        return redirect()->route('user.data-saya')->with(['success' => 'Berhasil Mengupdate Data Bimbingan Skripsi']);
    }
}
