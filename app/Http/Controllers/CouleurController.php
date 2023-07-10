<?php

namespace App\Http\Controllers;
use App\Models\Couleur;
use Illuminate\Support\Facades\Auth;

use DB;
use App\Affectation;
use App\Courrier;
use App\Reponse;

use Illuminate\Http\Request;

class CouleurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { if(isset(Auth::user()->id))
        {
            
        $couleurs = Couleur::where('actif', 1)->get();
        
           return view('couleurs.index',['couleurs'=>$couleurs]);

    }
    else
        {
          return view('auth.login'); 
        }   

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(isset(Auth::user()->id))
        { 
            
         return view('couleurs.create');
    }
    else
        {
          return view('auth.login'); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { if(isset(Auth::user()->id))
        {
        $couleur = new Couleur();
       $couleur->couleur_name = $request->get('couleur_name');
       $couleur->code_couleur = $request->get('code_couleur');
      
       $couleur->save();

        return redirect()->route('addcouleur')->with('success', 'Couleur Enregistrée avec succès');
         }
    else
        {
          return view('auth.login'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       if(isset(Auth::user()->id))
        {
            
         $editcouleurs = Couleur::findOrFail($id);
        return view('couleurs.edit',['editcouleurs'=>$editcouleurs]);
          }
    else
        {
          return view('auth.login'); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {  
        
        if(isset(Auth::user()->id))
        {
          $couleur = Couleur::findOrFail($request->id);
          $couleur->update(['couleur_name' => $request->couleur_name]);
          $couleur->update(['code_couleur' => $request->code_couleur]);

         return redirect()->route('listecouleur')->with('success', 'Information Poste Modifier avec succès');
           }
    else
        {
          return view('auth.login'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
