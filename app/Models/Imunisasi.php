<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imunisasi extends Model
{
    use HasFactory;

    protected $table = 'imunisasis';
    protected $fillable = ['hb0', 'bcg', 'p1', 'dpt1', 'p2', 'pcv1', 'dpt2', 'p3', 'pcv2', 'dpt3', 'p4', 'pcv3', 'ipv', 'campak', 'balita_id'];

    public function balita()
    {
        return $this->belongsTo(Balita::class);
    }
}
