<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = ['montant', 'mode_paiement', 'statut', 'livraison_id'];

    public function livraison()
    {
        return $this->belongsTo(Livraison::class);
    }
}