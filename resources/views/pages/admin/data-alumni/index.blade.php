@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Data Alumni</h4>
                    <p>Menampilkan Semua Data Alumni</p>
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
                        <a href="{{ route('data-alumni.create') }}" class="btn btn-primary px-4 text-white mb-2">Tambah
                            Data Alumni</a>
                        <button type="button" class="btn btn-primary px-4 mb-2" data-toggle="modal"
                            data-target="#modal-import">
                            Import Database
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="modal-import" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Database Alumni</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('import-alumni-excel') }}" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="file">Pilih file yang ingin diimport</label>
                                            <input type="file" class="form-control" name="file" id="file">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-dismiss="modal">Batal</button>
                                        <button type='submit' class='btn btn-primary'>Import</button>
                                    </div>
                                    </form>
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->npm }}</td>
                                        <td>{{ $item->nama }}</td>
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
                                            @endif</td>
                                        <td>
                                            <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                                data-target="#modal-alumni{{ $item->id }}">
                                                Lihat
                                            </button>
                                            <a href="{{ route('data-alumni.edit', $item->id) }}"
                                                class="btn btn-primary btn-sm mr-1">Edit</a>
                                            <form action="{{ route('data-alumni.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
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
@foreach ($items as $item2)
<!-- Modal -->
<div class="modal fade" id="modal-alumni{{ $item2->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Jadikan sebagai Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>NPM</h5>
                        </div>
                        <div class="col-lg-8">
                            <h5>{{ $item2->npm }}</h5>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>Nama</h5>
                        </div>
                        <div class="col-lg-8">
                            <h5>{{ $item2->nama }}</h5>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>Agama</h5>
                        </div>
                        <div class="col-lg-8">
                            <h5>{{ $item2->agama }}</h5>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>Tempat, Tanggal Lahir</h5>
                        </div>
                        <div class="col-lg-8">
                            <h5>{{ $item2->tempat_lahir }},
                                {{ Carbon\Carbon::parse($item2->tanggal_lahir)->translatedFormat('d F Y') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>Jenis Kelamin</h5>
                        </div>
                        <div class="col-lg-8">
                            <h5>@if ($item2->jenis_kelamin == 'L')
                                Laki-Laki
                                @else
                                Perempuan
                                @endif</h5>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>Alamat</h5>
                        </div>
                        <div class="col-lg-8">
                            <h5>{{ $item2->alamat }}</h5>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>Nama Ayah dan Nama Ibu</h5>
                        </div>
                        <div class="col-lg-8">
                            <h5>{{ $item2->nama_ayah }} dan {{ $item2->nama_ibu }}</h5>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>Alamat Orang Tua</h5>
                        </div>
                        <div class="col-lg-8">
                            <h5>{{ $item2->alamat_orang_tua }}</h5>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>Pekerjaan Ayah dan Ibu</h5>
                        </div>
                        <div class="col-lg-8">
                            <h5>{{ $item2->pekerjaan_ayah }} dan {{ $item2->pekerjaan_ibu }}</h5>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>No. Handphone</h5>
                        </div>
                        <div class="col-lg-8">
                            <h5>{{ $item2->no_hp }}</h5>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>Golongan Darah</h5>
                        </div>
                        <div class="col-lg-8">
                            <h5>{{ $item2->golongan_darah }}</h5>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>Tinggi Badan</h5>
                        </div>
                        <div class="col-lg-8">
                            <h5>{{ $item2->tinggi_badan }}</h5>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>Berat Badan</h5>
                        </div>
                        <div class="col-lg-8">
                            <h5>{{ $item2->berat_badan }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <form action="{{ route('data-mahasiswa.change-to-mahasiswa', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Pindah Ke Mahasiswa</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('addon-style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endpush

@push('addon-script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function () {
        $('#table').DataTable({
            ordering: false
        });
    });
</script>
@endpush

{{--
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Alumni') }}
</h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-8 py-8">
            <a href="{{ route('data-alumni.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Tambah Data Alumni</a>
            <table class="table-auto w-full mt-5">
                <thead>
                    <tr>
                        <th class="border px-6 py-4">No</th>
                        <th class="border px-6 py-4">NPM</th>
                        <th class="border px-6 py-4">Nama</th>
                        <th class="border px-6 py-4">Tahun Wisuda</th>
                        <th class="border px-6 py-4">No Ijazah</th>
                        <th class="border px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                    <tr>
                        <td class="border text-center px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="border text-center px-6 py-4">{{ $item->npm }}</td>
                        <td class="border text-center px-6 py-4">{{ $item->nama }}</td>
                        <td class="border text-center px-6 py-4">{{ $item->tahun_wisuda }}</td>
                        <td class="border text-center px-6 py-4">{{ $item->no_ijazah }}</td>
                        <td class="border text-center px-6 py-4">
                            <a href="{{ route('data-alumni.edit', $item->id) }}"
                                class="inline-block bg-blue-500 hover:bg-blue-800 text-white px-4 py-2 rounded font-bold mx-1 text-sm">Edit</a>
                            <form action="{{ route('data-alumni.destroy', $item->id) }}" method="POST"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded font-bold mx-1 text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="border text-center px-6 py-4" colspan="5">Data Kosong</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout> --}}
