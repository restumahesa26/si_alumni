@extends('layouts.user')

@section('content')
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <a class="d-flex align-items-center" href="{{ route('user.loker') }}"><i class="fas fa-arrow-circle-left fa-3x"></i>
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
                        <div class="col-auto me-4">
                            <img src="{{ url('frontend/public/assets/img/gallery/macrohard.png') }}" alt="alumni-profile" width="100px" />
                        </div>
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
