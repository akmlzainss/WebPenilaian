<?php

namespace App\Exports;

use App\Models\Murid;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MuridExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Murid::all();
    }

    public function headings(): array
    {
        return [
            'NIS',
            'Nama',
            'Kelas',
            'Jenis Kelamin',
            'No Telp',
            'Tanggal Lahir',
            'Username User',
            'Created At',
            'Updated At',
        ];
    }
}