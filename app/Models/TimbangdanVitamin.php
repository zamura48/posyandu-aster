<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimbangdanVitamin extends Model
{
    use HasFactory;

    protected $table = 'pemberian_vitamins';
    protected $fillable = [
        'vitamin_a',
        'bb',
        'tb',
        'aksi_eksklusif',
        'inisiatif_menyusui_dini',
        'balita_id',
        'date_input'
    ];

    public function balita()
    {
        return $this->hasOne(Balita::class, 'id', 'balita_id');
    }
}
