<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisVaksiImunisasi extends Model
{
    use HasFactory;

    protected $table = 'jenis_vaksin_imunisasis';
    protected $fillable = ['jenis_vaksin'];
}
