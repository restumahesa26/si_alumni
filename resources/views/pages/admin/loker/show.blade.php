@extends('layouts.admin')

@section('title')
    <title>Admin | Detail Loker</title>
@endsection

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Detail Lowongan Kerja</h4>
                    <p>Menampilkan Detail Lowongan Kerja beserta Tanya Jawab</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('loker.index') }}">Lowongan Kerja</a></li>
                    <li class="breadcrumb-item"><a href="#">Detail Data</a></li>
                    <li class="breadcrumb-item active"><a href="#">{{ $item->judul }}</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('loker.index') }}" class="btn btn-warning btn-sm mr-2 text-white">
                            <i class="ti-angle-double-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body px-4">
                        <h3>{{ $item->nama_kerja }}</h3>
                        <p class="" style="color: #000">
                            Diupload oleh <span class="">{{ $item->users->nama }}</span> pada tanggal {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}
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
                        @forelse ($tanya_jawabs as $tanya_jawab)
                            <div class="mb-2
                            @if ($tanya_jawab->user_id == $tanya_jawab->lokers->user_id)
                                text-right
                            @else
                                text-left
                            @endif">
                                <h5 style="font-size: 18px;">{{ $tanya_jawab->tanya_jawab }}</h5>
                                <p style="color: #000; margin-top: -8px; font-size: 14px;">dari {{ $tanya_jawab->users->username }} pada {{ \Carbon\Carbon::parse($tanya_jawab->created_at)->format('d F Y H:i') }}</p>
                                @if ($tanya_jawab->user_id === Auth::user()->id)
                                    <form action="{{ route('hapus_tanya_jawab_loker', $tanya_jawab->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger px-4 btn-sm" style="margin-top: -20px; font-size: 10px">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        @empty

                        @endforelse
                        <form action="{{ route('tanya_jawab_loker', $item->id) }}" method="POST" class="mt-5">
                            @csrf
                            <div class="form-group">
                                <label for='tanya_jawab'>Pertanyaan / Jawaban</label>
                                <input class='form-control @error('tanya_jawab') is-invalid @enderror' type='text' name='tanya_jawab' id='tanya_jawab' placeholder='Masukkan Pertanyaan / Jawaban' value='{{ old('tanya_jawab') }}' />
                                @error('tanya_jawab')
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
