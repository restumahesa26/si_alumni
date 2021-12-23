@extends('layouts.user')

@section('title')
<title>SI Alumni | Deatil Alumni</title>
@endsection

@section('content')
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <a class="d-flex align-items-center" href="{{ route('daftar-alumni') }}"><i
                        class="fas fa-arrow-circle-left fa-3x"></i>
                    <div class="btn btn-lg col-auto border-0" style="font-size: 24pt">
                        Kembali
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- <section> close ============================-->
<!-- ============================================-->

<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="pt-2 pb-2">
    <div class="container">
        <div class="row">
            <div class="p-5">
                <div class="border rounded-3 border-3 border-primary p-5">
                    <div class="row">
                        <div class="col-auto me-4">
                            @if ($alumni->foto !== NULL)
                            <img src="{{ asset('storage/assets/foto-profil/' . $alumni->foto) }}" alt="alumni-profile"
                                width="200px" />
                            @else
                            <img src="{{ url('frontend/public/assets/img/favicons/apple-touch-icon2.png') }}"
                                alt="alumni-profile" width="200px" />
                            @endif
                        </div>
                        <div class="col-auto fs-lg-2 fw-bold">
                            <p>Nama</p>
                            <p>NPM</p>
                            <p>Tahun Lulus</p>
                            <p>Bidang Pekerjaan</p>
                            <p>Perusahaan</p>
                            <p>Email</p>
                        </div>
                        <div class="col fs-lg-2 fw-bold">
                            <p>: {{ $alumni->users->nama }}</p>
                            <p>: {{ $alumni->users->npm }}</p>
                            <p>: {{ \Carbon\Carbon::parse($alumni->tanggal_wisuda)->translatedFormat('Y') }}</p>
                            <p>: {{ $alumni->pekerjaan ?? '-' }}</p>
                            <p>: {{ $alumni->tempat_pekerjaan ?? '-' }}</p>
                            <p>: {{ $alumni->users->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of .container-->
</section>

<section style="padding-top: 0rem; padding-bottom: 0rem">
    <div
        style=" background-image: url({{ url('frontend/public/assets/img/gallery/funfacts-2-bg.png') }}); position: absolute; width: 100%; min-height: 90%; background-size: cover; background-position: center;">
    </div>
    <!--/.bg-holder-->

    <div class="container" style="padding-top: 20px">
        <div class="row justify-content-center">
            <h1 class="text-center mb-5">Jumlah Alumni Tahun 2021</h1>
            <div class="col-sm-6 col-lg-3 text-center mb-5">
                <img src="{{ url('cewek.png') }}" height="100" alt="..." />
                <h1 class="my-2">{{ $perempuan }}</h1>
                <p class="text-info fw-bold">PEREMPUAN</p>
            </div>
            <div class="col-sm-6 col-lg-3 text-center mb-5">
                <img src="{{ url('cowok.png') }}" height="100" alt="..." />
                <h1 class="my-2">{{ $laki }}</h1>
                <p class="text-info fw-bold">LAKI-LAKI</p>
            </div>
        </div>
    </div>
</section>
@endsection
