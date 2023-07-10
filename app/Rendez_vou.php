<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rendez_vou extends Model
{
    protected $fillable = [
       'id_visiteur','titre','motif','date_rendez_vous','statut','commentaire','date_enregistrement','date_visite','type_rendez_vous','priorite','lieuRendez_vous'
    ];

  public $timestamps = false;

}
