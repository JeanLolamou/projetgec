<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priorite extends Model
{
    protected $table = 'priorites';
    protected $primaryKey = 'id';
    protected $fillable = ['priorite_name', 'id_couleur'];
    //use HasFactory;
}
