<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <style>
        tr td {
            padding-left: 5px !important;
            padding-right: 5px !important;
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
        body {
            font-family: 'Times New Roman';
        }

        h4 {
            margin-bottom: -6px;
        }

        h5 {
            margin-bottom: -2px;
        }

    </style>
</head>
<body>
    <page size="A4">
        <div class="container">
            <h5 style="text-decoration: underline; font-weight: 800; text-underline-offset: 3px;" class="text-center mb-5">BIODATA WISUDAWAN</h5>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td style="width: 28%;">Fakultas</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">Teknik Unib</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Program Studi</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">Informatika</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Nama</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ $item->users->nama }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">NPM</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ $item->users->npm }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Tempat, Tgl Lahir</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ $item->tempat_lahir }}, {{ Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Jenis Kelamin</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">@if ($item->jenis_kelamin == 'L')
                                Laki-Laki
                            @else
                                Perempuan
                            @endif</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Alamat</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ $item->alamat }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">HP / Telp</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ $item->no_hp }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Status</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ $item->status }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Asal SLTA</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ $item->asal_slta }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Tanggal Wisuda</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ Carbon\Carbon::parse($item->tanggal_wisuda)->translatedFormat('d F Y') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td style="width: 28%;">SKRIPSI</td>
                            <td style="width: 2%;"></td>
                            <td style="width: 70%;"></td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Tanggal Ujian</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ Carbon\Carbon::parse($item->tanggal_sidang)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Bobot SKS</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ $item->bobot_sks }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Judul</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ $item->judul_skripsi }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Tanggal Seminar Proposal</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ Carbon\Carbon::parse($item->tanggal_seminar_proposal)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Tanggal Mulai Bimbingan Skripsi</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ Carbon\Carbon::parse($item->tanggal_mulai_bimbingan)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Dosen Pembimbing Skripsi</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">1. {{ $item->dosen_pembimbing_1 }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;"></td>
                            <td style="width: 2%;"></td>
                            <td style="width: 70%;">2. {{ $item->dosen_pembimbing_2 }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Dosen Penguji Skripsi</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">1. {{ $item->dosen_penguji_1 }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;"></td>
                            <td style="width: 2%;"></td>
                            <td style="width: 70%;">2. {{ $item->dosen_penguji_1 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td style="width: 28%;">ORANG TUA</td>
                            <td style="width: 2%;"></td>
                            <td style="width: 70%;"></td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Nama Ayah</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ $item->nama_ayah }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Nama Ibu</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ $item->nama_ibu }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Pekerjaan</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">Ayah &nbsp;: {{ $item->pekerjaan_ayah }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;"></td>
                            <td style="width: 2%;"></td>
                            <td style="width: 70%;">Ibu &nbsp;&nbsp;&nbsp;&nbsp;: {{ $item->pekerjaan_ibu }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Alamat</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ $item->alamat_orang_tua }}</td>
                        </tr>
                        <tr>
                            <td style="width: 28%;">Jumlah SKS yang ditempuh</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 70%;">{{ $item->jumlah_sks }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-end mt-3">
                <div class="col-4">
                    <p>Bengkulu, </p>
                    <p style="margin-top: 90px; font-weight: bold">{{ $item->users->nama }}</p>
                </div>
            </div>
        </div>
    </page>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script>
    window.print();
</script>
</html>
