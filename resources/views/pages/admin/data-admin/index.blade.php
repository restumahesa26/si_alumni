@extends('layouts.admin')

@section('title')
    <title>Admin | Data Admin</title>
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Data Admin</h4>
                        <p>Menampilkan Semua Data Admin</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('data-admin.index') }}">Data Admin</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('data-admin.create') }}" class="btn btn-primary px-4 text-white mb-2">Tambah Data Admin</a>
                            <div class="table-responsive mt-2">
                                <table id="table" class="table table-bordered text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                <a href="{{ route('data-admin.edit', $item->id) }}" class="btn btn-primary btn-sm mr-1">Ubah</a>
                                                <form action="{{ route('data-admin.destroy', $item->id) }}" method="POST" class="d-inline">
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
