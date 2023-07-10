<?php

namespace App\Http\Controllers;
use App\Operation;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Manifestation;
use Illuminate\Http\Request;

class OperationController extends Controller
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
    public function create(Request $request,$id)
    {
        $modifiervalidations = Manifestation::where('id',$id);
        $modifiervalidations->update(['etat_operation'=>'recu']);

          $modifieroperations = Operation::where('id',$id);
          $modifieroperations->update(['commentaire'=>"<b>Voici le Commentaire:</b>Bien reçu",'etat'=>"encours de traitement"]);
           

        $updvalidations = Manifestation::where('id',$id)->get();
        return view('demandeur.apercu_operation')->with('updvalidations',$updvalidations);
    }
     public function updvalidationoperation(Request $request,$id)
    {
    // if ($request->input('fiche')!='') { 
    //      $data = $request->input('fiche');
    //      $photo = $request->file('fiche')->getClientOriginalName();
    //      $destination = base_path() . '/public/uploads';
    //       $request->file('fiche')->move($destination, $photo);
    //       $modifiervalidations = Operation::where('id',$id);
    //     $modifiervalidations->update(['commentaire'=>$request->get('commentaire'),'etat'=>$request->get('etat'),'ficher'=>$photo]);
    //       } 
          
              $modifiervalidations = Operation::where('id',$id);
             $modifiervalidations->update(['commentaire'=>'<b>Voici le Commentaire:</b>'.$request->get('commentaire'),'etat'=>$request->get('etat')]);
             $modifieroperations = Manifestation::where('id',$request->get('id_manifestation'));
          $modifieroperations->update(['statut_manifestation'=>$request->get('etat')]);
              
        
        return redirect()->route('home')->with('succes', 'Data has been successfully');

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { $photo='';
        if ($request->input('fiche')!='') { 

            $data = $request->input('fiche');
          $photo = $request->file('fiche')->getClientOriginalName();
         $destination = base_path() . '/public/uploads';
          $request->file('fiche')->move($destination, $photo);
          } 
        

        $operation= new Operation();
        $operation->employer=$request->get('employer');
        $operation->date=date('d-m-Y');
        $operation->id_manifestation=$request->get('id_manifestation');
        $operation->commentaire='<b>Voici le Commentaire:</b>'.$request->get('commentaire');
        $operation->etat=$request->get('etat');
        $operation->departement=$request->get('departement');
        $operation->ficher=$photo;
        $operation->titre=$request->get('titre');
        $operation->id_user=$request->get('id_user');
        $operation->suprimer=0;
        $operation->save();
        $updvalidations = Manifestation::where('id',$request->get('id_manifestation'));
        $updvalidations->update(['statut_manifestation'=>$request->get('etat')]);
        return redirect()->route('home');
    }
    public function terminer(Request $request,$id)
    {
          $modifieroperations = Manifestation::where('id',$request->get('id_manifestation'));
          $modifieroperations->update(['statut_manifestation'=>'traitée']);

          $updvalidations = Operation::findOrFail($id);
          $updvalidations->update(['etat' =>'traitée','commentaire'=>$request->get('commentaire'),'date'=>date('d-m-Y')]);
         return redirect()->route('home')->with('succes', 'Data has been successfully');
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
