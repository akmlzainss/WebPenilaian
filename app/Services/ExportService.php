<?php

namespace App\Services;

use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class ExportService
{
    /**
     * Ekspor data ke berbagai format file: PDF, Word, atau Excel.
     * 
     * @param mixed $data Data yang akan diekspor.
     * @param string $format Format file yang diinginkan ('pdf', 'word', atau 'excel').
     * @param string $view Nama view blade untuk rendering PDF.
     * @param string $fileName Nama file yang akan dihasilkan (tanpa ekstensi).
     * @param array $columns Daftar nama kolom yang akan digunakan untuk Word dan Excel.
     * @param callable $dataMapper Fungsi callback untuk mapping data tiap baris ke array nilai kolom.
     * 
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|mixed
     */
    public function export($data, $format, $view, $fileName, $columns, $dataMapper)
    {
        if ($format === 'pdf') {
            // Buat instance Dompdf untuk generate PDF
            $dompdf = new Dompdf();

            // Render view blade menjadi HTML
            $html = view($view, ['data' => $data])->render();

            // Muat HTML ke Dompdf
            $dompdf->loadHtml($html);

            // Set ukuran dan orientasi kertas
            $dompdf->setPaper('A4', 'landscape');

            // Render PDF
            $dompdf->render();

            // Tampilkan PDF sebagai stream download di browser
            return $dompdf->stream("{$fileName}.pdf");

        } elseif ($format === 'word') {
            // Buat instance PhpWord untuk generate dokumen Word
            $phpWord = new PhpWord();

            // Tambah section baru dalam dokumen
            $section = $phpWord->addSection();

            // Tambah judul dokumen
            $section->addText("Daftar " . ucfirst($fileName), ['bold' => true, 'size' => 16]);
            $section->addTextBreak();

            // Buat tabel dengan border untuk data
            $table = $section->addTable(['borderSize' => 6, 'borderColor' => '999999']);

            // Tambah baris header kolom
            $table->addRow();
            foreach ($columns as $column) {
                $table->addCell(2000)->addText($column);
            }

            // Tambah baris data berdasarkan data dan hasil pemetaan
            foreach ($data as $item) {
                $table->addRow();
                foreach ($dataMapper($item) as $value) {
                    $table->addCell(2000)->addText($value);
                }
            }

            // Buat writer untuk output file Word 2007 (.docx)
            $writer = IOFactory::createWriter($phpWord, 'Word2007');

            // Streaming download file Word
            return response()->streamDownload(function () use ($writer) {
                $writer->save('php://output');
            }, "{$fileName}.docx");

        } else {
            // Default: export dalam format Excel (.xlsx)
            return Excel::download(new class($data) implements \Maatwebsite\Excel\Concerns\FromCollection {
                private $data;
                public function __construct($data) { $this->data = $data; }
                public function collection() { return $this->data; }
            }, "{$fileName}.xlsx");
        }
    }
}
