<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PraUpdateBalita extends Model
{
    use HasFactory;

    protected $table = 'pra_update_balitas';
    protected $fillable = [
        'nik',
        'nama_lengkap',
        'tanggal_lahir',
        'jenis_kelamin',
        'bbl',
        'pb',
        'proses_lahiran',
        'tempat_lahiran',
        'status',
        'keterangan',
        'user_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
