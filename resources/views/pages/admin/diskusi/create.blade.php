@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Tambah Diskusi</h4>
                    <p>Form Menambahkan Diskusi</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Diskusi</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah Data</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('diskusi.index') }}" class="btn btn-warning btn-sm mr-2 text-white">
                            <i class="ti-angle-double-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body px-4">
                        <form action="{{ route('diskusi.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for='judul'>Judul Diskusi</label>
                                <input class='form-control @error('judul') is-invalid @enderror' type='text' name='judul' id='judul' placeholder='Masukkan Judul Diskusi' value='{{ old('judul') }}' />
                                @error('judul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='isi'>Isi</label>
                                <textarea class='form-control' name='isi' id='isi' placeholder='Masukkan Isi Lowongan Kerja'>{{ old('isi') }}</textarea>
                                @error('isi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type='submit' class='btn btn-primary btn-block py-2'>Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('isi', {
            height: 500,
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>

    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Perhatikan Lagi Field Yang Diisi'
            })
        </script>
    @endif
@endpush
