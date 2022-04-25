<?php

namespace App\Exports;

use App\Models\TimbangdanVitamin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PemberianVitaminExport implements FromCollection, WithMapping, WithHeadings
{
    protected $tahun;

    function __construct($tahun)
    {
        $this->tahun = $tahun;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TimbangdanVitamin::whereBetween('created_at', );
    }

    public function map($row): array
    {
        return [];
    }

    public function headings(): array
    {
        return [];
    }
}
