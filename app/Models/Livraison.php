<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    protected $fillable = ['date_livraison', 'statut', 'colis_id', 'livreur_id'];

    public function colis()
    {
        return $this->belongsTo(Colis::class);
    }

    public function livreur()
    {
        return $this->belongsTo(Livreur::class);
    }
}