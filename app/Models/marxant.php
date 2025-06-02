<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class marxant extends Model
{
    protected $fillable = [
        'nom',
        'nif',
        'data_naixement',
        'telefon_fix',
        'telefon_mobil',
        'correu',
        'adreca',
        'codi_postal',
        'regim_ss',
        'asseguranca',
        'observacions',
        'imatges',
        'fitxers_adjuntats',
        'dades_publiques',
    ];

    protected $casts = [
        'data_naixement' => 'date',
        'imatges' => 'array',
        'fitxers_adjuntats' => 'array',
    ];
    
    public function parada() {
        return $this->hasMany(Parada::class);
    }
}
