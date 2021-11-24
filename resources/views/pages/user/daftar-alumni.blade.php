@extends('layouts.user')

@section('content')
<section class="">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <h1 class="mb-6">Daftar Alumni</h1>
            </div>

            <div class="col-md-12">
                <div class="table-responsive">
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
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->nama }}</td>
                                <td>{{ $item->user->npm }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_wisuda)->translatedFormat('Y') }}</td>
                                <td>{{ $item->pekerjaan }}</td>
                                <td><a href="detail-alumni.html"><button class="btn btn-info">Detail</button></a></td>
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
                <img src="{{ url('frontend/public/assets/img/gallery/published.png') }}" height="100" alt="..." />
                <h1 class="my-2">{{ $perempuan }}</h1>
                <p class="text-info fw-bold">PEREMPUAN</p>
            </div>
            <div class="col-sm-6 col-lg-3 text-center mb-5">
                <img src="{{ url('frontend/public/assets/img/gallery/awards.png') }}" height="100" alt="..." />
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
            $('#table').DataTable({
                'ordering': false
            });
        });
    </script>
@endpush
