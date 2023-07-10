<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use App\Operation;
use Illuminate\Http\Request;
use App\Manifestation;
use Illuminate\Support\Facades\Auth;

class DemandeurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    
    public function apercuoperationfin()
    
    {
        if(isset(Auth::user()->id))
        {
        $demandeurmanifestations=DB::table('manifestations')
         ->join('operations', 'manifestations.id', '=', 'id_manifestation')
         ->join('users', 'users.id', '=', 'manifestations.id_user')
         ->select('nom_departement','commentaire', 'poste', 'email', 'operations.id','date_bedut', 'titre', 'besoin_manifestation','name')
         ->where('employer', Auth::user()->email) 
         ->where('etat','encour')->get();
        
        if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.demandeur_operationfin')->with('demandeurmanifestations', $demandeurmanifestations);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }

    }
    else
        {
          return view('auth.login'); 
        }   

    }
    public function rejeter()
    {
       if(isset(Auth::user()->id))
        { $demandeurmanifestations= Manifestation::where('id_user', Auth::user()->id)
                                ->where('statut_manifestation','rejeter')->get();                        
        
        if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.liste_traiter')->with('demandeurmanifestations', $demandeurmanifestations);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }

    }
    else
        {
          return view('auth.login'); 
        }   

    }
    public function direction()
    {
       if(isset(Auth::user()->id))
        { $demandeurmanifestations= Manifestation::where('id_user', Auth::user()->id)
                                ->where('statut_manifestation','valider')->get();                        
        
        if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.liste_traiter')->with('demandeurmanifestations', $demandeurmanifestations);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
        }
    else
        {
          return view('auth.login'); 
        }
    }
    public function envoyer()
    { if(isset(Auth::user()->id))
        { 
        $demandeurmanifestations= Manifestation::where('id_user', Auth::user()->id)
                                ->where('statut_manifestation','envoyer')->get();                        
        
        if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.liste_traiter')->with('demandeurmanifestations', $demandeurmanifestations);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
           }
    else
        {
          return view('auth.login'); 
        }
    }
    public function tache()
    {if(isset(Auth::user()->id))
        {
        $demandeurmanifestations= Manifestation::where('employer_affecter',Auth::user()->email)->get();                        
        
        if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.liste_tache')->with('demandeurmanifestations', $demandeurmanifestations);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
             }
    else
        {
          return view('auth.login'); 
        }
    }
     
     
}
