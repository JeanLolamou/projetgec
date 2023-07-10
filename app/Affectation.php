<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    protected $fillable = ['courrier_id', 'date_affectation','commentaire', 'user_affecter', 'lu','direction_affectation','commentaire','commentaireRelance','user_dg','user_dga','user_manager','commentaire_dga','commentaire_manager','date_affectationManager','date_affectationdga','statut_courrier','visibleSG','visisbleChefCabinet','service_affecte','visibleManager','date_affecter_service','affecter_groupe','commentaireSg','commentchefCabinet','user_sg','userchfc','date_affectationsg','date_affectationchfc','partage_courrier','encopie'
    ];

  public $timestamps = false;

}
