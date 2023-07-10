<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function create()
    {
    	return view('postes.create');
    }
}
