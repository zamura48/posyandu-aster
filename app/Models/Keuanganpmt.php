<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuanganpmt extends Model
{
    use HasFactory;

    protected $table = 'keuanganpmts';
    protected $fillable = [
        'uang_masuk',
        'tanggal_masuk',
        'uang_keluar',
        'tanggal_keluar',
        'keterangan'
    ];
}
