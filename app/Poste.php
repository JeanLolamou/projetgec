<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    protected $fillable = [
        'User_poste', 'actif'
    ];

  public $timestamps = false;

}
