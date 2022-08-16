<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKegiatan extends Model
{
    use HasFactory;
    protected $table = 'jadwal_kegiatans';
    protected $fillable = ['user_id', 'nama_kegiatan', 'tanggal', 'pesan'];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function ortu_balita (){
        return $this->hasOne(Ortu::class, 'id', 'penerima');
    }

    public function penerima(){
        return $this->hasMany(PenerimaJadwal::class, 'jadwal_kegiatan_id', 'id');
    }
}
