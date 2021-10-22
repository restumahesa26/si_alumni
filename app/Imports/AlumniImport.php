<?php

namespace App\Imports;

use App\Models\Alumni;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AlumniImport implements ToCollection, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $user = User::create([
                'npm' => $row[1],
                'nama' => $row[2],
                'email' => $row[14],
                'password' => Hash::make('password'),
            ]);

            Alumni::create([
                'user_id' => $user->id,
                'npm' => $row[1],
                'nama' => $row[2],
                'agama' => $row[3],
                'tempat_lahir' => $row[4],
                'tanggal_lahir' => $this->transformDate($row[5]),
                'jenis_kelamin' => $row[6],
                'alamat' => $row[7],
                'nama_ayah' => $row[8],
                'nama_ibu' => $row[9],
                'alamat_orang_tua' => $row[10],
                'pekerjaan_ayah' => $row[11],
                'pekerjaan_ibu' => $row[12],
                'no_hp' => $row[13],
                'golongan_darah' => $row[15],
                'tinggi_badan' => $row[16],
                'berat_badan' => $row[17],
                'status' => $row[18],
                'judul_skripsi' => $row[19],
                'asal_slta' => $row[20],
                'tanggal_wisuda' => $this->transformDate($row[21]),
                'tanggal_sidang' => $this->transformDate($row[22]),
                'bobot_sks' => $row[23],
                'tanggal_seminar_proposal' => $this->transformDate($row[24]),
                'tanggal_mulai_bimbingan' => $this->transformDate($row[25]),
                'dosen_pembimbing_1' => $row[26],
                'dosen_pembimbing_2' => $row[27],
                'dosen_penguji_1' => $row[28],
                'dosen_penguji_2' => $row[29],
                'jumlah_sks' => $row[30]
            ]);
        }
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
