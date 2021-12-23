<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MahasiswaExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mahasiswa::with('users')->get();
    }

    public function map($mahasiswa): array
    {
        return [
            $mahasiswa->id,
            $mahasiswa->users->nama,
            $mahasiswa->agama,
            $mahasiswa->tempat_lahir,
            $mahasiswa->tanggal_lahir,
            $mahasiswa->jenis_kelamin,
            $mahasiswa->alamat,
            $mahasiswa->nama_ayah,
            $mahasiswa->nama_ibu,
            $mahasiswa->alamat_orang_tua,
            $mahasiswa->pekerjaan_ayah,
            $mahasiswa->pekerjaan_ibu,
            $mahasiswa->users->email,
            $mahasiswa->no_hp,
            $mahasiswa->golongan_darah,
            $mahasiswa->tinggi_badan,
            $mahasiswa->berat_badan,
            $mahasiswa->foto,
            $mahasiswa->created_at,
            $mahasiswa->updated_at,
            $mahasiswa->angkatan,
        ];
    }

    public function headings(): array
    {
        return [
            'Id',
            'Nama',
            'Agama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Alamat',
            'Nama Ayah',
            'Nama Ibu',
            'Alamat Orang Tua',
            'Pekerjaan Ayah',
            'Pekerjaan Ibu',
            'Email',
            'Nomor Handphone',
            'Golongan Darah',
            'Tinggi Badan',
            'Berat Badan',
            'Foto',
            'Created At',
            'Updated At',
            'Angkatan'
        ];
    }
}
