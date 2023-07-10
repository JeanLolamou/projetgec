<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courrier extends Model
{
   protected $fillable = ['objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','email','telephone','date_sortie','date_traitement', 'file_path','lu','courrier_etat','user_id','date_affectation','fichierDecharge','commentaireDecharge','categorieCourrier','synthese','id_priorite','direction_suivie'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
}
