<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MahasiswaExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mahasiswa::with(['users'])->get();
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
            'Nomor Handphone',
            'Golongan Darah',
            'Tinggi Badan',
            'Berat Badan',
            'Foto',
            'Created At',
            'Updated At',
        ];
    }
}
