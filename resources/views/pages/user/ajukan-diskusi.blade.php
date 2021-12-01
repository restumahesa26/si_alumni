@extends('layouts.user')

@section('content')
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <a class="d-flex align-items-center" href="{{ route('user.diskusi') }}"><i class="fas fa-arrow-circle-left fa-3x"></i>
                    <div class="btn btn-lg col-auto border-0" style="font-size: 24pt">
                        Kembali
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- <section> close ============================-->
<!-- ============================================-->

<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="pt-2 pb-2">
    <div class="container">
        <div class="row">
            <div class="p-5">
                <div class="border rounded-3 border-3 border-primary p-4">
                    <form action="{{ route('user.ajukan-diskusi-store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <h1>Ajukan Pertanyaan</h1>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label for="judul">Judul Pertanyaan</label>
                                <input class="form-control" type="text" name="judul" id="judul"
                                    placeholder="Judul Pertanyaan" value="{{ old('judul') }}" />
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="isi">Deskripsi</label>
                                <textarea class="ckeditor" id="isi" name="isi"
                                    placeholder="Ketikkan teks disini..." cols="30" rows="10">{{ old('isi') }}</textarea>
                            </div>
                            <div class="col-md-12 mt-5 text-end">
                                <button class="btn btn-lg btn-primary fs-lg-1" type="submit" aria-expanded="false">
                                    Kirim
                                </button>
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
@endpush
