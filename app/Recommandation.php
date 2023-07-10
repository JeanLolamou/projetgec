<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommandation extends Model
{
     protected $fillable=['details','id_reunion','supprimer'];


      public $timestamps = false;
}
