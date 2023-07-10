<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'nom_service', 'actif', 'sigle','direction_id'
    ];

  public $timestamps = false;

}
