<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reuniondepartement extends Model
{
	 protected $table = 'reuniondepartements';
    protected $primaryKey = 'id';
   
    protected $fillable=['libelle','date','ordre','debut_seance','leve_seance','supprimer','id_direction'];


      public $timestamps = false;
}
