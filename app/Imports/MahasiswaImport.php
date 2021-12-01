<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MahasiswaImport implements ToCollection, WithStartRow
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

            Mahasiswa::create([
                'user_id' => $user->id,
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
                'berat_badan' => $row[17]
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
