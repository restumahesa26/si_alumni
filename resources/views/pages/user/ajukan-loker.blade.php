@extends('layouts.user')

@section('title')
    <title>SI Alumni Informatika | Ajukan Loker</title>
@endsection

@section('content')
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <a class="d-flex align-items-center" href="{{ route('user.loker') }}"><i
                        class="fas fa-arrow-circle-left fa-3x"></i>
                    <div class="btn btn-lg col-auto border-0" style="font-size: 24pt">
                        Kembali
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="pt-2 pb-2">
    <div class="container">
        <div class="row">
            <div class="p-5">
                <div class="border rounded-3 border-3 border-primary p-4">
                    <form action="{{ route('user.ajukan-loker-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row border-bottom border-3 border-secondary">
                            <div class="col-lg-12">
                                <h1>Ajukan Lowongan Pekerjaan</h1>
                            </div>
                            <div class="col mx-auto p-3 align-self-center text-center">
                                <p class="uploadLogo">
                                    <label for="logo">
                                        <img src="{{ url('frontend/public/assets/img/gallery/macrohard.png') }}"
                                            alt="alumni-profile" width="100px" class="btn" id="logo_url" />
                                    </label>
                                    <label for="logo">
                                        <a class="btn btn-secondary" rel="nofollow">Upload Logo</a>
                                    </label>
                                    <input class="d-none" type="file" name="logo" id="logo" />
                                </p>
                            </div>
                            <div class="col-md-9 d-grid gap-3 pt-3 pb-4">
                                <div>
                                    <label for="jenis_pekerjaan">
                                        Jenis Pekerjaan
                                    </label>
                                    <input class="form-control @error('jenis_pekerjaan') is-invalid @enderror" name="jenis_pekerjaan" id="jenis_pekerjaan" type="text"
                                        placeholder="Jenis Pekerjaan" value="{{ old('jenis_pekerjaan') }}" required />
                                    @error('jenis_pekerjaan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="tempat_kerja">Perusahaan/Instansi</label>
                                    <input class="form-control @error('tempat_kerja') is-invalid @enderror" type="text" name="tempat_kerja" id="tempat_kerja"
                                        placeholder="Perusahaan/Instansi" value="{{ old('tempat_kerja') }}" required />
                                    @error('tempat_kerja')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="lokasi_kerja">Lokasi</label>
                                    <input class="form-control @error('lokasi_kerja') is-invalid @enderror" type="text" name="lokasi_kerja" id="lokasi_kerja"
                                        placeholder="Lokasi" value="{{ old('lokasi_kerja') }}" required />
                                    @error('lokasi_kerja')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="isi">Deskripsi</label>
                                <textarea class="ckeditor" name="isi" id="isi" placeholder="Ketikkan teks disini..."
                                    cols="30" rows="10">{{ old('isi') }}</textarea>
                            </div>
                            <div class="col-md-12 mt-5 text-end">
                                <button class="btn btn-lg btn-secondary" type="submit" aria-expanded="false">
                                    Ajukan Loker
                                </button>
                            </div>
                            <div class="col-md-12 mt-2">
                                <p>
                                    Lowongan akan tampil di daftar loker apabila disetujui
                                    oleh administrator.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end of .container-->
</section>
@endsection

@push('addon-script')
<script type="text/javascript" src="{{ url('frontend/public/assets/js/ckeditor/ckeditor.js') }}"></script>
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

    $("#logo").change(function(){
        bacaGambar(this);
    });
</script>

<script>
    CKEDITOR.replace('isi', {
            height: 500,
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form'
        });
</script>
@endpush
