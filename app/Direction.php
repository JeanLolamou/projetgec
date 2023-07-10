<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    protected $fillable=['nom','directeur','description','objectif','supprimer'];


      public $timestamps = false;
}
