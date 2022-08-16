<?php

namespace App\Exports;

use App\Models\Penimbangan;
use App\Models\PenimbanganDanVitamin;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PenimbanganExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    protected $tahun;
    protected $total_data;

    function __construct(int $tahun)
    {
        $this->tahun = $tahun;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->tahun != 0) {
            $data = PenimbanganDanVitamin::with('balita.ortu_balita')
                ->select(
                    "*",
                    PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '1') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_Januari"),
                    PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '2') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_Februari"),
                    PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '3') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_Maret"),
                    PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '4') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_April"),
                    PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '5') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_Mei"),
                    PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '6') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_Juni"),
                    PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '7') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_Juli"),
                    PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '8') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_Agustus"),
                    PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '9') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_September"),
                    PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '10') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_Oktober"),
                    PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '11') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_November"),
                    PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '12') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_Desember")
                )
                ->whereYear('tanggal_input', $this->tahun)
                ->groupBy('balita_id')
                ->get();

            $this->total_data = count($data);
        } else {
            $data = PenimbanganDanVitamin::with('balita')->get();

            $this->total_data = count($data);
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            ['DATA BAYI BALITA POSYANDU ASTER KEL. BANJARMLATI'],
            ["UPTD PUSKESMAS CAMPURJO KOTA KEDIRI TH. {$this->tahun}"],
            ['No.', 'Nama Balita', 'Nama Ortu', 'Alamat RT / RW', 'Tgl Lahir', 'JK', 'JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGS', 'SEP', 'OKT', 'NOV', 'DES', 'KET'],
            ['', '', 'Tn/Ny', '', '', 'L / P', 'BB/TB', 'BB/TB', 'BB/TB', 'BB/TB', 'BB/TB', 'BB/TB', 'BB/TB', 'BB/TB', 'BB/TB', 'BB/TB', 'BB/TB', 'BB/TB',]
        ];
    }

    public function map($row): array
    {
        $no = 0;
        
        return [
            $no,
            $row->balita->nama_lengkap,
            "{$row->balita->ortu_balita->nama_suami} / {$row->balita->ortu_balita->nama_istri}",
            "{$row->balita->ortu_balita->rt} / {$row->balita->ortu_balita->rw}",
            $row->balita->tanggal_lahir,
            $row->balita->jenis_kelamin == "Laki-Laki" ? "L" : "P",
            str_replace(',', '', $row->bulan_Januari),
            str_replace(',', '', $row->bulan_Februari),
            str_replace(',', '', $row->bulan_Maret),
            str_replace(',', '', $row->bulan_April),
            str_replace(',', '', $row->bulan_Mei),
            str_replace(',', '', $row->bulan_Juni),
            str_replace(',', '', $row->bulan_Juli),
            str_replace(',', '', $row->bulan_Agustus),
            str_replace(',', '', $row->bulan_September),
            str_replace(',', '', $row->bulan_Oktober),
            str_replace(',', '', $row->bulan_November),
            str_replace(',', '', $row->bulan_Desember),
            $row->keterangan != "" ? $row->keterangan : ""
        ];
    }

    public function columnWidths(): array
    {
        return [
            "A" => 4,
            "B" => 30,
            "C" => 30,
            "D" => 8,
            "E" => 11,
            "F" => 5,
            "G" => 8,
            "H" => 8,
            "I" => 8,
            "J" => 8,
            "K" => 8,
            "L" => 8,
            "M" => 8,
            "N" => 8,
            "O" => 8,
            "P" => 8,
            "Q" => 8,
            "R" => 8,
            "S" => 13
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
        $sheet->getStyle('A3:S3')->applyFromArray($styleArray);
        $sheet->getStyle('A4:S4')->applyFromArray($styleArray);

        $setSheet = $this->total_data + 1;
        for ($i = 1; $i < $setSheet; $i++) {
            $x = 4;
            $x += $i;
            // TERAPKAN BORDER BERDASRKAN COLUMN
            $sheet->getStyle("A$x:S$x")->applyFromArray($styleArray);

            // TERAPKAN VALUE BERDASRKAN COLUMN
            $sheet->getCell("A$x")->setValue($i);
        }

        // MENGGABUNGKAN COLUMN
        $sheet->mergeCells('A1:S1');
        $sheet->mergeCells('A2:S2');

        // MENGGABUNGKAN COLUMN SECARA HORIZONTAL
        $sheet->mergeCells('A3:A4');
        $sheet->mergeCells('B3:B4');
        $sheet->mergeCells('D3:D4');
        $sheet->mergeCells('E3:E4');
        $sheet->mergeCells('S3:S4');

        $sheet->getStyle('D3:D4')->getAlignment()->setWrapText(true);

        // MEMBUAT TULISAN TEBAL (BOLD)
        $sheet->getStyle('A1:S1')->getFont()->setBold(true);
        $sheet->getStyle('A2:S2')->getFont()->setBold(true);
        $sheet->getStyle('A3:S3')->getFont()->setBold(true);
        $sheet->getStyle('A4:S4')->getFont()->setBold(true);

        /**
         * MEMBUAT TULISAN MENJADI VERTIKAL TENGAH
         */
        $sheet->getStyle('A1:S1')->getAlignment()->setVertical('center');
        $sheet->getStyle('A2:S2')->getAlignment()->setVertical('center');
        $sheet->getStyle('A3:S3')->getAlignment()->setVertical('center');
        $sheet->getStyle('A4:S4')->getAlignment()->setVertical('center');

        /**
         *  MEMBUAT TULISAN MENJADI HORIZONTAL TENGAH
         */
        $sheet->getStyle('A1:S1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2:S2')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A3:S3')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A4:S4')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:A100')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('D5:D100')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('E5:E100')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('F5:F100')->getAlignment()->setHorizontal('center');
    }
}
