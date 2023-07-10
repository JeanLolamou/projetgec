<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
	protected $table = 'postes';
    protected $primaryKey = 'id';
    protected $fillable = ['poste_name'];
    //use HasFactory;
}
