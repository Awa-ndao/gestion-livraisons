<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    protected $fillable = ['nom', 'prenom', 'telephone', 'zone'];

    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }
}