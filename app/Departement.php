<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $fillable = [
        'nom', 'actif', 'sigle','groupe'
    ];

  public $timestamps = false;

}
