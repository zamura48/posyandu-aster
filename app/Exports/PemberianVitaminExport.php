<?php

namespace App\Exports;

use App\Models\TimbangdanVitamin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PemberianVitaminExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    protected $bulan;
    protected $tahun;
    protected $totalData;

    function __construct(int $bulan, int $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->bulan != 0 && $this->tahun != 0) {
            $data = TimbangdanVitamin::with('balita')
                ->whereMonth('created_at', $this->bulan)
                ->whereYear('created_at', $this->tahun)
                ->get();
            $this->totalData = count($data);
        } else {
            $data = TimbangdanVitamin::with('balita')->get();
            $this->totalData = count($data);
        }

        return $data;
    }

    public function map($row): array
    {
        $no = 0;
        return [
            $no,
            $row->balita->nama_lengkap,
            $row->balita->jenis_kelamin == "Laki-Laki" ? "L" : "-",
            $row->balita->jenis_kelamin == "Perempuan" ? "P" : "-",
            $row->balita->tanggal_lahir,
            "'{$row->balita->nik}",
            $row->balita->ibuBalita->nama_ibu . " / " . $row->balita->ibuBalita->nama_ayah,
            "{$row->balita->ibuBalita->rt} / {$row->balita->ibuBalita->rw}",
            $row->vitamin_a == "Merah" ? $row->vitamin_a : "-",
            $row->vitamin_a == "Biru" ? $row->vitamin_a : "-",
            $row->bb,
            $row->tb,
            $row->aksi_eksklusif != 'Ya' ? "-" : $row->aksi_eksklusif,
            $row->aksi_eksklusif != 'Tidak' ? "-" : $row->aksi_eksklusif,
            $row->inisiatif_menyusui_dini != 'Ya' ? "-" : $row->inisiatif_menyusui_dini,
            $row->inisiatif_menyusui_dini != 'Tidak' ? "-" : $row->inisiatif_menyusui_dini
        ];
    }

    public function headings(): array
    {
        $judul = $this->bulan == '1' ? 'Pemberian Vitamin Januari' : 'Pemberian Vitamin Agustus';
        return [
            [$judul],
            ['No.', 'Nama', 'L', 'P', 'Tanggal Lahir', 'Nik Balita', 'Nama Ortu', 'Alamat (RT/RW)', 'Vitamin', '', 'BB', 'TB', 'Aksi Eksklusif', '', 'IMD', ''],
            ['', '', '', '', '', '', '', '', 'Merah', 'Biru', '', '', 'Ya', 'Tidak', 'Ya', 'Tidak'],
        ];
    }

    public function columnWidths(): array
    {
        return [
            "A" => 4,
            "B" => 25,
            //
            "C" => 7,
            "D" => 7,
            "E" => 15,
            "F" => 18,
            "G" => 25,
            // alamat
            "H" => 12,
            // vitamin
            "I" => 10,
            "J" => 10,
            // bb & tb
            "K" => 6,
            "L" => 6,
            // aksi eksklusif
            "M" => 5,
            "N" => 5,
            // IMD
            "O" => 5,
            "P" => 5
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ];

        $sheet->getStyle('A2:P2')->applyFromArray($styleArray);
        $sheet->getStyle('A3:P3')->applyFromArray($styleArray);

        $setSheet = $this->totalData + 1;
        for ($i=1; $i < $setSheet ; $i++) {
            $x = 3;
            $x += $i;
            $sheet->getCell('A'.$x)->setValue($i);
            $sheet->getStyle('A'.$x.':P'.$x)->applyFromArray($styleArray);
            $sheet->getStyle('F'.$x)->getAlignment()->setWrapText(true);
        }

        // merge cell
        $sheet->mergeCells('A1:P1');
        // MERGE VERTICAL
        $sheet->mergeCells('A2:A3');
        $sheet->mergeCells('B2:B3');
        $sheet->mergeCells('C2:C3');
        $sheet->mergeCells('D2:D3');
        $sheet->mergeCells('E2:E3');
        $sheet->mergeCells('F2:F3');
        $sheet->mergeCells('G2:G3');
        $sheet->mergeCells('H2:H3');
        $sheet->mergeCells('K2:K3');
        $sheet->mergeCells('L2:L3');
        // MERGE HORIZONTAL
        $sheet->mergeCells('I2:J2');
        $sheet->mergeCells('M2:N2');
        $sheet->mergeCells('O2:P2');

        // SET KOLOM MENJADI WRAPTEXT
        $sheet->getStyle('F2:F3')->getAlignment()->setWrapText(true);
        $sheet->getStyle('H2:H3')->getAlignment()->setWrapText(true);

        // set font bold
        $sheet->getStyle('A1:P1')->getFont()->setBold(true);
        $sheet->getStyle('A2:P2')->getFont()->setBold(true);
        $sheet->getStyle('A3:P3')->getFont()->setBold(true);

        // set center vertical merge
        $sheet->getStyle('A2:A3')->getAlignment()->setVertical('center');
        $sheet->getStyle('B2:B3')->getAlignment()->setVertical('center');
        $sheet->getStyle('C2:C3')->getAlignment()->setVertical('center');
        $sheet->getStyle('D2:D3')->getAlignment()->setVertical('center');
        $sheet->getStyle('E2:E3')->getAlignment()->setVertical('center');
        $sheet->getStyle('F2:F3')->getAlignment()->setVertical('center');
        $sheet->getStyle('G2:G3')->getAlignment()->setVertical('center');
        $sheet->getStyle('H2:H3')->getAlignment()->setVertical('center');
        $sheet->getStyle('K2:K3')->getAlignment()->setVertical('center');
        $sheet->getStyle('L2:L3')->getAlignment()->setVertical('center');

        // set center horizontal merge
        $sheet->getStyle('A2:P2')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A3:P3')->getAlignment()->setHorizontal('center');
        // L & P
        $sheet->getStyle('C4:C100')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('D4:D100')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('I4:I100')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('J4:J100')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('K4:K100')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('L4:L100')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('M4:M100')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('N4:N100')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('O4:O100')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('P4:P100')->getAlignment()->setHorizontal('center');
    }
}
