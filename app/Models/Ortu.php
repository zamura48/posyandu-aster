<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ortu extends Model
{
    use HasFactory;
    protected $table = 'ortus';
    protected $fillable = [
        'nik',
        'nama_istri',
        'tanggal_lahir',
        'nomor_telepon',
        'pekerjaan_istri',
        'nama_suami',
        'pekerjaan_suami',
        'rt',
        'rw',
        'alamat',
        'jumlah_anak',
        'status',
        'user_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function balita()
    {
        return $this->hasMany(Balita::class, 'ortu_id', 'id');
    }

    public function riwayat_ibu_hamil()
    {
        return $this->hasMany(RiwayatIbuHamil::class, 'ortu_id', 'id');
    }

    public function riwayat_ibu_kb()
    {
        return $this->hasMany(RiwayatIbuKB::class, 'ortu_id', 'id');
    }

    public function kader()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
