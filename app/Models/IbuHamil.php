<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbuHamil extends Model
{
    use HasFactory;

    protected $table = 'ibu_hamils';
    protected $fillable = [
        'nik',
        'nama_istri',
        'tanggal_lahir',
        'alamat',
        'pekerjaan_istri',
        'nomor_telepon',
        'nama_suami',
        'pekerjaan_suami'
    ];

    public function riwayat_ibu_hamil()
    {
        return $this->hasOne(RiwayatIbuHamil::class, 'ibu_hamil_id', 'id');
    }
}
