@extends('layouts.user')

@section('title')
    <title>SI ATI | Diskusi</title>
@endsection

@section('content')
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-md-between">
                <div class="col">
                    <h1 class="">Diskusi</h1>
                </div>
                <div class="col-auto">
                    <div class="d-flex">
                        <form action="{{ route('user.search-diskusi') }}">
                            <input class="form-control" name="search" type="search" placeholder="Cari Diskusi"
                                aria-label="Search" />
                        </form>
                        <button class="btn btn-outline-light ms-2" type="submit" aria-expanded="false">
                            <i class="fas fa-search text-800"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user() && Auth::user()->role !== 'ADMIN')
        <div class="row" style="margin-top: 2rem">
            <div class="col">
                <a href="{{ route('user.diskusi-saya') }}">
                    <button class="btn btn-lg btn-secondary" type="button" aria-expanded="false">
                        Pertanyaan Saya
                        <i class="fas fa-comment text-white"></i>
                    </button>
                </a>
            </div>
            <div class="col">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('user.ajukan-diskusi') }}">
                        <button class="btn btn-lg btn-secondary" type="button" aria-expanded="false">
                            Ajukan Pertanyaan
                            <i class="fas fa-plus-circle text-white"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        @endif
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
                        @foreach ($diskusis as $item)
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
                                <i class="fas fa-comments fa-4x text-secondary"></i>
                                <h3>{{ $item->tanya_jawab_diskusi->count() }}</h3>
                            </td>
                            <td class="text-center align-bottom"><a href="{{ route('user.detail-diskusi', $item->id) }}"><button
                                        class="btn btn-info btn-lg mb-3">Detail</button></a>
                                <p class="fs--1">Ditanyakan pada {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y H:i') }}</p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {!! $diskusis->links() !!}
        </div>
    </div>
    <!-- end of .container-->
</section>
@endsection
