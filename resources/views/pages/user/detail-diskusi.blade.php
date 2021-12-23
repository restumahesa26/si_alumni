@extends('layouts.user')

@section('title')
    <title>SI Alumni | Detail Diskusi</title>
@endsection

@section('content')
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <a class="d-flex align-items-center" href="{{ route('user.diskusi') }}"><i class="fas fa-arrow-circle-left fa-3x"></i>
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
        <div class="row p-5">
            <div class="border rounded-3 border-3 border-primary p-5">
                <div class="row border-bottom border-3 border-secondary">
                    <div class="col-auto me-4">
                        <img src="{{ url('frontend/public/assets/img/favicons/logo-bulat2.png') }}" alt="alumni-profile"
                            width="100px" />
                    </div>
                    <div class="col">
                        <h1>{{ $diskusi->judul }}</h1>
                        <h3>{{ $diskusi->users->nama }}</h3>
                        <p class="text-end fs--1">Ditanyakan pada
                            {{ \Carbon\Carbon::parse($diskusi->created_at)->translatedFormat('l, d F Y H:i') }}</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <p>
                            <h4>Deskripsi Pertanyaan</h1>
                                <p>{!! $diskusi->isi !!}
                                </p>
                                <div class="col text-end mt-4">
                                    @if (Auth::user())
                                    <a href="#jawab-diskusi">
                                        <button class="btn btn-secondary fs-lg-1">
                                            <i class="fas fa-reply"></i>
                                            Jawab
                                        </button>
                                    </a>
                                    @endif
                                </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ms-4 me-4">
            <h2>Jawaban</h2>
        </div>
        @forelse ($tanya_jawabs as $item2)
        <div class="row mt-0 m-5 border-start border-5 d-grid gap-3">
            <div class="col-auto border rounded-3 border-3 border-primary ms-3 p-5">
                <div class="row border-bottom border-3 border-secondary pb-3">
                    <div class="col-auto me-4">
                        <img src="{{ url('frontend/public/assets/img/favicons/logo-bulat2.png') }}" alt="alumni-profile" width="60px" />
                    </div>
                    <div class="col">
                        <h4>{{ $item2->users->nama }}</h4>
                        <p class="fs--1">Dijawab pada {{ \Carbon\Carbon::parse($diskusi->created_at)->translatedFormat('l, d F Y H:i') }}</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <p>
                            <h4>Deskripsi Jawaban</h1>
                                <p>{!! $item2->tanya_jawab !!}
                                </p>
                        </p>
                    </div>
                </div>
                @if (Auth::user())
                @if ($item2->user_id === Auth::user()->id)
                <form action="{{ route('user.hapus-jawaban-diskusi', $item2->id) }}" method="POST" class="inline-block mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4" style="margin-top: -20px; font-size: 10px">Hapus</button>
                </form>
                @endif
                @endif
            </div>
        </div>
        @empty
        <div class="row mt-0 m-5 border-start border-5 d-grid gap-3">
            <div class="col-auto border rounded-3 border-3 border-primary ms-3 p-5">
                <div class="row border-bottom border-3 border-secondary pb-3">
                    <h4>Belum ada tanya jawab dalam diskusi ini</h4>
                </div>
            </div>
        </div>
        @endforelse
        @if (Auth::user())
        <div class="row border border-primary rounded-3 border-3 m-5 mt-0 mb-5 p-3">
            <div class="col-auto mt-3 mb-3">
                <h2 id="jawab-diskusi">Tambahkan Jawaban</h2>
            </div>
            <form action="{{ route('user.kirim-jawaban-diskusi', $diskusi->id) }}" method="POST">
                @csrf
                <div class="col-md-12">
                    <textarea class="ckeditor" id="ckeditor" placeholder="Ketikkan teks disini..." cols="30" rows="10" name="tanya_jawab"></textarea>
                </div>
                <div class="col-md-12 mt-5 mb-3 text-end">
                    <button class="btn btn-lg btn-secondary fs-lg-1" type="submit" aria-expanded="false">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
        @else
            <h4 class="ms-5">Untuk bertanya / menjawab dalam diskusi ini, silahkan login terlebih dahulu!</h4>
        @endif
    </div>
    <!-- end of .container-->
</section>
@endsection

@push('addon-script')
<script type="text/javascript" src="{{ url('frontend/public/assets/js/ckeditor/ckeditor.js') }}"></script>
@endpush
