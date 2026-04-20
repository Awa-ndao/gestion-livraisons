<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bilan extends Model
{
    protected $fillable = [
        'type',
        'date_debut',
        'date_fin',
        'total_encaisse',
        'nombre_livraisons',
        'nombre_colis_livres',
        'nombre_colis_annules',
        'nouveaux_clients',
        'observations',
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}