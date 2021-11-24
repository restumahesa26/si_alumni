@extends('layouts.user')

@section('content')
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <a class="d-flex align-items-center" href="{{ route('user.berita') }}"><i class="fas fa-arrow-circle-left fa-3x"></i>
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
                <img src="{{ asset('storage/assets/berita-thumbnail/' . $berita->thumbnail) }}" alt="gambar-berita" />
                <p class="pt-2">Ket: Gambar Thumbnail Berita</p>
            </div>
        </div>
        <div class="row pt-5 p-3 text-justify">
            <p>
                {!! $berita->isi !!}
            </p>
        </div>
    </div>
</section>
@endsection
