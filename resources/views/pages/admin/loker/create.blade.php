@extends('layouts.admin')

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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Lowongan Kerja</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah Data</a></li>
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
                                <label for='judul'>Judul Lowongan Kerja</label>
                                <input class='form-control @error('judul') is-invalid @enderror' type='text' name='judul' id='judul' placeholder='Masukkan Judul Lowongan Kerja' value='{{ old('judul') }}' />
                                @error('judul')
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
                                <label for='kriteria_kerja'>Kriteria Kerja</label>
                                <input class='form-control @error('kriteria_kerja') is-invalid @enderror' type='text' name='kriteria_kerja' id='kriteria_kerja' placeholder='Masukkan Kriteria Kerja' value='{{ old('kriteria_kerja') }}' />
                                @error('kriteria_kerja')
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
            height: 500
        });
    </script>
@endpush

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Loker') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-8 py-8">
                <form action="{{ route('loker.store') }}" class="w-full" method="POST">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="judul" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Judul
                            </label>
                            <input type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="judul" value="{{ old('judul') }}" placeholder="Masukkan Judul" name="judul">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="tempat_kerja" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Tempat Kerja
                            </label>
                            <input type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="tempat_kerja" value="{{ old('tempat_kerja') }}" placeholder="Masukkan Tempat Kerja" name="tempat_kerja">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="isi" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Isi Loker
                            </label>
                            <textarea name="isi" id="isi" cols="30" rows="10" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">{{ old('isi') }}</textarea>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 text-center">
                            <button type="submit" class="bg-blue-400 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full">
                                Simpan Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('isi', {
            height: 500
        });
    </script>
@endpush
</x-app-layout>

 --}}
