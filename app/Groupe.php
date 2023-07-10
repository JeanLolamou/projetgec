<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    protected $fillable = [
        'nom_groupe', 'actif', 'sigle','groupe'
    ];

  public $timestamps = false;

}
