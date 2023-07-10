<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommandationdepartement extends Model
{
     protected $fillable=['details','id_reuniondepartement','supprimer'];


      public $timestamps = false;
}
