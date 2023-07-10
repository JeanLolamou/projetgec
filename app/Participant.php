<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable=['nom','id_reunion','supprimer'];


      public $timestamps = false;
}
