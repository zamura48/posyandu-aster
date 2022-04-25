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
        'ibu_k_b_id'
    ];

    public function ibu_kb()
    {
        return $this->belongsTo(IbuKB::class);
    }
}
