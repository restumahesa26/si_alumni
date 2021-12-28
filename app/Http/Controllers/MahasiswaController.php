<?php

namespace App\Http\Controllers;

use App\Imports\MahasiswaImport;
use App\Models\Alumni;
use App\Models\BeritaKomentar;
use App\Models\Diskusi;
use App\Models\DiskusiTanyaJawab;
use App\Models\LokerTanyaJawab;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\ImageManagerStatic as Image;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Mahasiswa::latest()->get();

        return view('pages.admin.data-mahasiswa.index', [
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
        return view('pages.admin.data-mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'npm' => 'required|string|max:9|min:9',
            'nama' => 'required|string|max:40',
            'agama' => 'required|string|max:10',
            'tempat_lahir' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:40',
            'nama_ibu' => 'required|string|max:40',
            'alamat_orang_tua' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:20',
            'pekerjaan_ibu' => 'required|string|max:20',
            'no_hp' => 'required|numeric',
            'email' => 'required|string|max:50|email|unique:users',
            'golongan_darah' => 'required|in:A,B,AB,O',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'angkatan' => 'required|string|digits:4',
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'numeric' => 'Field :attribute harus berupa angka',
            'max' => 'Field :attribute maksimal :max',
            'min' => 'Field :attribute maksimal :min',
            'digits' => 'Field :attribute harus :digits digit',
            'email' => 'Field :attribute harus berupa email',
            'unique' => 'Field :attribute harus unik',
            'confirmed' => 'Konfirmasi password tidak cocok',
            'date' => 'Field :attribute harus berupa tanggal',
        ];

        $this->validate($request, $rules, $customMessages);

        if ($request->foto) {
            $value = $request->file('foto');
            $extension = $value->extension();
            $imageNames = uniqid('img_', microtime()) . '.' . $extension;
            Storage::putFileAs('public/assets/foto-profil', $value, $imageNames);
            $thumbnailpath = storage_path('app/public/assets/foto-profil/' . $imageNames);
            $img = Image::make($thumbnailpath)->resize(600, 800)->save($thumbnailpath);
        }else{
            $imageNames = '';
        }

        $user = User::create([
            'nama' => $request->nama,
            'npm' => $request->npm,
            'role' => 'MAHASISWA',
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Mahasiswa::create([
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
            'angkatan' => $request->angkatan,
            'foto' => $imageNames
        ]);

        return redirect()->route('data-mahasiswa.index')->with(['success' => 'Berhasil Menambah Data Mahasiswa ' . $request->nama]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Mahasiswa::findorFail($id);

        return view('pages.admin.data-mahasiswa.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules1 = [
            'nama' => 'required|string|max:40',
            'agama' => 'required|string|max:10',
            'tempat_lahir' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:40',
            'nama_ibu' => 'required|string|max:40',
            'alamat_orang_tua' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:20',
            'pekerjaan_ibu' => 'required|string|max:20',
            'no_hp' => 'required|numeric',
            'golongan_darah' => 'required|in:A,B,AB,O',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'angkatan' => 'required|string|digits:4',
        ];

        $rules2 = [
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ];

        $rules3 = [
            'email' => 'required|string|max:255|email|unique:users'
        ];

        $rules4 = [
            'npm' => 'required|string|max:9|min:9|unique:users'
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'numeric' => 'Field :attribute harus berupa angka',
            'max' => 'Field :attribute maksimal :max',
            'min' => 'Field :attribute maksimal :min',
            'digits' => 'Field :attribute harus :digits digit',
            'email' => 'Field :attribute harus berupa email',
            'unique' => 'Field :attribute harus unik',
            'confirmed' => 'Konfirmasi password tidak cocok',
            'date' => 'Field :attribute harus berupa tanggal',
        ];

        $this->validate($request, $rules1, $customMessages);

        if ($request->password) {
            $this->validate($request, $rules2, $customMessages);
        }

        $item = Mahasiswa::findOrFail($id);

        if ($request->foto) {
            $value = $request->file('foto');
            $extension = $value->extension();
            $imageNames = uniqid('img_', microtime()) . '.' . $extension;
            Storage::putFileAs('public/assets/foto-profil', $value, $imageNames);
            $thumbnailpath = storage_path('app/public/assets/foto-profil/' . $imageNames);
            $img = Image::make($thumbnailpath)->resize(600, 800)->save($thumbnailpath);
        }else{
            $imageNames = $item->foto;
        }

        if ($request->email != $item->users->email) {
            $this->validate($request, $rules3, $customMessages);
        }

        if ($request->npm != $item->users->npm) {
            $this->validate($request, $rules4, $customMessages);
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
            'angkatan' => $request->angkatan,
            'foto' => $imageNames,
        ]);

        return redirect()->route('data-mahasiswa.index')->with(['success' => 'Berhasil Mengubah Data Mahasiswa ' . $request->nama]);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Mahasiswa::findOrFail($id);
        $idd = $item->user_id;

        $check = BeritaKomentar::where('user_id', $idd)->first();
        $check2 = DiskusiTanyaJawab::where('user_id', $idd)->first();
        $check3 = LokerTanyaJawab::where('user_id', $idd)->first();
        $check4 = Diskusi::where('user_id', $idd)->first();

        if ($check || $check2 || $check3 || $check4) {
            return redirect()->back()->with(['error' => 'Data Mahasiswa Tidak Bisa Dihapus']);
        } else {
            $item->forceDelete();

            $user = User::where('id', $idd)->first();
            $nama = $user->nama;

            $user->forceDelete();

            return redirect()->route('data-mahasiswa.index')->with(['success' => 'Berhasil Menghapus Data Mahasiswa ' . $nama]);
        }
    }

    public function change_to_alumni($id)
    {
        $item = Mahasiswa::findOrFail($id);

        if ($item->agama != NULL || $item->tempat_lahir != NULL || $item->tanggal_lahir != NULL || $item->jenis_kelamin != NULL || $item->alamat != NULL || $item->nama_ayah != NULL || $item->nama_ibu != NULL || $item->alamat_orang_tua != NULL || $item->pekerjaan_ayah != NULL || $item->pekerjaan_ibu != NULL || $item->no_hp != NULL || $item->golongan_darah != NULL || $item->tinggi_badan != NULL || $item->berat_badan != NULL || $item->angkatan != NULL) {
            Alumni::create([
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
                'angkatan' => $item->angkatan,
            ]);

            $user = User::where('id', $item->user_id)->first();
            $user->role = 'ALUMNI';
            $user->save();

            $item->delete();

            return redirect()->route('data-alumni.index')->with(['success' => 'Berhasil Memindah Data ke Data Alumni ' . $user->nama]);
        } else {
            return redirect()->back()->with(['error-pindah' => 'Lengkapi Data Mahasiswa Terlebih Dahulu']);
        }



    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        Excel::import(new MahasiswaImport, $file);

        return redirect()->route('data-mahasiswa.index')->with(['success' => 'Berhasil Mengimport Data Mahasiswa']);
    }
}
