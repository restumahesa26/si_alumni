@extends('layouts.admin')

@section('title')
    <title>Admin | Laporan Mahasiswa</title>
@endsection

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Laporan Data Mahasiswa</h4>
                    <p>Mencetak semua laporan data mahasiswa</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data-mahasiswa.index') }}">Data Mahasiswa</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('laporan.excel-mahasiswa') }}" class="btn btn-success btn-block text-white">Cetak Laporan Excel</a>
                        <a href="{{ route('laporan.pdf-mahasiswa') }}" class="btn btn-primary btn-block mb-3">Cetak Laporan PDF</a>
                        <div class="table-responsive mt-2">
                            <table id="table" class="table table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NPM</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No Handphone</th>
                                        <th>Agama</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->users->npm }}</td>
                                        <td>{{ $item->users->nama }}</td>
                                        <td>{{ $item->users->email }}</td>
                                        <td>{{ $item->no_hp }}</td>
                                        <td>{{ $item->agama }}</td>
                                        <td>{{ $item->alamat }}</td>
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
