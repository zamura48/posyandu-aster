<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PraRegister extends Model
{
    use HasFactory;

    protected $table = 'pra_registers';
    protected $fillable = [
        'role',
        'username',
        'name',
        'password',
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
    ];
}
