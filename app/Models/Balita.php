<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    use HasFactory;

    protected $table = 'balitas';
    protected $fillable = [
        'id',
        'nik',
        'nama_lengkap',
        'tanggal_lahir',
        'jenis_kelamin',
        'bbl',
        'pb',
        'ibu_balita_id'
    ];

    public function ibuBalita()
    {
        return $this->hasOne(IbuBalita::class, 'id', 'ibu_balita_id');
    }

    public function imunisasi(){
        return $this->hasOne(Imunisasi::class, 'balita_id', 'id');
    }

    public function pemberian_vitamin(){
        return $this->hasMany(TimbangdanVitamin::class, 'balita_id', 'id');
    }
}
