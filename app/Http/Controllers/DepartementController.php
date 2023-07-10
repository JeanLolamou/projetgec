<?php

namespace App\Http\Controllers;
use App\Departement;
use Illuminate\Support\Facades\Auth;

use DB;
use App\Affectation;
use App\Courrier;
use App\Reponse;

use Illuminate\Http\Request;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { if(isset(Auth::user()->id))
        {
         
        $departements = Departement::where('actif', 1)->get();
        
           return view('departements.index',['departements'=>$departements]);

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
           
         return view('departements.create');
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
        $departement= new Departement();
       $departement->nom = $request->get('nom');
       $departement->sigle = $request->get('sigle');
       $departement->save();

        return redirect()->route('adddepartement')->with('success', 'Departement Enregistré avec succès');
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
           
         $editdepartements = Departement::findOrFail($id);
        return view('departements.edit',['editdepartements'=>$editdepartements]);
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
    {  if(isset(Auth::user()->id))
        {
          $departement = Departement::find($request->id);
           $input = $request->all();
            $departement->update($input);

          // $departement->update(['nom' => $request->nom, 'sigle' => $request->sigle]);

         return redirect()->route('listedepartement')->with('success', 'Information Direction Modifier avec succès');
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
        $departement = Departement::find($id);
        $departement->delete();
        
        return redirect('listedepartement')->with('success', 'Menu Supprimé avec succès');
    }
}
