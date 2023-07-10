<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use App\Operation;
use App\Manifestation;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;


class ChefDepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function traiter()
    {
        if(isset(Auth::user()->id))
        {
        $manifestations= DB::table('manifestations')
        ->join('users', 'users.id', '=', 'manifestations.id_user')
        ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
        ->select('*')
        ->where('departement_envoi', Auth::user()->nom_departement)
        ->where('operations.etat','fait')
        ->get();   

       if(count($manifestations)>0)
        {
            return view('departements.liste_suivimanifestation')->with('manifestations', $manifestations);
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
    public function encour()
    {
        if(isset(Auth::user()->id))
        {
        $manifestations= DB::table('manifestations')
        ->join('users', 'users.id', '=', 'manifestations.id_user')
        ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
        ->select('*')
        ->where('departement_envoi', Auth::user()->nom_departement)
        ->where('operations.etat','encour')
        ->get(); 
       if(count($manifestations)>0)
        {
            return view('departements.liste_suivimanifestation')->with('manifestations', $manifestations);
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
    { if(isset(Auth::user()->id))
        {
        $manifestations= DB::table('manifestations')
         ->join('users', 'users.id', '=', 'id_user')
         ->select('name', 'titre', 'manifestations.id') 
         ->where('statut_manifestation','=','rejeter')
         ->where('departement_envoi', Auth::user()->nom_departement)
         ->get();                        
       if(count($manifestations)>0)
        {
            return view('departements.liste_traiter')->with('manifestations', $manifestations);
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
    { if(isset(Auth::user()->id))
        {
        $manifestations= DB::table('manifestations')
         ->join('users', 'users.id', '=', 'id_user')
         ->select('name', 'titre', 'manifestations.id') 
         ->where('statut_manifestation','=','valider')
         ->where('departement_envoi', Auth::user()->nom_departement)
         ->get();                        
       if(count($manifestations)>0)
        {
            return view('departements.liste_suivi')->with('manifestations', $manifestations);
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
     public function aprecu_suividepatermant($id)
    { if(isset(Auth::user()->id))
        {
        $editvalidations =  DB::table('manifestations')
         ->join('users', 'users.id', '=', 'id_user')
         ->select('nom_departement','name', 'poste', 'email', 'manifestations.id','date_bedut', 'titre', 'besoin_manifestation') 
         ->where('manifestations.id',$id)->get();
        return view('departements.aprecu_suivi')->with('editvalidations', $editvalidations);
         }
              else
{
    return view('auth.login'); 
}
    }
    public function envoyer()
    { if(isset(Auth::user()->id))
        {
        $manifestations= DB::table('manifestations')
         ->join('users', 'users.id', '=', 'id_user')
         ->select('name', 'titre', 'manifestations.id') 
         ->where('statut_manifestation','=','envoyer')
         ->where('departement_envoi', Auth::user()->nom_departement)
         ->get();                        
       if(count($manifestations)>0)
        {
            return view('departements.liste_traiter')->with('manifestations', $manifestations);
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
    {
        if(isset(Auth::user()->id))
        {
            $departementmanifestations= Manifestation::where('departement_affecte',Auth::user()->nom_departement )
        ->where('etat_operation', NULL)->get();                        
        
        if(count($departementmanifestations)>0)
        {
            return view('departements.liste_tache')->with('departementmanifestations', $departementmanifestations);
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
