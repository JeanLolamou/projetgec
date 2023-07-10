<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    protected $fillable = ['courier_id', 'user_id', 'date_reponse', 'document','direction_id','commentaireReponse'
    ];

  public $timestamps = false;

}
