<?php

namespace App\Exports;

use App\Models\Imunisasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ImunisasiExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    protected $tahun;
    protected $total_data;
    protected $imunisasi;

    public function __construct(?int $tahun)
    {
        $this->tahun = $tahun;
        $this->imunisasi = new Imunisasi();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->tahun != 0) {
            $datas = $this->imunisasi->getDataImunisasi()->whereYear('tanggal', $this->tahun)->groupBy('balita_id')->get();

            $this->total_data = count($datas);
        } else {
            $datas = $this->imunisasi->getDataImunisasi()->groupBy('balita_id')->get();
            $this->total_data = count($datas);
        }

        return $datas;
    }

    public function headings(): array
    {
        return [
            ["DATA BAYI BARU LAHIR, TIMBANGAN, IMUNISASI TAHUN {$this->tahun}"],
            ["POSYANDU  : ASTER"],
            ["BULAN     : "],
            ["NO.", "NAMA BAYI", "TGL LAHIR", "ORTU", "JK", "BBL/PB", "SC/NORMAL TEMPAT", "TGL IMUNISASI", "", "", "", "", "", "", "", "", "", "", "", "", ""],
            ["", "", "", "", "", "", "", "HB0", "BCG", "P1", "DPT1", "P2", "PCV1", "DPT2", "P3", "PCV2", "DPT3", "P4", "PCV3", "IPV", "CAMPAK"],
        ];
    }

    public function map($row): array
    {
        $no = 0;
        $bbl_pb = "";
        $proses_tempat = "";

        if ($row->balita->bbl != "" && $row->balita->pb != "") {
            $bbl_pb = "{$row->balita->pb} / {$row->balita->pb}";
        } else {
            if ($row->balita->bbl != "") {
                $bbl_pb = $row->balita->bbl;
            } elseif ($row->balita->pb != "") {
                $bbl_pb = $row->balita->pb;
            }
        }

        if ($row->balita->proses_lahiran != "" && $row->balita->tempat_lahiran != "") {
            $proses_tempat = "{$row->balita->tempat_lahiran} / {$row->balita->tempat_lahiran}";
        } else {
            if ($row->balita->proses_lahiran != "") {
                $proses_tempat = $row->balita->proses_lahiran;
            } elseif ($row->balita->tempat_lahiran != "") {
                $proses_tempat = $row->balita->tempat_lahiran;
            }
        }

        return [
            $no,
            $row->balita->nama_lengkap,
            $row->balita->tanggal_lahir,
            "{$row->balita->ortu_balita->nama_suami} / {$row->balita->ortu_balita->nama_istri}",
            $row->balita->jenis_kelamin == "Laki-Laki" ? "L" : "P",
            $bbl_pb,
            $proses_tempat,
            str_replace(',', '', $row->hb0),
            str_replace(',', '', $row->bcg),
            str_replace(',', '', $row->p1),
            str_replace(',', '', $row->dpt1),
            str_replace(',', '', $row->p2),
            str_replace(',', '', $row->pcv1),
            str_replace(',', '', $row->dpt2),
            str_replace(',', '', $row->p3),
            str_replace(',', '', $row->pcv2),
            str_replace(',', '', $row->dpt3),
            str_replace(',', '', $row->p4),
            str_replace(',', '', $row->ipv),
            str_replace(',', '', $row->campak),
        ];
    }

    public function columnWidths(): array
    {
        return [
            "A" => 4,
            "B" => 30,
            "C" => 12,
            "D" => 30,
            "E" => 4,
            "F" => 9,
            "G" => 12,
            "H" => 12,
            "I" => 12,
            "J" => 12,
            "K" => 12,
            "L" => 12,
            "M" => 12,
            "N" => 12,
            "O" => 12,
            "P" => 12,
            "Q" => 12,
            "R" => 12,
            "S" => 12,
            "T" => 12,
            "U" => 12
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
        $sheet->getStyle('A4:U4')->applyFromArray($styleArray);
        $sheet->getStyle('A5:U5')->applyFromArray($styleArray);

        $setSheet = $this->total_data + 1;
        for ($i = 1; $i < $setSheet; $i++) {
            $x = 5;
            $x += $i;

            // TERAPKAN BORDER BERDASRKAN COLUMN
            $sheet->getStyle('A' . $x . ':U' . $x)->applyFromArray($styleArray);

            // TERAPKAN VALUE BERDASRKAN COLUMN
            $sheet->getCell('A' . $x)->setValue($i);

            // SETTING KOLOM MENJADI WRAP TEXT
            $sheet->getStyle("B" . $x . ":B" . $x)->getAlignment()->setWrapText(true);
            $sheet->getStyle("D" . $x . ":D" . $x)->getAlignment()->setWrapText(true);
            $sheet->getStyle("G" . $x . ":G" . $x)->getAlignment()->setWrapText(true);

            $sheet->getStyle("A" . $x . ":A" . $x)->getAlignment()->setHorizontal('center');
            $sheet->getStyle("E" . $x . ":E" . $x)->getAlignment()->setHorizontal('center');
        }

        // MENGGABUNGKAN COLUMN
        $sheet->mergeCells('A1:U1');
        $sheet->mergeCells('A2:U2');
        $sheet->mergeCells('A3:U3');
        $sheet->mergeCells('H4:U4');

        // MENGGABUNGKAN COLUMN SECARA HORIZONTAL
        $sheet->mergeCells('A4:A5');
        $sheet->mergeCells('B4:B5');
        $sheet->mergeCells('C4:C5');
        $sheet->mergeCells('D4:D5');
        $sheet->mergeCells('E4:E5');
        $sheet->mergeCells('F4:F5');
        $sheet->mergeCells('G4:G5');

        // SETTING KOLOM MENJADI WRAP TEXT
        $sheet->getStyle("G4:G5")->getAlignment()->setWrapText(true);
        $sheet->getStyle("F4:F5")->getAlignment()->setWrapText(true);

        // MEMBUAT TULISAN TEBAL (BOLD)
        $sheet->getStyle('A1:U1')->getFont()->setBold(true);
        $sheet->getStyle('A4:U4')->getFont()->setBold(true);
        $sheet->getStyle('A5:U5')->getFont()->setBold(true);

        /**
         * MEMBUAT TULISAN MENJADI VERTIKAL TENGAH
         */
        $sheet->getStyle('A1:U1')->getAlignment()->setVertical('center');
        $sheet->getStyle('A4:U4')->getAlignment()->setVertical('center');
        $sheet->getStyle('A5:U5')->getAlignment()->setVertical('center');

        /**
         *  MEMBUAT TULISAN MENJADI HORIZONTAL TENGAH
         */
        $sheet->getStyle('A1:U1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A4:U4')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A5:U5')->getAlignment()->setHorizontal('center');
    }
}
