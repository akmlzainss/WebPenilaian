<?php

namespace App\Exports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NilaiExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Nilai::with('murid', 'mapel')->get();
    }

    public function headings(): array
    {
        return [
            'NIS',
            'Nama Murid',
            'Kode Mapel',
            'Mata Pelajaran',
            'Nilai',
            'Predikat',
            'Semester',
            'Created At',
            'Updated At',
        ];
    }

    public function map($nilai): array
    {
        return [
            $nilai->nis,
            $nilai->murid->nama ?? 'N/A',
            $nilai->kode,
            $nilai->mapel->mata_pelajaran ?? 'N/A',
            $nilai->nilai,
            $nilai->predikat,
            $nilai->semester,
            $nilai->created_at,
            $nilai->updated_at,
        ];
    }
}