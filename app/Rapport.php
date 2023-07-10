<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    protected $fillable=['date','rapport','id_direction','supprimer','delai','responsable','lien','activite_pao','niveau', 'id_user', 'rapportplan', 'defis', 'demarche', 'decision','type_rapport', 'mois','semaine'];


      public $timestamps = false;
}
