@extends('layouts.admin')

@section('title')
    <title>Admin | Detail Berita</title>
@endsection

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Detail Berita</h4>
                    <p>Menampilkan Detail Berita beserta Komentar</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
                    <li class="breadcrumb-item"><a href="#">Detail Data</a></li>
                    <li class="breadcrumb-item active"><a href="#">{{ $item->judul }}</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('berita.index') }}" class="btn btn-warning btn-sm mr-2 text-white">
                            <i class="ti-angle-double-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body px-4">
                        <h3>{{ $item->judul }}</h3>
                        <p class="" style="color: #000">
                            Diupload pada tanggal {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}
                        </p>
                        <div class="" style="color: #000">
                            {!! $item->isi !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mx-auto">Tanya Jawab</h4>
                    </div>
                    <div class="card-body">
                        @forelse ($komentars as $komentar)
                            <div class="mb-2
                            @if ($komentar->user_id == Auth::user()->id)
                                text-right
                            @else
                                text-left
                            @endif">
                                <h5 style="font-size: 18px;">{!! $komentar->komentar !!}</h5>
                                <p style="color: #000; margin-top: -8px; font-size: 14px;">dari {{ $komentar->users->nama }} pada {{ \Carbon\Carbon::parse($komentar->created_at)->format('d F Y H:i') }}</p>
                                @if ($komentar->user_id === Auth::user()->id)
                                    <form action="{{ route('hapus_komentar_berita', $komentar->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger px-4 btn-sm" style="margin-top: -20px; font-size: 10px">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        @empty

                        @endforelse
                        <form action="{{ route('komentar_berita', $item->id) }}" method="POST" class="mt-5">
                            @csrf
                            <div class="form-group">
                                <label for='komentar'>Komentar</label>
                                <input class='form-control @error('komentar') is-invalid @enderror' type='text' name='komentar' id='komentar' placeholder='Masukkan Komentar' value='{{ old('komentar') }}' />
                                @error('komentar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type='submit' class='btn btn-primary btn-block'>Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
