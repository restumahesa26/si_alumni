@extends('layouts.admin')

@section('title')
    <title>Admin | Ubah Loker</title>
@endsection

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Ubah Lowongan Kerja</h4>
                    <p>Form Mengubah Lowongan Kerja</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('loker.index') }}">Lowongan Kerja</a></li>
                    <li class="breadcrumb-item"><a href="#">Ubah Data</a></li>
                    <li class="breadcrumb-item active"><a href="#">{{ $item->judul }}</a></li>
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
                        <form action="{{ route('loker.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <div class="col-2">
                                    <img src="{{ $item->logo_perusahaan ? asset('storage/assets/foto-loker/' . $item->logo_perusahaan) : url('frontend/public/assets/img/gallery/macrohard.png') }}" alt="alumni-profile" width="100px" class="btn" id="logo_url" />
                                </div>
                                <div class="col-md-10">
                                    <label for='logo_perusahaan'>Logo Perusahaan</label>
                                    <input class='form-control @error('logo_perusahaan') is-invalid @enderror' type='file' name='logo_perusahaan' id='logo_perusahaan' placeholder='Masukkan Logo Perusahaan'/>
                                    @error('logo_perusahaan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for='jenis_pekerjaan'>Jenis Pekerjaan</label>
                                <input class='form-control @error('jenis_pekerjaan') is-invalid @enderror' type='text' name='jenis_pekerjaan' id='jenis_pekerjaan' placeholder='Masukkan Jenis Pekerjaan' value='{{ $item->jenis_pekerjaan }}' required />
                                @error('jenis_pekerjaan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='tempat_kerja'>Tempat Kerja</label>
                                <input class='form-control @error('tempat_kerja') is-invalid @enderror' type='text' name='tempat_kerja' id='tempat_kerja' placeholder='Masukkan Tempat Kerja' value='{{ $item->tempat_kerja }}' required />
                                @error('tempat_kerja')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='lokasi_kerja'>Lokasi Kerja</label>
                                <input class='form-control @error('lokasi_kerja') is-invalid @enderror' type='text' name='lokasi_kerja' id='lokasi_kerja' placeholder='Masukkan Lokasi Kerja' value='{{ $item->lokasi_kerja }}' required />
                                @error('lokasi_kerja')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='isi'>Isi</label>
                                <textarea class='form-control' name='isi' id='isi' placeholder='Masukkan Isi Lowongan Kerja' required>{!! $item->isi !!}</textarea>
                            </div>
                            <button type='submit' class='btn btn-primary btn-block py-2 btn-edit'>Simpan</button>
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

    <script>
        function bacaGambar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#logo_url').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#logo_perusahaan").change(function(){
            bacaGambar(this);
        });
    </script>

    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    <script>
        $('.btn-edit').on('click', function (e) {
            e.preventDefault(); // prevent form submit
            var form = event.target.form;
            Swal.fire({
            title: 'Yakin Menyimpan Perubahan?',
            text: "Data Akan Tersimpan",
            icon: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan',
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
