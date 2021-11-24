@extends('layouts.user')

@section('content')
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-md-between">
                <div class="col">
                    <h1 class="">Berita</h1>
                </div>
                <div class="col-auto">
                    <div class="d-flex">
                        <form>
                            <input class="form-control" type="search" placeholder="Cari Berita" aria-label="Search" />
                        </form>
                        <button class="btn btn-outline-light ms-2" type="submit" aria-expanded="false">
                            <i class="fas fa-search text-800"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 2rem">
        <div class="col">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a href="artikel-berita.html"><img src="{{ url('frontend/public/assets/img/gallery/art-design.png') }}" class="d-block w-100"
                                alt="..." />
                            <div class="carousel-caption d-none d-md-block">
                                <h3>Berita Populer 1</h3>
                                <p>
                                    Deskripsi Berita Populer 1.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="artikel-berita.html">
                            <img src="{{ url('frontend/public/assets/img/gallery/arguments.png') }}" class="d-block w-100" alt="..." />
                            <div class="carousel-caption d-none d-md-block">
                                <h3>Berita Populer 2</h3>
                                <p>
                                    Deskripsi Berita Populer 2.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="artikel-berita.html">
                            <img src="{{ url('frontend/public/assets/img/gallery/art-design-1.png') }}" class="d-block w-100" alt="..." />
                            <div class="carousel-caption d-none d-md-block">
                                <h3>Berita Populer 3</h3>
                                <p>
                                    Deskripsi Berita Populer 3.
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>

<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-5">Berita Terbaru</h1>
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
@endsection
