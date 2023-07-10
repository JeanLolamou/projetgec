<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sousmenu extends Model
{
    protected $table = 'sousmenus';
    protected $primaryKey = 'id';
    protected $fillable = ['sousmenu_name', 'id_menu'];
}
