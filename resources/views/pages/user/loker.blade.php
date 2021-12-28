@extends('layouts.user')

@section('title')
    <title>SI Alumni Informatika | Loker</title>
@endsection

@section('content')
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-md-between">
                <div class="col">
                    <h1 class="">Info Loker</h1>
                </div>
                @if (Auth::user() && Auth::user()->role === 'ADMIN')

                @elseif (Auth::user() && Auth::user()->role === 'ALUMNI')
                <div class="col-auto">
                    <div class="">
                        <a href="{{ route('user.ajukan-loker') }}">
                            <button class="btn btn-lg btn-secondary ms-2" type="submit" aria-expanded="false">
                                Ajukan Loker
                                <i class="fas fa-plus-circle text-white"></i>
                            </button>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <form action="{{ route('user.search-loker') }}">
            <div class="row" style="margin-top: 2rem">
                <div class="col-md-11">
                    <input class="form-control" type="search" placeholder="Cari Pekerjaan berdasarkan jenis pekerjaan, nama perusahaan, atau lokasi perusahaan" aria-label="Search" name="search" />
                </div>
                <div class="col-auto">
                    <button class="btn btn-outline-light ms-2" type="submit" aria-expanded="false">
                        <i class="fas fa-search text-800"></i>
                    </button>
                </div>
            </div>
        </form>
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
                                <h2>{{ $item->jenis_pekerjaan }}</h1>
                                <p>{{ $item->tempat_kerja }}</p>
                            </td>
                            <td>
                                <p>{{ $item->lokasi_kerja }}</p>
                            </td>
                            <td><a href="{{ route('user.detail-loker', $item->id) }}"><button class="btn btn-secondary btn-lg">Detail</button></a></td>
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
        <div class="d-flex justify-content-center mt-3">
            {!! $lokers->links() !!}
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
                        <h5 class="card-title">{{ $item2->jenis_pekerjaan }}</h5>
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

@push('addon-script')
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    @if ($message = Session::get('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ $message }}'
        })
    </script>
    @endif
@endpush
