<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use Illuminate\Http\Request;
use App\Manifestation;
use Illuminate\Support\Facades\Auth;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function traiter()
    { if(isset(Auth::user()->id))
        {
       $manifestations= DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('operations.etat','fait')
                    ->get();                       
       if(count($manifestations)>0)
        {
            return view('direction.liste_suividirection')->with('manifestations', $manifestations);
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
    { if(isset(Auth::user()->id))
        {
        $manifestations= DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('operations.etat','encour')
                    ->get();                       
       if(count($manifestations)>0)
        {
            return view('direction.liste_suividirection')->with('manifestations', $manifestations);
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
         ->select('name', 'titre', 'manifestations.id','nom_departement') 
         ->where('statut_manifestation','=','rejeter')
         
         ->get();                        
       if(count($manifestations)>0)
        {
            return view('direction.liste_suivi')->with('manifestations', $manifestations);
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
         ->select('name', 'titre', 'manifestations.id','nom_departement') 
         ->where('statut_manifestation','=','valider')
         
         ->get();                        
       if(count($manifestations)>0)
        {
            return view('direction.liste_traiter')->with('manifestations', $manifestations);
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
        $manifestations= DB::table('manifestations')
         ->join('users', 'users.id', '=', 'id_user')
         ->select('name', 'titre', 'manifestations.id','nom_departement') 
         ->where('statut_manifestation','=','envoyer')
         
         ->get();                        
       if(count($manifestations)>0)
        {
            return view('direction.liste_suivi')->with('manifestations', $manifestations);
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
