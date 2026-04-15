<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cloture extends Model
{
    protected $fillable = [
        'date_cloture',
        'total_encaisse',
        'nombre_livraisons',
        'nombre_colis_livres',
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}