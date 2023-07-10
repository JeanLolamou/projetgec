<?php

namespace App\Http\Controllers;

use App\Activite;
use App\Sousactivite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SousactiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activites = DB::table('activites')->where('supprimer',0)->get();
        
        return view('paos.sousactivite_ajout',compact('activites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Sousactivite::create(['id_activite'=>$request->activite, 'libelle'=>$request->libelle, 'statut'=>$request->statut, 'niveau'=>$request->niveau, 'date_debut'=>$request->date_debut, 'date_fin'=>$request->date_fin]);

        $niveau=getNiveauActivite($request->activite);
         $niveau+=$request->niveau;


         $activite1 = Activite::where('id','=',$request->activite);
         
              $activite1->update(['sousactivite'=>1,'niveau'=>$niveau]);
         

     session()->flash('success','Sous-Activité ajoutée avec succès');

        

        return redirect()->back();
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
         $sousactivites = DB::table('sousactivites')->where('id',$id)->get();
          $activite = DB::table('activites')->where('id',$id)->get();
        return view('paos.sousactivite_edit',compact('activite','sousactivites'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sousactivite1 = Sousactivite::where('id','=',$id);

        if (isset($request->sup)) {
          //suppression
           $sousactivite1 = Sousactivite::where('id','=',$id);
         
              $sousactivite1->update(['supprimer'=>1]);
         

          
         session()->flash('success','Suppression effectuée avec succées');

         return redirect()->route('Sousactivite.index');
         }else{

             $sousactivite1->update([ 'libelle'=>$request->libelle, 'statut'=>$request->statut, 'niveau'=>$request->niveau, 'date_debut'=>$request->date_debut, 'date_fin'=>$request->date_fin]);

              $niveau=getNiveauActivite($request->activite);
          

         $activite1 = Activite::where('id','=',$request->activite);
         
              $activite1->update(['sousactivite'=>1,'niveau'=>$niveau]);

              session()->flash('success','modification effectuée avec succées');

         return redirect()->route('Sousactivite.edit',$id);
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
