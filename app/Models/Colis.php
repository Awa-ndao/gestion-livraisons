<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colis extends Model
{
    protected $fillable = ['description', 'poids', 'statut', 'client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function livraison()
    {
        return $this->hasOne(Livraison::class);
    }
}