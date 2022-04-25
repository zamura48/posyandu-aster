<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kader extends Model
{
    use HasFactory;

    protected $table = 'kaders';
    protected $fillable = [
        'id',
        'nik',
        'nama_lengkap',
        'tanggal_lahir',
        'alamat',
        'nomor_telepon',
        'user_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
