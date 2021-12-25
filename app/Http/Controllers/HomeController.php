<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Berita;
use App\Models\BeritaKomentar;
use App\Models\Diskusi;
use App\Models\DiskusiTanyaJawab;
use App\Models\Loker;
use App\Models\LokerTanyaJawab;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class HomeController extends Controller
{
    public function home()
    {
        $berita = Berita::inRandomOrder()->limit(3)->get();
        $loker = Loker::inRandomOrder()->limit(3)->orderBy('created_at', 'DESC')->get();
        $diskusi = Diskusi::inRandomOrder()->limit(3)->orderBy('created_at', 'DESC')->get();
        $alumniLaki = Alumni::where('jenis_kelamin', 'L')->count();
        $alumniPerempuan = Alumni::where('jenis_kelamin', 'P')->count();

        return view('pages.user.home', [
            'beritas' => $berita, 'laki' => $alumniLaki, 'perempuan' => $alumniPerempuan, 'lokers' => $loker, 'diskusis' => $diskusi
        ]);
    }

    public function daftar_alumni()
    {
        $alumniLaki = Alumni::where('jenis_kelamin', 'L')->count();
        $alumniPerempuan = Alumni::where('jenis_kelamin', 'P')->count();
        $alumni = Alumni::latest()->paginate(10);

        return view('pages.user.daftar-alumni', [
            'laki' => $alumniLaki, 'perempuan' => $alumniPerempuan, 'alumnis' => $alumni
        ]);
    }

    public function detail_alumni($id)
    {
        $alumni = Alumni::findOrFail($id);
        $alumniPerempuan = Alumni::where('jenis_kelamin', 'P')->count();
        $alumniLaki = Alumni::where('jenis_kelamin', 'L')->count();

        return view('pages.user.detail-alumni', [
            'alumni' => $alumni, 'laki' => $alumniLaki, 'perempuan' => $alumniPerempuan
        ]);
    }

    public function search_alumni(Request $request)
    {
        $cari = $request->search;

        $alumniLaki = Alumni::where('jenis_kelamin', 'L')->count();
        $alumniPerempuan = Alumni::where('jenis_kelamin', 'P')->count();
        $alumni = Alumni::where('pekerjaan','like',"%".$cari."%")->orWhere('tempat_pekerjaan','like',"%".$cari."%")->orWhereYear('tanggal_wisuda','like',"%".$cari."%")->latest()->paginate(10);

        if ($alumni->count() >= 1) {
            return view('pages.user.daftar-alumni', [
                'laki' => $alumniLaki, 'perempuan' => $alumniPerempuan, 'alumnis' => $alumni
            ]);
        } else {
            return redirect()->route('daftar-alumni')->with(['data-kosong' => 'Masukkan Kata Kunci Dengan Benar']);
        }
    }

    public function berita()
    {
        $berita = Berita::inRandomOrder()->paginate(9);
        $berita2 = Berita::where('is_populer', '1')->get();

        return view('pages.user.berita', [
            'beritas' => $berita, 'beritas2' => $berita2
        ]);
    }

    public function detail_berita($id)
    {
        $berita = Berita::findOrFail($id);

        return view('pages.user.detail-berita', [
            'berita' => $berita
        ]);
    }

    public function store_komentar(Request $request, $id)
    {
        $rules = [
            'komentar' => 'required|string|max:255'
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :size',
        ];

        $this->validate($request, $rules, $customMessages);

        BeritaKomentar::create([
            'user_id' => Auth::user()->id,
            'berita_id' => $id,
            'komentar' => $request->komentar
        ]);

        return redirect()->route('user.detail-berita', $id);
    }

    public function delete_komentar($id)
    {
        $item = BeritaKomentar::findOrFail($id);

        $idd = $item->berita_id;

        $item->delete();

        return redirect()->route('user.detail-berita', $idd);
    }

    public function search_berita(Request $request)
    {
        $cari = $request->search;

        $berita = Berita::orderBy('created_at', 'DESC')->where('judul','like',"%".$cari."%")->paginate(9);
        $berita2 = Berita::where('is_populer', '1')->get();

        return view('pages.user.berita', [
            'beritas' => $berita, 'beritas2' => NULL
        ]);
    }

    public function loker()
    {
        $loker = Loker::inRandomOrder()->where('status', '1')->paginate(8);
        $loker2 = Loker::latest()->where('status', '1')->paginate(6);

        return view('pages.user.loker', [
            'lokers' => $loker, 'loker2' => $loker2
        ]);
    }

    public function detail_loker($id)
    {
        $loker = Loker::findOrFail($id);
        $loker2 = Loker::latest()->where('status', '1')->paginate(6);

        return view('pages.user.detail-loker', [
            'loker' => $loker, 'loker2' => $loker2
        ]);
    }

    public function ajukan_loker()
    {
        return view('pages.user.ajukan-loker');
    }

    public function ajukan_loker_store(Request $request)
    {
        $rules1 = [
            'jenis_pekerjaan' => 'required|string|max:255',
            'tempat_kerja' => 'required|string|max:255',
            'lokasi_kerja' => 'required|string|max:255',
            'isi' => 'required|string',
        ];

        $rules2 = [
            'logo' => 'required|image|mimes:jpg,jpeg,png'
        ];


        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :size',
            'image' => 'Field :attribute harus berupa gambar',
            'mimes' => 'Field :attribute harus ekstensi jpeg / jpg / png',
        ];

        $this->validate($request, $rules1, $customMessages);

        if ($request->logo) {
            $this->validate($request, $rules2, $customMessages);
        }

        if ($request->logo) {
            $value = $request->file('logo');
            $extension = $value->extension();
            $imageNames = uniqid('img_', microtime()) . '.' . $extension;
            Storage::putFileAs('public/assets/foto-loker', $value, $imageNames);
            $thumbnailpath = storage_path('app/public/assets/foto-loker/' . $imageNames);
            $img = Image::make($thumbnailpath)->resize(300, 300)->save($thumbnailpath);
        }else {
            $imageNames = '';
        }

        Loker::create([
            'user_id' => Auth::user()->id,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'tempat_kerja' => $request->tempat_kerja,
            'lokasi_kerja' => $request->lokasi_kerja,
            'isi' => $request->isi,
            'logo_perusahaan' => $imageNames,
        ]);

        return redirect()->route('user.loker')->with(['success' => 'Terima kasih telah mengajukan lowongan kerja']);
    }

    public function store_tanya_jawab_loker(Request $request, $id)
    {
        $rules = [
            'tanya_jawab' => 'required|string|max:255'
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :size',
        ];

        $this->validate($request, $rules, $customMessages);

        LokerTanyaJawab::create([
            'user_id' => Auth::user()->id,
            'loker_id' => $id,
            'tanya_jawab' => $request->tanya_jawab
        ]);

        return redirect()->route('user.detail-loker', $id);
    }

    public function delete_tanya_jawab_loker($id)
    {
        $item = LokerTanyaJawab::findOrFail($id);

        $idd = $item->loker_id;

        $item->delete();

        return redirect()->route('user.detail-loker', $idd);
    }

    public function search_loker(Request $request, $tipe)
    {
        $cari = $request->search;

        $loker2 = Loker::orderBy('created_at', 'DESC')->where('status', '1')->paginate(8);

        if ($tipe == 'pekerjaan') {
            $items = Loker::where('nama_kerja','like',"%".$cari."%")->paginate(2);
        }elseif ($tipe == 'perusahaan') {
            $items = Loker::where('tempat_kerja','like',"%".$cari."%")->paginate(2);
        }elseif ($tipe == 'lokasi') {
            $items = Loker::where('lokasi_kerja','like',"%".$cari."%")->paginate(2);
        }

        return view('pages.user.loker', [
            'lokers' => $items, 'loker2' => $loker2
        ]);
    }

    public function diskusi()
    {
        $diskusi = Diskusi::where('status', '1')->latest()->paginate(8);

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
        $rules = [
            'tanya_jawab' => 'required|string|max:255'
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :size',
        ];

        $this->validate($request, $rules, $customMessages);

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

    public function diskusi_saya()
    {
        $diskusi = Diskusi::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

        return view('pages.user.diskusi-saya', [
            'diskusis' => $diskusi
        ]);
    }

    public function ajukan_diskusi()
    {
        return view('pages.user.ajukan-diskusi');
    }

    public function ajukan_diskusi_store(Request $request)
    {
        $rules = [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string|max:255',
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :size',
        ];

        $this->validate($request, $rules, $customMessages);

        Diskusi::create([
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'isi' => $request->isi
        ]);

        return redirect()->route('user.diskusi-saya')->with(['success' => 'Terima kasih telah mengajukan diskusi']);
    }

    public function search_diskusi(Request $request)
    {
        $cari = $request->search;

        $diskusi = Diskusi::latest()->where('judul','like',"%".$cari."%")->paginate(8);

        return view('pages.user.diskusi', [
            'diskusis' => $diskusi
        ]);
    }

    public function data_saya()
    {
        if (Auth::user()->role == 'MAHASISWA') {
            $user = Mahasiswa::where('user_id', Auth::user()->id)->first();
        }elseif (Auth::user()->role == 'ALUMNI') {
            $user = Alumni::where('user_id', Auth::user()->id)->first();
        }else {
            $user = User::findOrFail(Auth::user()->id);
        }

        return view('pages.user.data-saya', [
            'user' => $user
        ]);
    }

    public function cetak_form_data(){
        $item = Alumni::where('user_id', Auth::user()->id)->first();

        return view('pages.user.form-data', [
            'item' => $item
        ]);
    }

    public function cetak_biodata_wisudawan(){
        $item = Alumni::where('user_id', Auth::user()->id)->first();

        return view('pages.user.biodata-wisudawan', [
            'item' => $item
        ]);
    }
}
