@extends('layouts.admin')

@section('title')
    <title>Admin | Laporan Alumni</title>
@endsection

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Laporan Data Alumni</h4>
                    <p>Mencetak semua laporan data alumni</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Alumni</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('laporan.excel-alumni') }}" class="btn btn-success btn-block text-white">Cetak Laporan Excel</a>
                        <button type="button" class="btn btn-primary btn-block mb-3" data-toggle="modal"
                            data-target="#modal-laporan">
                            Cetak Laporan
                        </button>
                        <div class="modal fade" id="modal-laporan" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Alumni</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-4">
                                                <form action="{{ route('laporan.pdf-angkatan-alumni') }}">
                                                    <div class="form-group">
                                                        <label for="angkatan">Angkatan</label>
                                                        <input type="number" name="angkatan" id="angkatan" class="form-control" placeholder="Angkatan">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-sm btn-block">Cetak Sesuai Angkatan</button>
                                                </form>
                                            </div>
                                            <div class="col-lg-4">
                                                <form action="{{ route('laporan.pdf-tahun-lulus-alumni') }}">
                                                    <div class="form-group">
                                                        <label for="tahun_lulus">Tahun Lulus</label>
                                                        <input type="number" name="tahun_lulus" id="tahun_lulus" class="form-control" placeholder="Tahun Lulus">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-sm btn-block">Cetak Sesuai Tahun Lulus</button>
                                                </form>
                                            </div>
                                            <div class="col-lg-4 mt-auto">
                                                <h5 class="text-center">Cetak Semua Data</h5>
                                                <a href="{{ route('laporan.pdf-keseluruhan-alumni') }}" class="btn btn-primary btn-sm btn-block">Cetak Semua Data</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive mt-2">
                            <table id="table" class="table table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NPM</th>
                                        <th>Nama</th>
                                        <th>Tanggal Sidang</th>
                                        <th>Tanggal Wisuda</th>
                                        <th>Judul Skripsi</th>
                                        <th>Angkatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->users->npm }}</td>
                                        <td>{{ $item->users->nama }}</td>
                                        <td>@if ($item->tanggal_sidang != NULL)
                                            {{ Carbon\Carbon::parse($item->tanggal_sidang)->translatedFormat('l, d F Y') }}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>@if ($item->tanggal_wisuda != NULL)
                                            {{ Carbon\Carbon::parse($item->tanggal_wisuda)->translatedFormat('l, d F Y') }}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>{{ $item->judul_skripsi }}</td>
                                        <td>{{ $item->angkatan }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Data Kosong</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    @if ($message = Session::get('error-pdf'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ $message }}'
        })
    </script>
    @endif
@endpush
