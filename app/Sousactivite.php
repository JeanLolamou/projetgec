<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sousactivite extends Model
{
    protected $fillable=['id_activite','libelle','indicateur','statut','niveau','date_debut','date_fin','resultat_attendu','commentaire','finan_prev','etat_finan','supprimer'];


      public $timestamps = false;
}
