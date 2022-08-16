<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenimbanganDanVitamin extends Model
{
    use HasFactory;

    protected $table = 'penimbangan_dan_vitamin';
    protected $fillable = [
        'vitamin_a',
        'bb',
        'tb',
        'aksi_eksklusif',
        'inisiatif_menyusui_dini',
        'keterangan',
        'tanggal_input',
        'balita_id'
    ];

    public function getDataPenimbangan()
    {
        $rtrw = auth()->user()->getRtRw();
        $datas = PenimbanganDanVitamin::with('balita')
            ->join('balitas', 'balitas.id', 'penimbangan_dan_vitamin.balita_id')
            ->join('ortus', 'ortus.id', 'balitas.ortu_id')
            ->select(
                "*",
                PenimbanganDanVitamin::raw('YEAR(tanggal_input) year'),
                PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '1') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_jan"),
                PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '2') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_feb"),
                PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '3') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_mar"),
                PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '4') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_apr"),
                PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '5') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_mei"),
                PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '6') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_jun"),
                PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '7') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_jul"),
                PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '8') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_ags"),
                PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '9') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_sep"),
                PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '10') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_okt"),
                PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '11') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_nov"),
                PenimbanganDanVitamin::raw("GROUP_CONCAT(CASE WHEN (EXTRACT(MONTH from tanggal_input) = '12') THEN CONCAT(bb, '/', tb) ELSE '' END) as bulan_des")
            )
            ->where('ortus.rt', $rtrw['rt'])
            ->where('ortus.rw', $rtrw['rw'])
            ->groupBy('balita_id', 'year');

        return $datas;
    }

    public function balita()
    {
        return $this->hasOne(Balita::class, 'id', 'balita_id');
    }
}
