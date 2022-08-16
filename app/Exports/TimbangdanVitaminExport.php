<?php

namespace App\Exports;

use App\Models\TimbangandanVitamin;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Excel;

class TimbangdanVitaminExport implements FromCollection, Responsable
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TimbangandanVitamin::all();
    }
}
