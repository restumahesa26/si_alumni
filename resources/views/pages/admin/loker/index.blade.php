@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Lowongan Kerja</h4>
                        <p>Menampilkan Semua Lowongan Kerja</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Lowongan Kerja</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('loker.create') }}" class="btn btn-primary px-4 text-white mb-2">Tambah Lowongan Kerja</a>
                            <div class="table-responsive mt-2">
                                <table id="table" class="table table-bordered text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Tempat Kerja</th>
                                            <th>Kriteria Kerja</th>
                                            <th>Nama Pembagi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->tempat_kerja }}</td>
                                            <td>{{ $item->kriteria_kerja }}</td>
                                            <td>{{ $item->users->nama }}</td>
                                            <td>
                                                <a href="{{ route('loker.edit', $item->id) }}" class="btn btn-primary btn-sm mr-1">Edit</a>
                                                <form action="{{ route('loker.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mr-1 btn-hapus">Hapus</button>
                                                </form>
                                                <a href="{{ route('loker.show', $item->id) }}" class="btn btn-info btn-sm mr-1 text-white">Lihat Diskusi</a>
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


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Loker') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-8 py-8">
                <a href="{{ route('loker.create') }}" class="bg-blue-500 hover:bg-blue-600 font-bold rounded text-white py-2 px-6 text-sm">Tambah Data Loker</a>
                <table class="table-auto w-full mt-6 table-responsive">
                    <thead>
                        <tr>
                            <th class="border px-6 py-4">No</th>
                            <th class="border px-6 py-4">Judul</th>
                            <th class="border px-6 py-4">Tempat Kerja</th>
                            <th class="border px-6 py-4">Nama Pembagi</th>
                            <th class="border px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td class="border text-center px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="border text-center px-6 py-4">{{ $item->judul }}</td>
                                <td class="border text-center px-6 py-4">{{ $item->tempat_kerja }}</td>
                                <td class="border text-center px-6 py-4">
                                    @if ($item->users->role === 'ALUMNI')
                                        {{ $item->users->alumni->nama }}
                                    @elseif ($item->users->role === 'MAHASISWA')
                                        {{ $item->users->mahasiswa->nama }}
                                    @elseif ($item->users->role === 'DOSEN')
                                        {{ $item->users->dosen->nama }}
                                    @endif
                                </td>
                                <td class="border text-center px-6 py-4">
                                    <a href="{{ route('loker.edit', $item->id) }}" class="inline-block bg-blue-500 hover:bg-blue-800 text-white px-4 py-2 rounded font-bold mx-1 text-sm">Edit</a>
                                    <form action="{{ route('loker.destroy', $item->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded font-bold mx-1 text-sm btn-hapus">Hapus</button>
                                    </form>
                                    <a href="{{ route('loker.show', $item->id) }}" class="inline-block bg-green-400 hover:bg-green-600 text-white px-4 py-2 rounded font-bold mx-1 text-sm mt-2">Lihat Tanya Jawab</a>
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