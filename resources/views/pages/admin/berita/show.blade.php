@extends('layouts.admin')

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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Berita</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Detail Data</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $item->judul }}</a></li>
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
                            <div class="mb-2">
                                <h5 style="font-size: 18px;">{{ $komentar->komentar }}</h5>
                                <p style="color: #000; margin-top: -8px; font-size: 14px;">dari {{ $komentar->users->username }} pada {{ \Carbon\Carbon::parse($komentar->created_at)->format('d F Y H:i') }}</p>
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

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-8 py-8">
                <h2 class="font-semibold text-2xl">
                    {{ $item->judul }}
                </h2>
                <p class="font-light text-sm mt-2">
                    Diupload pada tanggal {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}
                </p>
                <img src="{{ asset('storage/assets/berita-thumbnail/' . $item->thumbnail) }}" alt="" class="mx-auto my-6 rounded-2xl">
                <div class="font-light mt-5">
                    {!! $item->isi !!}
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <h2 class="text-2xl">Komentar</h2>
    </div>
    <div class="pb-12">
        @foreach ($komentars as $komentar)
        <div class="max-w-7xl mx-auto px-10 mt-4">
            <div class="bg-white overflow-hidden px-4 py-6 rounded">
                <p class="text-xl">{{ $komentar->komentar }}</p>
                <p class="-mt-2 text-blue-800 mb-1" style="font-size: 14px">oleh {{ $komentar->users->username }} pada {{ \Carbon\Carbon::parse($komentar->created_at)->format('d F Y') }}</p>
                @if ($komentar->user_id === Auth::user()->id)
                <form action="{{ route('hapus_komentar_berita', $komentar->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded font-bold text-sm btn-hapus">Hapus</button>
                </form>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <div class="pb-10">
        <div class="max-w-7xl mx-auto px-10">
            <div class="bg-white overflow-hidden px-4 py-2 rounded">
                <form action="{{ route('komentar_berita', $item->id) }}" method="POST">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full px-3">
                            <label for="komentar" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Masukkan Komentar
                            </label>
                            <input type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="komentar" value="{{ old('komentar') }}" placeholder="Masukkan Komentar" name="komentar">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="bg-green-400 hover:bg-green-600 text-white font-bold py-2 px-4 rounded w-30">
                                Kirim
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> --}}
