<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaJadwal extends Model
{
    use HasFactory;
    protected $table = 'penerima_jadwals';
    protected $fillable = ['ortu_id', 'jadwal_kegiatan_id', 'status'];

    public function jadwal_kegiatan()
    {
        return $this->hasOne(JadwalKegiatan::class, 'id', 'jadwal_kegiatan_id');
    }
}
