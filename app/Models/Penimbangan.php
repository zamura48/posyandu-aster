<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penimbangan extends Model
{
    use HasFactory;

    protected $table = 'penimbangans';
    protected $fillable = [
        'id',
        'tahun',
        'bulan',
        'bb',
        'tb',
        'keterangan',
        'balita_id'
    ];

    public function balita()
    {
        return $this->hasOne(Balita::class, 'id', 'balita_id');
    }
}
