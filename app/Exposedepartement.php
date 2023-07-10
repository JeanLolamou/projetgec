<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exposedepartement extends Model
{
    protected $fillable=['exposant','details','id_reuniondepartement','supprimer'];


      public $timestamps = false;
}
