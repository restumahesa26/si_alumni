<?php

namespace App\Exports;

use App\Models\Alumni;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlumniExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Alumni::with(['users'])->get();
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
            'Pekerjaan',
            'Tempat Pekerjaan',
            'Status',
            'Judul Skripsi',
            'Asal SLTA',
            'Tanggal Wisuda',
            'Tanggal Sidang',
            'Bobot SKS',
            'Tanggal Seminar Proposal',
            'Tanggal Mulai Bimbingan',
            'Dosen Pembimbing 1',
            'Dosen Pembimbing 2',
            'Dosen Penguji 1',
            'Dosen Penguji 2',
            'Jumlah SKS',
            'Foto',
            'Created At',
            'Updated At',
            'IPK',
            'Angkatan',
        ];
    }
}
