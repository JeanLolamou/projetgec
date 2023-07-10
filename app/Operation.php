<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $fillable = [
        'employer', 'date', 'id_manifestation', 'commentaire','etat','suprimer','departement'
    ,'ficher'];

  public $timestamps = false;

}
