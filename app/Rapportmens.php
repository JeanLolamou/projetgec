<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rapportmens extends Model
{
    protected $fillable=['date','rapport','id_direction','supprimer','delai','responsable','lien','activite_pao','niveau', 'id_user', 'rapportplan','positif', 'defis', 'solution','type_rapport','mois','semaine'];


      public $timestamps = false;
}
