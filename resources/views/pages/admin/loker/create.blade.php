@extends('layouts.admin')

@section('title')
    <title>Admin | Tambah Loker</title>
@endsection

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Tambah Lowongan Kerja</h4>
                    <p>Form Menambahkan Lowongan Kerja</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('loker.index') }}">Lowongan Kerja</a></li>
                    <li class="breadcrumb-item active"><a href="#">Tambah Data</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('loker.index') }}" class="btn btn-warning btn-sm mr-2 text-white">
                            <i class="ti-angle-double-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body px-4">
                        <form action="{{ route('loker.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for='jenis_pekerjaan'>Jenis Pekerjaan</label>
                                <input class='form-control @error('jenis_pekerjaan') is-invalid @enderror' type='text' name='jenis_pekerjaan' id='jenis_pekerjaan' placeholder='Masukkan Jenis Pekerjaan' value='{{ old('jenis_pekerjaan') }}' />
                                @error('jenis_pekerjaan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='tempat_kerja'>Tempat Kerja</label>
                                <input class='form-control @error('tempat_kerja') is-invalid @enderror' type='text' name='tempat_kerja' id='tempat_kerja' placeholder='Masukkan Tempat Kerja' value='{{ old('tempat_kerja') }}' />
                                @error('tempat_kerja')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='lokasi_kerja'>Lokasi Kerja</label>
                                <input class='form-control @error('lokasi_kerja') is-invalid @enderror' type='text' name='lokasi_kerja' id='lokasi_kerja' placeholder='Masukkan Lokasi Kerja' value='{{ old('lokasi_kerja') }}' />
                                @error('lokasi_kerja')
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
    <script type="text/javascript" src="{{ url('frontend/public/assets/js/ckeditor/ckeditor.js') }}"></script>

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
