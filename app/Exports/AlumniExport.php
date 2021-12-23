<?php

namespace App\Exports;

use App\Models\Alumni;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlumniExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Alumni::with(['users'])->get();
    }

    public function map($alumni): array
    {
        return [
            $alumni->id,
            $alumni->users->nama,
            $alumni->agama,
            $alumni->tempat_lahir,
            $alumni->tanggal_lahir,
            $alumni->jenis_kelamin,
            $alumni->alamat,
            $alumni->nama_ayah,
            $alumni->nama_ibu,
            $alumni->alamat_orang_tua,
            $alumni->pekerjaan_ayah,
            $alumni->pekerjaan_ibu,
            $alumni->users->email,
            $alumni->no_hp,
            $alumni->golongan_darah,
            $alumni->tinggi_badan,
            $alumni->berat_badan,
            $alumni->pekerjaan,
            $alumni->tempat_pekerjaan,
            $alumni->status,
            $alumni->judul_skripsi,
            $alumni->asal_slta,
            $alumni->tanggal_wisuda,
            $alumni->tanggal_sidang,
            $alumni->bobot_sks,
            $alumni->tanggal_seminar_proposal,
            $alumni->tanggal_mulai_bimbingan,
            $alumni->dosen_pembimbing_1,
            $alumni->dosen_pembimbing_2,
            $alumni->dosen_penguji_1,
            $alumni->dosen_penguji_2,
            $alumni->jumlah_sks,
            $alumni->foto,
            $alumni->created_at,
            $alumni->updated_at,
            $alumni->ipk,
            $alumni->angkatan,
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
