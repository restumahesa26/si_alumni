@extends('layouts.user')

@section('title')
    <title>SI Alumni Informatika | Beranda</title>
@endsection

@section('content')
<section class="pt-4 bg-600 pb-6" id="home">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 col-lg-6 order-0 order-md-1 text-end d-none d-md-block">
                <img class="pt-7 pt-md-0 w-80" src="{{ url('bg.png') }}" width="700"
                    alt="hero-header" />
            </div>
            <div class="col-md-7 col-lg-6 text-md-start text-center py-6">
                <h3 class="fs-6 fs-xl-5 mb-5">
                    Sistem Informasi Alumni Teknik Informatika Universitas Bengkulu
                </h3>
                <a class="btn btn-secondary me-2" href="{{ route('daftar-alumni') }}" role="button">Lihat Daftar Alumni</a>
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
                <h1 class="text-center mb-5">Berita</h1>
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
            <div class="col-md-12 text-center mb-5">
                <a href="{{ route('user.berita') }}" class="btn btn-secondary">Lihat Lebih Banyak Berita</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-5">Lowongan Kerja</h1>
            </div>
            @foreach ($lokers as $item2)
            <div class="col-sm-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item2->jenis_pekerjaan }}</h5>
                        <p class="card-text">{{ $item2->tempat_kerja }} | {{ $item2->lokasi_kerja }}</p>
                        <a href="{{ route('user.detail-loker', $item2->id) }}" class="btn btn-info">Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-md-12 text-center mb-5">
                <a href="{{ route('user.loker') }}" class="btn btn-secondary">Lihat Lebih Banyak Lowongan Kerja</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-5">Diskusi</h1>
            </div>
            @foreach ($diskusis as $item3)
            <div class="col-sm-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item3->judul }}</h5>
                        <p class="card-text">{{ $item3->users->nama }}<br> <span style="font-size: 12px;">{{ \Carbon\Carbon::parse($item3->created_at)->translatedFormat('l, d F Y') }}</span></p>
                        <a href="{{ route('user.detail-diskusi', $item3->id) }}" class="btn btn-info">Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-md-12 text-center">
                <a href="{{ route('user.diskusi') }}" class="btn btn-secondary">Lihat Lebih Banyak Diskusi</a>
            </div>
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
            <h1 class="text-center mb-5">Jumlah Alumni Tahun {{ \Carbon\Carbon::now()->format('Y') }}</h1>
            <div class="col-sm-6 col-lg-3 text-center mb-5">
                <img src="{{ url('cewek.png') }}" height="100" alt="..." />
                <h1 class="my-2">{{ $perempuan ? $perempuan : '-' }}</h1>
                <p class="text-info fw-bold">PEREMPUAN</p>
            </div>
            <div class="col-sm-6 col-lg-3 text-center mb-5">
                <img src="{{ url('cowok.png') }}" height="100" alt="..." />
                <h1 class="my-2">{{ $laki ? $laki : '-' }}</h1>
                <p class="text-info fw-bold">LAKI-LAKI</p>
            </div>
        </div>
    </div>
</section>
@endsection

@push('addon-script')
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    @if ($message = Session::get('success-login'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Selamat Datang',
            text: '{{ $message }}'
        })
    </script>
    @endif

    @if ($message = Session::get('success-register'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Selamat Datang',
            text: '{{ $message }}'
        })
    </script>
    @endif
@endpush
