<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Couleur extends Model
{
	protected $table = 'couleurs';
    protected $primaryKey = 'id';
    protected $fillable = ['couleur_name'];
    //use HasFactory;
}
