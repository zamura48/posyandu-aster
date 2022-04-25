<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatIbuHamil extends Model
{
    use HasFactory;

    protected $table = 'riwayat_ibu_hamils';
    protected $fillable = [
        'umur_kehamilan',
        'hasil_pemeriksaan',
        'kader_id',
        'ibu_hamil_id'
    ];

    public function kader()
    {
        return $this->hasOne(Kader::class, 'id', 'kader_id');
    }

    public function ibu_hamil()
    {
        return $this->hasOne(IbuHamil::class, 'id', 'ibu_hamil_id');
    }
}
