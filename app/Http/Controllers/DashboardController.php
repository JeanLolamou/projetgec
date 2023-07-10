<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courrier;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

      $nbrcourrierArrive = Courrier::where('type_courrier', 'Arrivée')->count();
      $nbrcourrierDepart = Courrier::where('type_courrier', 'Départ')->count();
      $nbrcourrierTraite = Courrier::where('courrier_etat', 'Traité')->count();
      $nbrcourrierAttente = Courrier::where('courrier_etat', 'attente')->count();
      

 if(Auth::user()->user_statut==1)
         {
      return view('userdash', compact('nbrcourrierArrive', 'nbrcourrierDepart', 'nbrcourrierAttente', 'nbrcourrierTraite'));
      }else
      {
         return view ('pages/pagedesactiver');
      }
    	 if(Auth::user()->hasRole('user')){
            return view('userdash');
       }elseif(Auth::user()->hasRole('directeur')){
            return view('directeurdash');
       }elseif(Auth::user()->hasRole('admin')){
        return view('dashboard');
   }
    }
}
