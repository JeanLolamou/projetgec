<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manifestation extends Model
{
   protected $fillable = [
        'id_user', 'titre', 'besoin_manifestation','statut_manifestation', 'id_departement','supprime_manifestation','date_bedut', 'date_fin','departement_affecte'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
