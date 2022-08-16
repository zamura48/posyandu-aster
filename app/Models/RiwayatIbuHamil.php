<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatIbuHamil extends Model
{
    use HasFactory;

    protected $table = 'riwayat_ibu_hamils';
    protected $fillable = [
        'umur_kehamilan',
        'hasil_pemeriksaan',
        'pemberian_tablet_tambah_darah',
        'tanggal_pemeriksaan',
        'kader_id',
        'ortu_id'
    ];

    public function kader()
    {
        return $this->hasOne(Kader::class, 'id', 'kader_id');
    }

    public function ibu_hamil()
    {
        return $this->hasOne(Ortu::class, 'id', 'ortu_id');
    }

    public function getDataRiwayatIbuHamil()
    {
        $datas = RiwayatIbuHamil::with('ibu_hamil')
            ->select(
                "*",
                RiwayatIbuHamil::raw("GROUP_CONCAT(IF(umur_kehamilan = 1, pemberian_tablet_tambah_darah, '')) as bulan_1"),
                RiwayatIbuHamil::raw("GROUP_CONCAT(IF(umur_kehamilan = 2, pemberian_tablet_tambah_darah, '')) as bulan_2"),
                RiwayatIbuHamil::raw("GROUP_CONCAT(IF(umur_kehamilan = 3, pemberian_tablet_tambah_darah, '')) as bulan_3"),
                RiwayatIbuHamil::raw("GROUP_CONCAT(IF(umur_kehamilan = 4, pemberian_tablet_tambah_darah, '')) as bulan_4"),
                RiwayatIbuHamil::raw("GROUP_CONCAT(IF(umur_kehamilan = 5, pemberian_tablet_tambah_darah, '')) as bulan_5"),
                RiwayatIbuHamil::raw("GROUP_CONCAT(IF(umur_kehamilan = 6, pemberian_tablet_tambah_darah, '')) as bulan_6"),
                RiwayatIbuHamil::raw("GROUP_CONCAT(IF(umur_kehamilan = 7, pemberian_tablet_tambah_darah, '')) as bulan_7"),
                RiwayatIbuHamil::raw("GROUP_CONCAT(IF(umur_kehamilan = 8, pemberian_tablet_tambah_darah, '')) as bulan_8"),
                RiwayatIbuHamil::raw("GROUP_CONCAT(IF(umur_kehamilan = 9, pemberian_tablet_tambah_darah, '')) as bulan_9"),
            )->groupBy('ortu_id');
        return $datas;
    }
}
