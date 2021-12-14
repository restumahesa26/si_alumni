<?php

namespace App\Http\Controllers;

use App\Imports\AlumniImport;
use App\Models\Alumni;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Alumni::all();

        return view('pages.admin.data-alumni.index', [
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
        return view('pages.admin.data-alumni.create');
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
            'npm' => 'required|string|max:255|unique:users',
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
            'email' => 'required|string|max:255|email|unique:users',
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
            'ipk' => 'required|numeric',
            'angkatan' => 'required|numeric',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'pekerjaan' => 'required|string|max:255',
            'tempat_pekerjaan' => 'required|string|max:255',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'npm' => $request->npm,
            'role' => 'ALUMNI',
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Alumni::create([
            'user_id' => $user->id,
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
            'jumlah_sks' => $request->jumlah_sks,
            'ipk' => $request->ipk,
            'angkatan' => $request->angkatan,
            'pekerjaan' => $request->pekerjaan,
            'tempat_pekerjaan' => $request->tempat_pekerjaan,
        ]);

        return redirect()->route('data-alumni.index')->with(['success' => 'Berhasil Menambah Data Alumni ' . $request->nama]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function show(Alumni $alumni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Alumni::findOrFail($id);

        return view('pages.admin.data-alumni.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
            'pekerjaan' => 'required|string|max:255',
            'tempat_pekerjaan' => 'required|string|max:255',
            'jumlah_sks' => 'required|numeric',
            'ipk' => 'required|numeric',
            'angkatan' => 'required|numeric',
        ]);

        if ($request->password) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()]
            ]);
        }

        $item = Alumni::findOrFail($id);

        if ($request->email != $item->users->email) {
            $request->validate([
                'email' => 'required|string|max:255|email|unique:users'
            ]);
        }

        if ($request->npm != $item->users->npm) {
            $request->validate([
                'npm' => 'required|string|max:255|unique:users'
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
            'jumlah_sks' => $request->jumlah_sks,
            'ipk' => $request->ipk,
            'angkatan' => $request->angkatan,
            'pekerjaan' => $request->pekerjaan,
            'tempat_pekerjaan' => $request->tempat_pekerjaan,
        ]);

        return redirect()->route('data-alumni.index')->with(['success' => 'Berhasil Mengubah Data Alumni ' . $request->nama]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Alumni::findOrFail($id);
        $idd = $item->user_id;

        $item->forceDelete();

        $user = User::where('id', $idd)->first();
        $nama = $user->nama;

        $user->forceDelete();

        return redirect()->route('data-alumni.index')->with(['success' => 'Berhasil Menambah Data Mahasiswa ' . $nama]);
    }

    public function change_to_mahasiswa($id)
    {
        $item = Alumni::findOrFail($id);

        Mahasiswa::create([
            'user_id' => $item->user_id,
            'agama' => $item->agama,
            'tempat_lahir' => $item->tempat_lahir,
            'tanggal_lahir' => $item->tanggal_lahir,
            'jenis_kelamin' => $item->jenis_kelamin,
            'alamat' => $item->alamat,
            'nama_ayah' => $item->nama_ayah,
            'nama_ibu' => $item->nama_ibu,
            'alamat_orang_tua' => $item->alamat_orang_tua,
            'pekerjaan_ayah' => $item->pekerjaan_ayah,
            'pekerjaan_ibu' => $item->pekerjaan_ibu,
            'no_hp' => $item->no_hp,
            'golongan_darah' => $item->golongan_darah,
            'tinggi_badan' => $item->tinggi_badan,
            'berat_badan' => $item->berat_badan,
            'angkatan' => $item->angkatan
        ]);

        $user = User::where('id', $item->user_id)->first();
        $user->role = 'MAHASISWA';
        $user->save();

        $item->delete();

        return redirect()->route('data-mahasiswa.index')->with(['success' => 'Berhasil Memindah Data ke Data Mahasiswa ' . $user->nama]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        Excel::import(new AlumniImport, $file);

        return redirect()->route('data-alumni.index')->with(['success' => 'Berhasil Mengimport Data Alumni']);
    }
}
