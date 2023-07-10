<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sousdepartement extends Model
{
    protected $table = 'sousdepartements';
    protected $primaryKey = 'id';
    protected $fillable = ['sousdepartement_name', 'id_departement', 'sigle'];
}
