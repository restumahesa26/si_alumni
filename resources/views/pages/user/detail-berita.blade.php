@extends('layouts.user')

@section('title')
    <title>SI ATI | Detail Berita</title>
@endsection

@section('content')
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <a class="d-flex align-items-center" href="{{ route('user.berita') }}"><i
                        class="fas fa-arrow-circle-left fa-3x"></i>
                    <div class="btn btn-lg col-auto border-0" style="font-size: 24pt">
                        Kembali
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="pb-0 pt-5">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h1>{{ $berita->judul }}</h1>
                <h5>{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('l, d F Y') }}</h5>
            </div>
        </div>
    </div>
    <div class="container border-bottom border-2 border-secondary" style="margin-top: 2rem">
        <div class="row">
            <div class="text-center">
                <img src="{{ asset('storage/assets/berita-thumbnail/' . $berita->thumbnail) }}" alt="gambar-berita" style="width: 80%; height: auto;" />
                <p class="pt-2">Ket: Gambar Thumbnail Berita</p>
            </div>
        </div>
        <div class="row pt-5 p-3 text-justify">
            <p>
                {!! $berita->isi !!}
            </p>
        </div>
        <div>
            <div class="row mt-3 ms-4 me-4">
                <h2>Komentar</h2>
            </div>
            @forelse ($berita->komentar_berita as $komentar)
            <div class="row mt-0 m-5 border-start border-5 d-grid gap-3">
                <div class="col-auto ms-3 p-2">
                    <div class="row">
                        <div class="col-auto me-2">
                            <img src="{{ url('frontend/public/assets/img/favicons/logo-bulat2.png') }}" alt="alumni-profile" width="60px" />
                        </div>
                        <div class="col">
                            <h4>{{ $komentar->users->nama }}</h4>
                            <p class="fs--1">{{ \Carbon\Carbon::parse($komentar->created_at)->translatedFormat('l, d F Y - H:i') }}</p>
                            <p>
                                {{ $komentar->komentar }}
                            </p>
                            @if (Auth::user() && $komentar->user_id === Auth::user()->id)
                            <form action="{{ route('user.komentar-delete', $komentar->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="row mt-0 m-5 border-start border-5 d-grid gap-3">
                <div class="col-auto ms-3 p-2">
                    <h4>Belum ada komentar pada berita ini</h4>
                </div>
            </div>
            @endforelse
            @if (Auth::user())
            <div class="col-auto ms-3 p-2 mb-3">
                <div class="row">
                    <form action="{{ route('user.komentar-store', $berita->id) }}" method="POST">
                        @csrf
                        <div class="col">
                            <label for="komentar" class="text-secondary fs-2 mb-3">Tambahkan Komentar</label>
                            <textarea class="form-control" name="komentar" id="komentar"
                                placeholder="Tambahkan komentar disini..."></textarea>
                            <div class="col-md-12 d-flex justify-content-end">
                                <button class="btn btn-secondary mt-3" type="submit">
                                    Kirim
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <h4 class="mb-5">Harap login terlebih dahulu, untuk menambah komentar</h4>
            @endif

        </div>
    </div>
</section>
@endsection
