@extends('layouts.user')

@section('title')
    <title>SI Alumni Informatika | Berita</title>
@endsection

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
                        <form action="{{ route('user.search-berita') }}">
                            <input class="form-control" name="search" type="search" placeholder="Cari Berita" aria-label="Search" />
                        </form>
                        <button class="btn btn-outline-light ms-2" type="submit" aria-expanded="false">
                            <i class="fas fa-search text-800"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-5">List Berita</h1>
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
        <div class="d-flex justify-content-center">
            {!! $beritas->links() !!}
        </div>
    </div>

</section>

@if ($beritas2)
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-5">Berita Pilihan</h1>
            </div>
            @forelse ($beritas2 as $item2)
            <div class="col-md-4 mb-4">
                <a href="{{ route('user.detail-berita', $item2->id) }}">
                    <div class="card h-100">
                        <img class="card-img-top w-100" src="{{ asset('storage/assets/berita-thumbnail/' . $item2->thumbnail) }}" alt="courses" />
                        <div class="card-body">
                            <h5 class="font-sans-serif fw-bold fs-md-0 fs-lg-1">
                                {{ $item2->judul }}
                            </h5>
                            <p type="date" class="text-muted fs--1 stretched-link text-decoration-none">
                                {{ \Carbon\Carbon::parse($item2->created_at)->translatedFormat('l, d F Y') }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @empty

            @endforelse
        </div>
    </div>
    <!-- end of .container-->
</section>
@endif
@endsection
