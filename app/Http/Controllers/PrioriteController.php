<?php

namespace App\Http\Controllers;
use App\Models\Priorite;
use App\Models\Couleur;

use Illuminate\Support\Facades\Auth;

use DB;
use App\Affectation;
use App\Courrier;
use App\Reponse;

use Illuminate\Http\Request;

class PrioriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { if(isset(Auth::user()->id))
        {
            
        
        $priorites= DB::table('couleurs')
       ->join('priorites','couleurs.id', "=",'priorites.id_couleur')
       ->select('priorites.*', 'couleur_name')
       ->where('priorites.actif', 1)
       ->get();
        
           return view('priorites.index',['priorites'=>$priorites]);

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
            $couleurs = Couleur::where('actif', 1)->get();
         return view('priorites.create',['couleurs'=>$couleurs]);
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
        $priorite= new Priorite();
       $priorite->priorite_name = $request->get('nom');
        $priorite->id_couleur = $request->get('couleur');
      
       $priorite->save();

        return redirect()->route('addpriorite')->with('success', 'priorite Enregistrée avec succès');
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
            
         $editpriorites = Priorite::findOrFail($id);
        return view('priorites.edit',['editpriorites'=>$editpriorites]);
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
          $priorite = Priorite::findOrFail($request->id);
          $priorite->update(['priorite_name' => $request->nom]);

         return redirect()->route('listepriorite')->with('success', 'Information priorite Modifier avec succès');
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
