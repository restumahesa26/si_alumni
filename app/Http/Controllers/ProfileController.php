<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function edit()
    {
        if (Auth::user()->role == 'ALUMNI') {
            $item = Alumni::where('user_id', Auth::user()->id)->first();
        } elseif (Auth::user()->role == 'MAHASISWA') {
            $item = Mahasiswa::where('user_id', Auth::user()->id)->first();
        }

        return view('pages.admin.profile', [
            'item' => $item
        ]);
    }

    public function update(Request $request)
    {
        if (Auth::user()->role == 'ALUMNI') {

            $request->validate([
                'nama' => 'required|string|max:255',
                'agama' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:L,P',
                'alamat' => 'required|string|max:255',
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'alamat_orang_tua' => 'required|string|max:255',
                'pekerjaan_ayah' => 'required|string|max:255',
                'pekerjaan_ibu' => 'required|string|max:255',
                'no_hp' => 'required|numeric',
                'golongan_darah' => 'required|in:A,B,AB,O',
                'tinggi_badan' => 'required|numeric',
                'berat_badan' => 'required|numeric',
                'status' => 'required|in:Kawin,Belum Kawin',
                'judul_skripsi' => 'required|string|max:255',
                'asal_slta' => 'required|string|max:255',
                'tanggal_wisuda' => 'required|date',
                'tanggal_sidang' => 'required|date',
                'bobot_sks' => 'required|numeric',
                'tanggal_seminar_proposal' => 'required|date',
                'tanggal_mulai_bimbingan' => 'required|date',
                'dosen_pembimbing_1' => 'required|string|max:255',
                'dosen_pembimbing_2' => 'required|string|max:255',
                'dosen_penguji_1' => 'required|string|max:255',
                'dosen_penguji_2' => 'required|string|max:255',
                'jumlah_sks' => 'required|numeric',
            ]);

            if ($request->password) {
                $request->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()]
                ]);
            }

            $item = Alumni::where('user_id', Auth::user()->id)->first();

            if ($request->email != $item->users->email && $request->npm != $item->npm) {
                $request->validate([
                    'email' => 'required|string|max:255|email|unique:users',
                    'npm' => 'required|string|max:255|unique:alumnis',
                ]);
            }

            $user = User::where('id', $item->user_id)->first();
            $user->nama = $request->nama;
            $user->npm = $request->npm;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            $item->update([
                'user_id' => Auth::user()->id,
                'npm' => $request->npm,
                'nama' => $request->nama,
                'agama' => $request->agama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'alamat_orang_tua' => $request->alamat_orang_tua,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'no_hp' => $request->no_hp,
                'golongan_darah' => $request->golongan_darah,
                'tinggi_badan' => $request->tinggi_badan,
                'berat_badan' => $request->berat_badan,
                'status' => $request->status,
                'judul_skripsi' => $request->judul_skripsi,
                'asal_slta' => $request->asal_slta,
                'tanggal_wisuda' => $request->tanggal_wisuda,
                'tanggal_sidang' => $request->tanggal_sidang,
                'bobot_sks' => $request->bobot_sks,
                'tanggal_seminar_proposal' => $request->tanggal_seminar_proposal,
                'tanggal_mulai_bimbingan' => $request->tanggal_mulai_bimbingan,
                'dosen_pembimbing_1' => $request->dosen_pembimbing_1,
                'dosen_pembimbing_2' => $request->dosen_pembimbing_2,
                'dosen_penguji_1' => $request->dosen_penguji_1,
                'dosen_penguji_2' => $request->dosen_penguji_2,
                'jumlah_sks' => $request->jumlah_sks
            ]);
        } elseif (Auth::user()->role == 'MAHASISWA') {

            $request->validate([
                'nama' => 'required|string|max:255',
                'agama' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:L,P',
                'alamat' => 'required|string|max:255',
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'alamat_orang_tua' => 'required|string|max:255',
                'pekerjaan_ayah' => 'required|string|max:255',
                'pekerjaan_ibu' => 'required|string|max:255',
                'no_hp' => 'required|numeric',
                'golongan_darah' => 'required|in:A,B,AB,O',
                'tinggi_badan' => 'required|numeric',
                'berat_badan' => 'required|numeric',
            ]);

            if ($request->password) {
                $request->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()]
                ]);
            }

            $item = Mahasiswa::where('user_id', Auth::user()->id)->first();

            if ($request->email != $item->users->email && $request->npm != $item->npm) {
                $request->validate([
                    'email' => 'required|string|max:255|email|unique:users',
                    'npm' => 'required|string|max:255|unique:mahasiswas'
                ]);
            }

            $user = User::where('id', Auth::user()->id)->first();
            $user->nama = $request->nama;
            $user->npm = $request->npm;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            $item->update([
                'user_id' =>  Auth::user()->id,
                'npm' => $request->npm,
                'nama' => $request->nama,
                'agama' => $request->agama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'alamat_orang_tua' => $request->alamat_orang_tua,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'no_hp' => $request->no_hp,
                'golongan_darah' => $request->golongan_darah,
                'tinggi_badan' => $request->tinggi_badan,
                'berat_badan' => $request->berat_badan,
            ]);
        }

        return redirect()->route('dashboard');
    }
}
