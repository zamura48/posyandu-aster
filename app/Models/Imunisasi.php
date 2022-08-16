<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imunisasi extends Model
{
    use HasFactory;

    protected $table = 'imunisasi';
    protected $fillable = ['jenis_vaksin', 'tanggal', 'balita_id'];

    public function getDataImunisasi()
    {
        $rtrw = auth()->user()->getRtRw();
        $data = Imunisasi::with('balita.ortu_balita')
            ->join('balitas', 'balitas.id', 'imunisasi.balita_id')
            ->join('ortus', 'ortus.id', 'balitas.ortu_id')
            ->select(
                'imunisasi.id',
                'imunisasi.balita_id',
                Imunisasi::raw("GROUP_CONCAT(IF(jenis_vaksin = 'hb0', tanggal, '')) as hb0"),
                Imunisasi::raw("GROUP_CONCAT(IF(jenis_vaksin = 'bcg', tanggal, '')) as bcg"),
                Imunisasi::raw("GROUP_CONCAT(IF(jenis_vaksin = 'p1', tanggal, '')) as p1"),
                Imunisasi::raw("GROUP_CONCAT(IF(jenis_vaksin = 'dpt1', tanggal, '')) as dpt1"),
                Imunisasi::raw("GROUP_CONCAT(IF(jenis_vaksin = 'p2', tanggal, '')) as p2"),
                Imunisasi::raw("GROUP_CONCAT(IF(jenis_vaksin = 'pcv1', tanggal, '')) as pcv1"),
                Imunisasi::raw("GROUP_CONCAT(IF(jenis_vaksin = 'dpt2', tanggal, '')) as dpt2"),
                Imunisasi::raw("GROUP_CONCAT(IF(jenis_vaksin = 'p3', tanggal, '')) as p3"),
                Imunisasi::raw("GROUP_CONCAT(IF(jenis_vaksin = 'pcv2', tanggal, '')) as pcv2"),
                Imunisasi::raw("GROUP_CONCAT(IF(jenis_vaksin = 'dpt3', tanggal, '')) as dpt3"),
                Imunisasi::raw("GROUP_CONCAT(IF(jenis_vaksin = 'p4', tanggal, '')) as p4"),
                Imunisasi::raw("GROUP_CONCAT(IF(jenis_vaksin = 'pcv3', tanggal, '')) as pcv3"),
                Imunisasi::raw("GROUP_CONCAT(IF(jenis_vaksin = 'ipv', tanggal, '')) as ipv"),
                Imunisasi::raw("GROUP_CONCAT(IF(jenis_vaksin = 'campak', tanggal, '')) as campak"),
            )
            ->where('ortus.rt', $rtrw['rt'])
            ->where('ortus.rw', $rtrw['rw'])
            ->groupBy('balita_id');
        return $data;
    }
    public function balita()
    {
        return $this->hasOne(Balita::class, 'id', 'balita_id');
    }
}
