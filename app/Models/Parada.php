<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parada extends Model
{
    protected $fillable = [
        'numero',
        'marxant_id',
        'data_alta',
        'data_last_renovation',
        'actiu',
        'tipus_parada',
        'is_comerc_local',
        'sector',
        'activitat',
        'formacio_alimentacio',
        'metres_lineals',
        'metres_de_fons',
        'estacionament',
        'imatges',
        'fitxers_adjuntats',
        'observacions',
    ];

    protected $casts = [
        'data_alta' => 'date',
        'data_last_renovation' => 'date',
        'imatges' => 'array',
        'fitxers_adjuntats' => 'array',
    ];


     public function marxant() {
        return $this->belongsTo(marxant::class);
    }
}
