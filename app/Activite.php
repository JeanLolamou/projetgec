<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    protected $fillable=['libelle','indicateur','statut','niveau', 'date_prevue', 'date_revue','date_debut','date_fin','resultat_attendu','commentaire','finan_prev','etat_finan','supprimer','id_direction','sousactivite','reporter','budget'];


      public $timestamps = false;
}
