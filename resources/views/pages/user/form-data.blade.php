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
            <div class="row justify-content-center text-center">
                <div class="col-3">
                    <img src="logo-unib.png" alt="" srcset="" style=" width: 180px; margin-left: -200px;">
                </div>
                <div class="col-9 mt-4" style="margin-left: -240px;">
                    <h4>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</h4>
                    <h4>RISET DAN TEKNOLOGI</h4>
                    <h4>UNIVERSITAS BENGKULU</h4>
                    <H4>FAKULTAS TEKNIK</H4>
                    <h5>Jalan WR. Supratman Kandang Limun Bengkulu</h5>
                    <h5>Telpon : (0736) 21170, 21884 Faksimile : (0736) 22105</h5>
                    <h5>Laman : ft.unib.ac.id e-mail : ft@unib.ac.id</h5>
                </div>
            </div>
            <hr style="border: 2px solid #000;">
            <h5 style="text-decoration: underline; font-weight: 800; text-underline-offset: 3px;" class="text-center">DATA ALUMNI LULUSAN FAKULTAS TEKNIK UNIB</h5>
            <div class="row justify-content-between mt-3 align-items-center">
                <div class="col">
                    <p>BULAN : </p>
                    <p style="margin-top: -16px;">TAHUN : </p>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-end">
                        <img src="{{ asset('storage/assets/foto-profil/' . $item->foto) }}" alt="" height="150" style="border: 1px solid #000; padding: 5px;">
                    </div>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width: 3%;" class="text-center">1.</td>
                            <td style="width: 30%;">Nama</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->users->nama }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">2.</td>
                            <td style="width: 30%;">NPM</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->users->npm }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">3.</td>
                            <td style="width: 30%;">Program Studi</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">Informatika</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">4.</td>
                            <td style="width: 30%;">Agama</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->agama }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">5.</td>
                            <td style="width: 30%;">Tempat / Tgl Lahir</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->tempat_lahir }}, {{ Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">6.</td>
                            <td style="width: 30%;">Jenis Kelamin</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">@if ($item->jenis_kelamin == 'L')
                                Laki-Laki
                            @else
                                Perempuan
                            @endif</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">7.</td>
                            <td style="width: 30%;">Judul Skripsi</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->judul_skripsi }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">8.</td>
                            <td style="width: 30%;">Tanggal Kelulusan</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ Carbon\Carbon::parse($item->tanggal_sidang)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">9.</td>
                            <td style="width: 30%;">Tanggal Wisuda</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ Carbon\Carbon::parse($item->tanggal_wisuda)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">10.</td>
                            <td style="width: 30%;">IPK</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->ipk }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">11.</td>
                            <td style="width: 30%;">Nama Orang Tua</td>
                            <td style="width: 3%;"></td>
                            <td style="width: 64%;"></td>
                        </tr>
                        <tr>
                            <td style="width: 3%;"></td>
                            <td style="width: 30%;">Ayah</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->nama_ayah }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;"></td>
                            <td style="width: 30%;">Ibu</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->nama_ibu }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">12.</td>
                            <td style="width: 30%;">Alamat Orang Tua</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->alamat_orang_tua }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">13.</td>
                            <td style="width: 30%;">Pekerjaan Orang Tua</td>
                            <td style="width: 3%;"></td>
                            <td style="width: 64%;"></td>
                        </tr>
                        <tr>
                            <td style="width: 3%;"></td>
                            <td style="width: 30%;">Ayah</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->pekerjaan_ayah }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;"></td>
                            <td style="width: 30%;">Ibu</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->pekerjaan_ibu }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">14.</td>
                            <td style="width: 30%;">Alamat Mahasiswa</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->alamat }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">15.</td>
                            <td style="width: 30%;">No Telepon / HP</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->no_hp }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">16.</td>
                            <td style="width: 30%;">Email</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->users->email }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">17.</td>
                            <td style="width: 30%;">Golongan Darah</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->golongan_darah }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">18.</td>
                            <td style="width: 30%;">Tinggi Badan</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->tinggi_badan }}</td>
                        </tr>
                        <tr>
                            <td style="width: 3%;" class="text-center">19.</td>
                            <td style="width: 30%;">Berat Badan</td>
                            <td style="width: 3%;" class="text-center">:</td>
                            <td style="width: 64%;">{{ $item->berat_badan }}</td>
                        </tr>
                    </tbody>
                </table>
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
