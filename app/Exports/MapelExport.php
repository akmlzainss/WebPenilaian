<?php

namespace App\Exports;

use App\Models\Mapel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MapelExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Mapel::all();
    }

    public function headings(): array
    {
        return [
            'Kode',
            'Mata Pelajaran',
            'Created At',
            'Updated At',
        ];
    }
}