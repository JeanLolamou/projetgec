<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Imports\ActiviteImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{
   function import(Request $request)
    {
     

     $path = $request->file('fichier')->getRealPath();
      Excel::import(new ActiviteImport,request()->file('fichier'));
           
        return back();
     
   }


}
