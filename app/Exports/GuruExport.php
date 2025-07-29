<?php

namespace App\Exports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuruExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Guru::all();
    }

    public function headings(): array
    {
        return [
            'NIP',
            'Nama',
            'Email',
            'Jenis Kelamin',
            'No Telp',
            'Tanggal Lahir',
            'Kode Mapel',
            'Username User',
            'Created At',
            'Updated At',
        ];
    }
}