@extends('layouts.admin')

@section('title')
    <title>Admin | Data Mahasiswa</title>
@endsection

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Data Mahasiswa</h4>
                    <p>Menampilkan Semua Data Mahasiswa</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data-mahasiswa.index') }}">Data Mahasiswa</a></li>
                </ol>
            </div>
        </div>

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong class="text-primary">{{ $message }}</strong>
        </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('data-mahasiswa.create') }}"
                            class="btn btn-primary px-4 text-white mb-2">Tambah Data Mahasiswa</a>
                        <button type="button" class="btn btn-info px-4 mb-2 text-white" data-toggle="modal"
                            data-target="#modal-import">
                            Import Database
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="modal-import" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Database Mahasiswa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('import-mahasiswa-excel') }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
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
                                        <th>Email</th>
                                        <th>No Handphone</th>
                                        <th>Aksi</th>
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
                                        <td>
                                            <button type="button" class="btn btn-success text-white btn-sm" data-toggle="modal"
                                                data-target="#modal-mahasiswa{{ $item->id }}">
                                                Lihat
                                            </button>
                                            <a href="{{ route('data-mahasiswa.edit', $item->id) }}"
                                                class="btn btn-primary btn-sm mr-1">Ubah</a>
                                            <form action="{{ route('data-mahasiswa.destroy', $item->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-hapus">Hapus</button>
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
<div class="modal fade" id="modal-mahasiswa{{ $item2->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Jadikan sebagai Alumni</h5>
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
                            <h5>{{ $item2->users->npm }}</h5>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>Nama</h5>
                        </div>
                        <div class="col-lg-8">
                            <h5>{{ $item2->users->nama }}</h5>
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
                            <h5>{{ $item2->tempat_lahir }}, @if ($item2->tanggal_lahir)
                                {{ Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') }}
                            @endif </h5>
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
                            @elseif ($item2->jenis_kelamin == 'P')
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
                <form action="{{ route('data-alumni.change-to-alumni', $item2->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Pindah Ke Alumni</button>
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

    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                ordering: false
            });
        });
    </script>

    @if ($message = Session::get('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ $message }}'
        })
    </script>
    @endif

    <script>
        $('.btn-hapus').on('click', function (e) {
            e.preventDefault(); // prevent form submit
            var form = event.target.form;
            Swal.fire({
            title: 'Yakin Menghapus Data?',
            text: "Data Akan Terhapus Permanen",
            icon: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }else {
                    //
                }
            });
        });
    </script>
@endpush
