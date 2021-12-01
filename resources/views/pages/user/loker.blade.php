@extends('layouts.user')

@section('content')
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-md-between">
                <div class="col">
                    <h1 class="">Info Loker</h1>
                </div>
                @if (Auth::user() && Auth::user()->role === 'ADMIN')

                @elseif (Auth::user() && Auth::user()->role !== 'ADMIN')
                <div class="col-auto">
                    <div class="">
                        <a href="{{ route('user.ajukan-loker') }}">
                            <button class="btn btn-primary ms-2" type="submit" aria-expanded="false">
                                Ajukan Loker
                                <i class="fas fa-plus-circle text-secondary"></i>
                            </button>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="row" style="margin-top: 2rem">
            <div class="col-md-3">
                <form action="{{ route('user.search-loker', 'pekerjaan') }}">
                    <input class="form-control" type="search" placeholder="Cari Pekerjaan" aria-label="Search" name="search" />
                </form>
            </div>
            <div class="col-md-3">
                <form action="{{ route('user.search-loker', 'perusahaan') }}">
                    <input class="form-control" type="search" placeholder="Cari Perusahaan" aria-label="Search" name="search" />
                </form>
            </div>
            <div class="col-md-3">
                <form action="{{ route('user.search-loker', 'lokasi') }}">
                    <input class="form-control" type="search" placeholder="Cari Lokasi" aria-label="Search" name="search" />
                </form>
            </div>
            <div class="col-md-1">
                <button class="btn btn-outline-light ms-2" type="submit" aria-expanded="false">
                    <i class="fas fa-search text-800"></i>
                </button>
            </div>
        </div>
    </div>
</section>
<!-- <section> close ============================-->
<!-- ============================================-->

<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="pt-5">
    <div class="container">
        <div class="row border-3 border-bottom border-top border-secondary">
            <div class="pt-3 table-responsive">
                <table class="table table-striped table-hover display nowrap align-middle">
                    <tbody>
                        @forelse ($lokers as $item)
                        <tr>
                            <td>
                                @if ($item->logo_perusahaan != NULL)
                                <div class="p-3">
                                    <img src="{{ asset('storage/assets/foto-loker/' . $item->logo_perusahaan) }}" class="mx-auto d-block"
                                        height="100px" alt="profil-perusahaan" />
                                </div>
                                @else
                                <div class="p-3">
                                    <img src="{{ url('frontend/public/assets/img/favicons/apple-touch-icon2.png') }}" class="mx-auto d-block"
                                        height="100px" alt="profil-perusahaan" />
                                </div>
                                @endif
                            </td>
                            <td>
                                <h2>{{ $item->nama_kerja }}</h1>
                                <p>{{ $item->tempat_kerja }} | {{ $item->lokasi_kerja }}</p>
                                <p>{!! $item->isi !!}</p>
                            </td>
                            <td><a href="{{ route('user.detail-loker', $item->id) }}"><button class="btn btn-info btn-lg">Detail</button></a></td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="3">Data Kosong</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end of .container-->
</section>
<!-- <section> close ============================-->
<!-- ============================================-->

<section class="pt-0">
    <div class="container">
        <div class="col-md-12">
            <h1 class="text-center mb-5">Loker Terbaru</h1>
        </div>
        <div class="row">
            @foreach ($loker2 as $item2)
            <div class="col-sm-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item2->nama_kerja }}</h5>
                        <p class="card-text">{{ $item2->tempat_kerja }} | {{ $item2->lokasi_kerja }}</p>
                        <a href="{{ route('user.detail-loker', $item2->id) }}" class="btn btn-info">Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
