<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
	 protected $table = 'reunions';
    protected $primaryKey = 'id';
   
    protected $fillable=['libelle','date','ordre','debut_seance','leve_seance','supprimer'];


      public $timestamps = false;
}
