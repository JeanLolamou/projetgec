<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporting extends Model
{
    protected $fillable=['id_activite','date_debut','date_fin','supprimer'];


      public $timestamps = false;
}
