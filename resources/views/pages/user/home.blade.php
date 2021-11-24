@extends('layouts.user')

@section('content')
<section class="pt-4 bg-600 pb-6" id="home">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 col-lg-6 order-0 order-md-1 text-end">
                <img class="pt-7 pt-md-0 w-80" src="{{ url('frontend/public/assets/img/gallery/hero-header.png') }}" width="470"
                    alt="hero-header" />
            </div>
            <div class="col-md-7 col-lg-6 text-md-start text-center py-6">
                <h1 class="fw-bold font-sans-serif">SI ATI</h1>
                <h5 class="fs-6 fs-xl-5 mb-5">
                    Sistem Informasi Alumni Teknik Informatika Universitas Bengkulu
                </h5>
                <a class="btn btn-primary me-2" href="{{ route('daftar-alumni') }}" role="button">Selengkapnya</a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================-->
<!-- <section> begin ============================-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-5">Berita Populer</h1>
            </div>
            @foreach ($beritas as $item)
            <div class="col-md-4 mb-4">
                <a href="{{ route('user.detail-berita', $item->id) }}">
                    <div class="card h-100">
                        <img class="card-img-top w-100" src="{{ asset('storage/assets/berita-thumbnail/' . $item->thumbnail) }}" alt="courses" />
                        <div class="card-body">
                            <h5 class="font-sans-serif fw-bold fs-md-0 fs-lg-1">
                                {{ $item->judul }}
                            </h5>
                            <p type="date" class="text-muted fs--1 stretched-link text-decoration-none">
                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <!-- end of .container-->
</section>
<!-- <section> close ============================-->
<!-- ============================================-->

<section style="padding-top: 0rem; padding-bottom: 0rem">
    <div style=" background-image: url({{ url('frontend/public/assets/img/gallery/funfacts-2-bg.png') }}); position: absolute; width: 100%; min-height: 90%; background-size: cover; background-position: center;">
    </div>
    <!--/.bg-holder-->

    <div class="container" style="padding-top: 20px">
        <div class="row justify-content-center">
            <h1 class="text-center mb-5">Jumlah Alumni Tahun 2021</h1>
            <div class="col-sm-6 col-lg-3 text-center mb-5">
                <img src="{{ url('frontend/public/assets/img/gallery/published.png') }}" height="100" alt="..." />
                <h1 class="my-2">{{ $perempuan }}</h1>
                <p class="text-info fw-bold">PEREMPUAN</p>
            </div>
            <div class="col-sm-6 col-lg-3 text-center mb-5">
                <img src="{{ url('frontend/public/assets/img/gallery/awards.png') }}" height="100" alt="..." />
                <h1 class="my-2">{{ $laki }}</h1>
                <p class="text-info fw-bold">LAKI-LAKI</p>
            </div>
        </div>
    </div>
</section>
@endsection