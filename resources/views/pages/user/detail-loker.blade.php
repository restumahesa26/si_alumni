@extends('layouts.user')

@section('title')
    <title>SI ATI | Detail Loker</title>
@endsection

@section('content')
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <a class="d-flex align-items-center" href="{{ route('user.loker') }}"><i
                        class="fas fa-arrow-circle-left fa-3x"></i>
                    <div class="btn btn-lg col-auto border-0" style="font-size: 24pt">
                        Kembali
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<section class="pt-2 pb-2">
    <div class="container">
        <div class="row">
            <div class="p-5">
                <div class="border rounded-3 border-3 border-primary p-5">
                    <div class="row border-bottom border-3 border-secondary">
                        @if ($loker->logo_perusahaan != NULL)
                        <div class="col-auto me-4">
                            <img src="{{ asset('storage/assets/foto-loker/' . $loker->logo_perusahaan) }}"
                                alt="alumni-profile" width="100px" />
                        </div>
                        @else
                        <div class="col-auto me-4">
                            <img src="{{ url('frontend/public/assets/img/gallery/macrohard.png') }}"
                                alt="alumni-profile" width="100px" />
                        </div>
                        @endif
                        <div class="col-auto">
                            <h1>{{ $loker->nama_kerja }}</h1>
                            <h3>{{ $loker->tempat_kerja }}</h3>
                            <p>{{ $loker->lokasi_kerja }}</p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <p>
                                <h4>Deskripsi Pekerjaan</h1>
                                    {!! $loker->isi !!}
                            </p>
                        </div>
                    </div>
                    <div class="border-bottom border-2 border-secondary">
                        <div class="row mt-5 ms-4 me-4">
                            <h2>Tanya Jawab</h2>
                        </div>
                        @forelse ($loker->tanya_jawab_loker as $item)
                        <div class="row mt-0 m-5 border-start border-5 d-grid gap-3">
                            <div class="col-auto ms-3 p-2">
                                <div class="row">
                                    <div class="col-auto me-2">
                                        <img src="{{ url('frontend/public/assets/img/favicons/logo-bulat2.png') }}" alt="alumni-profile"
                                            width="60px" />
                                    </div>
                                    <div class="col">
                                        <h4>{{ $item->users->nama }}</h4>
                                        <p class="fs--1">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y - H:i') }}</p>
                                        <p>
                                            {{ $item->tanya_jawab }}
                                        </p>
                                        @if (Auth::user() && $item->user_id === Auth::user()->id)
                                        <form action="{{ route('user.tanya-jawab-loker-hapus', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="row mt-0 m-5 border-start border-5 d-grid gap-3">
                            <div class="col-auto ms-3 p-2">
                                <h4>Belum ada tanya jawab dalam lowongan kerja ini</h4>
                            </div>
                        </div>
                        @endforelse

                        @if (Auth::user())
                        <div class="col-auto ms-3 p-2 mb-3">
                            <div class="row">
                                <form action="{{ route('user.tanya-jawab-loker', $loker->id) }}" method="POST">
                                    @csrf
                                    <div class="col">
                                        <label for="tanya_jawab" class="text-secondary fs-2 mb-3">Tambahkan
                                            Tanya jawab</label>
                                        <textarea class="form-control" name="tanya_jawab" id="tanya_jawab"
                                            placeholder="Tambahkan tanya jawab disini..."></textarea>
                                        <div class="col-md-12 d-flex justify-content-end">
                                            <button class="btn btn-secondary mt-3" type="submit">
                                                Kirim
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @else
                        <div class="col-auto ms-3 p-2 mb-3">
                            <div class="row">
                                <h4>Untuk tanya jawab dalam lowongan kerja ini, harap login terlebih dahulu</h4>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of .container-->
</section>

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
