<?php

namespace App\Http\Controllers;
use App\Poste;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

use DB;
use App\Affectation;
use App\Courrier;
use App\Reponse;

use Illuminate\Http\Request;

class PosteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { if(isset(Auth::user()->id))
        {
            
        $postes = Poste::where('actif', 1)->get();
        
           return view('postes.index',['postes'=>$postes]);

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
            
         return view('postes.create');
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
        $poste= new Poste();
       $poste->User_poste = $request->get('nom');
      
       $poste->save();

        return redirect()->route('addposte')->with('success', 'Poste Enregistrée avec succès');
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
            
         $editpostes = Poste::findOrFail($id);
        return view('postes.edit',['editpostes'=>$editpostes]);
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
          $poste = Poste::findOrFail($request->id);
          $poste->update(['User_poste' => $request->nom]);

         return redirect()->route('listeposte')->with('success', 'Information Poste Modifier avec succès');
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

    public function paramenu()
    {    
      $menus = Menu::all();

      return view ('postes.listeMenu')->with('menus', $menus);
      
        
         
    }
}
