@extends('layouts.admin')

@section('title')
    <title>Admin | Berita</title>
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Berita</h4>
                        <p>Menampilkan Semua Berita</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Berita</a></li>
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
                            <a href="{{ route('berita.create') }}" class="btn btn-primary px-4 text-white mb-2">Tambah Berita</a>
                            <div class="table-responsive mt-2">
                                <table id="table" class="table table-bordered text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Thumbnail</th>
                                            <th>Judul Berita</th>
                                            <th>Populer</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('storage/assets/berita-thumbnail/' . $item->thumbnail) }}" alt="gambar-thumbnail" style="width: 200px;"></td>
                                            <td>{{ $item->judul }}</td>
                                            <td>
                                                @if ($item->is_populer == 0)
                                                    Tidak
                                                @else
                                                    Ya
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->is_populer == 0)
                                                <a href="{{ route('berita.set-populer', $item->id) }}" class="btn btn-info btn-sm mr-1 text-white btn-set-populer">Set Populer</a>
                                                @else
                                                <a href="{{ route('berita.set-not-populer', $item->id) }}" class="btn btn-warning btn-sm mr-1 text-white btn-set-non-populer">Set Non Populer</a>
                                                @endif
                                                <a href="{{ route('berita.edit', $item->id) }}" class="btn btn-primary btn-sm mr-1">Ubah</a>
                                                <form action="{{ route('berita.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mr-1 btn-hapus">Hapus</button>
                                                </form>
                                                <a href="{{ route('berita.show', $item->id) }}" class="btn btn-info btn-sm mr-1 text-white">Lihat Komentar</a>
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
@endsection

@push('addon-style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endpush

@push('addon-script')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    <script>
        $(document).ready( function () {
            $('#table').DataTable({
                ordering: false
            });
        });
    </script>

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

        $('.btn-set-populer').on('click', function (event) {
            event.preventDefault(); // prevent form submit
            var form = $(this).attr('href');
            Swal.fire({
                title: 'Set Sebagai Berita Populer?',
                text: "Jadikan Sebagai Berita Populer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = form;
                }else {
                    //
                }
            });
        });

        $('.btn-set-non-populer').on('click', function (event) {
            event.preventDefault(); // prevent form submit
            var form = $(this).attr('href');
            Swal.fire({
                title: 'Set Sebagai Berita Non Populer?',
                text: "Jadikan Sebagai Berita Non Populer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = form;
                }else {
                    //
                }
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
@endpush


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-8 py-8">
                <a href="{{ route('berita.create') }}" class="bg-blue-500 hover:bg-blue-600 font-bold rounded text-white py-2 px-6 text-sm">Tambah Data Berita</a>
                <table class="table-auto w-full mt-6 table-responsive">
                    <thead>
                        <tr>
                            <th class="border px-6 py-4">No</th>
                            <th class="border px-6 py-4">Thumbnail</th>
                            <th class="border px-6 py-4">Judul Berita</th>
                            <th class="border px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td class="border text-center px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="border text-center px-6 py-4">
                                    <img src="{{ asset('storage/assets/berita-thumbnail/' . $item->thumbnail) }}" alt="gambar-thumbnail" style="width: 200px;" class="mx-auto">
                                </td>
                                <td class="border text-center px-6 py-4">{{ $item->judul }}</td>
                                <td class="border text-center px-6 py-4">
                                    <a href="{{ route('berita.edit', $item->id) }}" class="inline-block bg-blue-500 hover:bg-blue-800 text-white px-4 py-2 rounded font-bold mx-1 text-sm">Edit</a>
                                    <form action="{{ route('berita.destroy', $item->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded font-bold mx-1 text-sm btn-hapus">Hapus</button>
                                    </form>
                                    <a href="{{ route('berita.show', $item->id) }}" class="inline-block bg-green-400 hover:bg-green-600 text-white px-4 py-2 rounded font-bold mx-1 text-sm mt-2">Lihat Komentar</a>
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
@push('addon-script')
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ url('js/jquery-3.4.1.min.js') }}"></script>

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
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }else {
                    Swal.fire('Data Batal Dihapus');
                }
            });
        });
    </script>
@endpush
</x-app-layout> --}}
