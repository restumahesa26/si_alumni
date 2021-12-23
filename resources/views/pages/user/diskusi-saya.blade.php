@extends('layouts.user')

@section('title')
    <title>SI Alumni | Pertanyaan Saya</title>
@endsection

@section('content')
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-md-between">
                <div class="col-auto">
                    <a class="d-flex align-items-center" href="{{ route('user.diskusi') }}"><i
                            class="fas fa-arrow-circle-left fa-3x"></i>
                        <div class="btn btn-lg col-auto border-0 align-middle" style="font-size: 24pt">
                            Kembali
                        </div>
                    </a>
                </div>
                <div class="col-auto">
                    <div class="d-flex">
                        <form>
                            <input class="form-control" type="search" placeholder="Cari Pertanyaan"
                                aria-label="Search" />
                        </form>
                        <button class="btn btn-outline-light ms-2" type="submit" aria-expanded="false">
                            <i class="fas fa-search text-800"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 1.5rem">
            <div class="col">
                <h1 class="">Pertanyaan Saya</h1>
            </div>
            <div class="col">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('user.ajukan-diskusi') }}">
                        <button class="btn btn-secondary" type="button" aria-expanded="false">
                            Ajukan Pertanyaan
                            <i class="fas fa-plus-circle text-white"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <section> close ============================-->
<!-- ============================================-->

<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="pt-4">
    <div class="container">
        <div class="row border-3 border-bottom border-top border-secondary">
            <div class="pt-3 table-responsive">
                <table class="table table-striped table-hover display nowrap align-middle">
                    <tbody>
                        @forelse ($diskusis as $item)
                        <tr>
                            <td>
                                <div class="p-3">
                                    <img src="{{ url('frontend/public/assets/img/favicons/logo-bulat2.png') }}" class="mx-auto d-block" height="50px"
                                        alt="profil-perusahaan" />
                                </div>
                            </td>
                            <td>
                                <h2>{{ $item->judul }}</h1>
                                <p>{{ $item->users->nama }}</p>
                                <p>{!! $item->isi !!}</p>
                            </td>
                            <td class="text-center">
                                @if ($item->status === '0')
                                <h4>Diskusi <br> Belum Diverifikasi</h4>
                                @else
                                <i class="fas fa-comments fa-4x text-secondary"></i>
                                <h3>{{ $item->tanya_jawab_diskusi->count() }}</h3>
                                @endif
                            </td>
                            <td class="text-center align-bottom"><a href="{{ route('user.detail-diskusi', $item->id) }}"><button
                                        class="btn btn-info btn-lg mb-3">Detail</button></a>
                                <p class="fs--1">Ditanyakan pada 1 Oktober 2021, 13.00</p>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum Ada Diskusi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end of .container-->
</section>
@endsection
