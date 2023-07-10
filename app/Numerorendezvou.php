<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Numerorendezvou extends Model
{
    protected $fillable = ['numeroR', 'dateNR'];

  public $timestamps = false;

}
