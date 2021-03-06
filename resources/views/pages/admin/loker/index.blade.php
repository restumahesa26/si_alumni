@extends('layouts.admin')

@section('title')
    <title>Admin | Loker</title>
@endsection

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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('loker.index') }}">Lowongan Kerja</a></li>
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
                                            <th>Nama Pekerjaan</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Lokasi Perusahaan</th>
                                            <th>Nama Pembagi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->jenis_pekerjaan }}</td>
                                            <td>{{ $item->tempat_kerja }}</td>
                                            <td>{{ $item->lokasi_kerja }}</td>
                                            <td>{{ $item->users->nama }}</td>
                                            <td>
                                                @if ($item->status == '0')
                                                <a href="{{ route('loker.set-aktif', $item->id) }}" class="btn btn-success btn-sm mr-1 text-white btn-set-aktif">Set Aktif</a>
                                                @elseif ($item->status == '1')
                                                <a href="{{ route('loker.set-non-aktif', $item->id) }}" class="btn btn-warning btn-sm mr-1 text-white btn-set-non-aktif">Set Non Aktif</a>
                                                @endif
                                                <a href="{{ route('loker.edit', $item->id) }}" class="btn btn-primary btn-sm mr-1">Ubah</a>
                                                <form action="{{ route('loker.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mr-1 btn-hapus">Hapus</button>
                                                </form>
                                                <a href="{{ route('loker.show', $item->id) }}" class="btn btn-info btn-sm mr-1 text-white">Lihat Loker</a>
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

        $('.btn-set-aktif').on('click', function (event) {
            event.preventDefault(); // prevent form submit
            var form = $(this).attr('href');
            Swal.fire({
                title: 'Set Aktif?',
                text: "Jadikan Status Aktif",
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

        $('.btn-set-non-aktif').on('click', function (event) {
            event.preventDefault(); // prevent form submit
            var form = $(this).attr('href');
            Swal.fire({
                title: 'Set Tidak Aktif?',
                text: "Jadikan Status Non Aktif",
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
