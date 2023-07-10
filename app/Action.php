<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable=['actions','responsable','deadline','observations' , 'id_reunion','supprimer'];


      public $timestamps = false;
}
