<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expose extends Model
{
    protected $fillable=['exposant','details','id_reunion','supprimer'];


      public $timestamps = false;
}
