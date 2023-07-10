<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annotationtype extends Model
{
    protected $fillable = ['commentairAnnotation','actifAnnotation', 'user_poste'];

  public $timestamps = false;

}
