<?php

namespace App\Exports;

use App\Models\IbuHamil;
use App\Models\RiwayatIbuHamil;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class IbuHamilExport implements FromCollection, WithColumnWidths, WithHeadings, WithMapping, WithStyles
{
    protected $dari_tanggal;
    protected $sampai_tanggal;
    protected $total_data;
    protected $datas;

    function __construct($dari_tanggal, $sampai_tanggal)
    {
        $this->datas = new RiwayatIbuHamil();
        $this->dari_tanggal = $dari_tanggal;
        $this->sampai_tanggal = $sampai_tanggal;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->sampai_tanggal == 'semua' && $this->dari_tanggal == 'semua') {
            $data = $this->datas->getDataRiwayatIbuHamil()->get();
            $this->total_data = count($data);
        } else {
            $data = $this->datas->getDataRiwayatIbuHamil()
                ->whereBetween('tanggal_pemeriksaan', ["{$this->dari_tanggal}", "{$this->sampai_tanggal}"])->get();
            $this->total_data = count($data);
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            ['REGISTER IBU HAMIL DI POSYANDU ASTER KEL. BANJARMLATI'],
            ['TAHUN ' . date('Y')],
            ['NO.', 'NAMA IBU', 'NAMA SUAMI', 'ALAMAT', 'TANGGAL DAFTAR', 'UMUR KEHAMILAN (SAAT DAFTAR)', 'PEMBERIAN TABLET TAMBAH DARAH', '', '', '', '', '', '', '', '', 'KETERANGAN'],
            ['', '', '', '', '', '', 'UMUR KEHAMILAN', '', '', '', '', '', '', '', '', ''],
            ['', '', '', '', '', '', '1 BLN', '2 BLN', '3 BLN', '4 BLN', '5 BLN', '6 BLN', '7 BLN', '8 BLN', '9 BLN', ''],
        ];
    }

    public function map($row): array
    {
        $no = "";
        return [
            $no,
            $row->ibu_hamil->nama_istri,
            $row->ibu_hamil->nama_suami,
            $row->ibu_hamil->alamat,
            $row->tanggal_pemeriksaan,
            $row->umur_kehamilan,
            str_replace(',', '', $row->bulan_1),
            str_replace(',', '', $row->bulan_2),
            str_replace(',', '', $row->bulan_3),
            str_replace(',', '', $row->bulan_4),
            str_replace(',', '', $row->bulan_5),
            str_replace(',', '', $row->bulan_6),
            str_replace(',', '', $row->bulan_7),
            str_replace(',', '', $row->bulan_8),
            str_replace(',', '', $row->bulan_9),
            $row->keterangan
        ];
    }

    public function columnWidths(): array
    {
        return [
            "A" => 4,
            "B" => 20,
            "C" => 20,
            "D" => 20,
            "E" => 11,
            "F" => 15,
            "G" => 6,
            "H" => 6,
            "I" => 6,
            "J" => 6,
            "K" => 6,
            "L" => 6,
            "M" => 6,
            "N" => 6,
            "O" => 6,
            "P" => 13,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // SETTING BORDER
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ];

        // TERAPKAN BORDER BERDASARKAN COLOMN
        $sheet->getStyle('A3:P3')->applyFromArray($styleArray);
        $sheet->getStyle('A4:P4')->applyFromArray($styleArray);
        $sheet->getStyle('A5:P5')->applyFromArray($styleArray);

        $setSheet = $this->total_data + 1;
        for ($i = 1; $i < $setSheet; $i++) {
            $x = 5;
            $x += $i;
            // TERAPKAN BORDER BERDASRKAN COLUMN
            $sheet->getStyle("A$x:P$x")->applyFromArray($styleArray);

            // TERAPKAN VALUE BERDASRKAN COLUMN
            $sheet->getCell("A$x")->setValue($i);

            // MEMBUAT TULISAN MENJADI TENGAH SECARA HORIZONTAL
            $sheet->getStyle("F$x:P$x")->getAlignment()->setHorizontal("center");

            $sheet->getStyle("A$x:P$x")->getAlignment()->setVertical("top");
            $sheet->getStyle("A$x:P$x")->getAlignment()->setWrapText("true");
        }

        // MENGGABUNGKAN COLUMN VERTIKAL
        $sheet->mergeCells("A1:P1");
        $sheet->mergeCells("A2:P2");
        $sheet->mergeCells("G3:O3");
        $sheet->mergeCells("G4:O4");

        // MENGGABUNGKAN COLUMN SECARA HORIZONTAL
        $sheet->mergeCells("A3:A5");
        $sheet->mergeCells("B3:B5");
        $sheet->mergeCells("C3:C5");
        $sheet->mergeCells("D3:D5");
        $sheet->mergeCells("E3:E5");
        $sheet->mergeCells("F3:F5");
        $sheet->mergeCells("P3:P5");

        // SETTING KOLOM MENJADI WRAP TEXT
        $sheet->getStyle("E3:E5")->getAlignment()->setWrapText(true);
        $sheet->getStyle("F3:F5")->getAlignment()->setWrapText(true);

        // MENJADIKAN TULISAN MENJADI TENGAH SECARA VERTICAL
        $sheet->getStyle("A3:P3")->getAlignment()->setVertical("center");
        $sheet->getStyle("A4:P4")->getAlignment()->setVertical("center");
        $sheet->getStyle("A5:P5")->getAlignment()->setVertical("center");
        $sheet->getStyle("G3:O3")->getAlignment()->setVertical("center");
        $sheet->getStyle("G4:O4")->getAlignment()->setVertical("center");

        // MEMBUAT TULISAN MENJADI TENGAH SECARA HORIZONTAL
        $sheet->getStyle("A1:P1")->getAlignment()->setHorizontal("center");
        $sheet->getStyle("A2:P2")->getAlignment()->setHorizontal("center");
        $sheet->getStyle("B3:D3")->getAlignment()->setHorizontal("center");
        $sheet->getStyle("G3:O3")->getAlignment()->setHorizontal("center");
        $sheet->getStyle("G4:O4")->getAlignment()->setHorizontal("center");
        $sheet->getStyle("G5:O5")->getAlignment()->setHorizontal("center");
        $sheet->getStyle("E3:E5")->getAlignment()->setHorizontal("center");
        $sheet->getStyle("F3:F5")->getAlignment()->setHorizontal("center");

        // MEMBUAT TULISAN MENJADI BOLD ATAU TEBAL
        $sheet->getStyle("A1:P1")->getFont()->setBold(true);
        $sheet->getStyle("A2:P2")->getFont()->setBold(true);
        $sheet->getStyle("A3:P3")->getFont()->setBold(true);
        $sheet->getStyle("A4:P4")->getFont()->setBold(true);
        $sheet->getStyle("A5:P5")->getFont()->setBold(true);
    }
}
