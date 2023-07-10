<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visiteur extends Model
{
    protected $fillable = [
        'nomvisiteur', 'telephonevisiteur', 'emailvisiteur','entreprisevisiteur','actif'
    ];

  public $timestamps = false;

}
