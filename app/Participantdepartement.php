<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participantdepartement extends Model
{
    protected $fillable=['nom','id_reuniondepartement','supprimer'];


      public $timestamps = false;
}
