@extends('layouts.user')

@section('title')
    <title>SI Alumni Informatika | Daftar Alumni</title>
@endsection

@section('content')
<section class="">
    <div class="container">
        <div class="row">

            <div class="col-md-7">
                <h1 class="mb-6">Daftar Alumni</h1>
            </div>

            <div class="col-md-5">
                <form action="{{ route('user.search-alumni') }}">
                    <div class="d-flex justify-content-end">
                        <input class="form-control" name="search" type="search" placeholder="Masukkan pekerjaan, perusahaan, tahun lulus" aria-label="Search" />
                        <button class="btn btn-outline-light ms-2" type="submit">
                            <i class="fas fa-search text-800"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-md-12">
                <form action="{{ route('user.filter-alumni') }}" method="GET" class="form-inline">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tahun">Filter Berdasarkan Tahun</label>
                                <input type="number" name="tahun" id="tahun" class="form-control" placeholder="Masukkan Tahun..">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="limit">Jumlah Data</label>
                                <input type="number" name="limit" id="limit" class="form-control" placeholder="Masukkan Jumlah Data..">
                            </div>
                        </div>
                        <div class="col-md-4 mt-auto">
                            <button type="submit" class="btn btn-secondary btn-block">Filter Data</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-12 mt-4">
                <div class="table-responsive d-none d-md-block">
                    <table class="table table-striped table-hover display nowrap align-middle" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NPM</th>
                                <th>Tahun Lulus</th>
                                <th>Bidang Pekerjaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alumnis as $item)
                            <tr>
                                <td>{{ $loop->iteration + $alumnis->firstItem() - 1 }}</td>
                                <td>{{ $item->users->nama }}</td>
                                <td>{{ $item->users->npm }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_wisuda)->translatedFormat('Y') }}</td>
                                <td>{{ $item->pekerjaan ?? '-' }}</td>
                                <td><a href="{{ route('detail-alumni', $item->id) }}"><button class="btn btn-secondary">Detail</button></a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">-- Data Alumni Kosong --</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="d-sm-block d-md-none">
                    <table class="table table-striped table-hover display nowrap align-middle" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alumnis as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->users->nama }}</td>
                                <td><a href="{{ route('detail-alumni', $item->id) }}"><button class="btn btn-secondary">Detail</button></a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">-- Data Alumni Kosong --</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {!! $alumnis->links() !!}
        </div>
    </div>
    <!-- end of .container-->
</section>

<section style="padding-top: 0rem; padding-bottom: 0rem">
    <div style=" background-image: url({{ url('frontend/public/assets/img/gallery/funfacts-2-bg.png') }}); position: absolute; width: 100%; min-height: 90%; background-size: cover; background-position: center;">
    </div>
    <!--/.bg-holder-->

    <div class="container" style="padding-top: 20px">
        <div class="row justify-content-center">
            <h1 class="text-center mb-5">Jumlah Alumni Tahun 2021</h1>
            <div class="col-sm-6 col-lg-3 text-center mb-5">
                <img src="{{ url('cewek.png') }}" height="100" alt="..." />
                <h1 class="my-2">{{ $perempuan }}</h1>
                <p class="text-info fw-bold">PEREMPUAN</p>
            </div>
            <div class="col-sm-6 col-lg-3 text-center mb-5">
                <img src="{{ url('cowok.png') }}" height="100" alt="..." />
                <h1 class="my-2">{{ $laki }}</h1>
                <p class="text-info fw-bold">LAKI-LAKI</p>
            </div>
        </div>
    </div>
</section>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>

    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    @if ($message = Session::get('data-kosong'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Data Kosong',
            text: '{{ $message }}'
        })
    </script>
    @endif
@endpush
