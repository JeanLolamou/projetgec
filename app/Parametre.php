<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    protected $fillable=['annee','id_user'];


      public $timestamps = false;
}
