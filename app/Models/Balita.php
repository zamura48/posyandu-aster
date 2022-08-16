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
        'proses_lahiran',
        'tempat_lahiran',
        'ortu_id'
    ];

    public function imunisasi(){
        return $this->hasOne(Imunisasi::class, 'balita_id', 'id');
    }

    public function ortu_balita()
    {
        return $this->hasOne(Ortu::class, 'id', 'ortu_id');
    }

    public function penimbangan_dan_vitamin()
    {
        return $this->hasMany(PenimbanganDanVitamin::class, 'balita_id', 'id');
    }

    // public function getUmur(id) {
    //     $balita =
    //     $hitung_umur = Carbon::parse($request->tanggal_lahir)->diff(Carbon::now());

    //     if ($hitung_umur->format('%y Tahun') == "0 Tahun" || $hitung_umur->format('%y Tahun') == "1 Tahun") {
    //         Imunisasi::create([
    //             'balita_id' => $balita->id
    //         ]);
    //     }


    // }
}
