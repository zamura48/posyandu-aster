<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbuBalita extends Model
{
    use HasFactory;

    protected $table = 'ibu_balitas';
    protected $fillable = [
        'id',
        'nik',
        'nama_ibu',
        'pekerjaan_ibu',
        'alamat',
        'nomor_telepon',
        'nama_ayah',
        'pekerjaan_ayah',
        'rt',
        'rw',
        'user_id'
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function balita()
    {
        return $this->hasMany(Balita::class, 'ibu_balita_id', 'id');
    }
}
