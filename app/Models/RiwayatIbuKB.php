<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatIbuKB extends Model
{
    use HasFactory;

    protected $table = 'riwayat_ibu_kbs';
    protected $fillable = [
        'riwayat_kb',
        'suntik_awal',
        'suntik_akhir',
        'hasil_pemeriksaan',
        'kader_id',
        'ortu_id'
    ];

    public function kader()
    {
        return $this->hasOne(Kader::class, 'id', 'kader_id');
    }

    public function ibu_kb()
    {
        return $this->hasOne(Ortu::class, 'id', 'ortu_id');
    }
}
