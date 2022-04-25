<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbuKB extends Model
{
    use HasFactory;

    protected $table = 'ibu_kb_s';
    protected $fillable = [
        'nik',
        'nama_istri',
        'tanggal_lahir',
        'alamat',
        'pekerjaan_istri',
        'nomor_telepon',
        'nama_suami',
        'pekerjaan_suami',
        'jumlah_anak'
    ];

    public function riwayat_ibu_kb()
    {
        return $this->belognsTo(RiwayatIbuKB::class);
    }
}
