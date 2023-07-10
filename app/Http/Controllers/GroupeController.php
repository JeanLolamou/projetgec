<?php

namespace App\Http\Controllers;
use App\Departement;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use App\Affectation;
use App\Courrier;
use App\Reponse;
use App\Groupe;

use Illuminate\Http\Request;

class GroupeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { if(isset(Auth::user()->id))
        {
              if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites =  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('courrier_etat','Affecté')->get();

           }
           if((Auth::user()->user_role==3))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('visisbleChefCabinet','visible')
         ->where('courrier_etat','Affecté')->get();

          
         return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
           }

            if((Auth::user()->user_role==4))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('visibleSG','visible')
         ->where('courrier_etat','Affecté')->get();

          
         return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
           }
            if((Auth::user()->user_role==5))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites =  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('statut_courrier','Affecté')
         ->where('direction_affectation',Auth::user()->departement_id)
         ->get();

          
        
            }
            if((Auth::user()->user_role==6))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->join('users', 'users.id', '=', 'user_affecter')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','name','courriers.id' )
         ->where('statut_courrier','Trasmis')
         ->where('direction_affectation',Auth::user()->departement_id)
         ->where('user_affecter',Auth::user()->id)
         ->get();

          
         
            }
            if((Auth::user()->user_role==7))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->join('users', 'users.id', '=', 'user_affecter')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','name','courriers.id' )
         ->where('statut_courrier','Trasmis')
         ->where('direction_affectation',Auth::user()->departement_id)
         ->get();

          
         
            }
              $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();
        $groupes = Groupe::where('actif', 1)
       ->get();
        
           return view('groupes.index',['groupes'=>$groupes,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

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
            if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites =  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('courrier_etat','Affecté')->get();

           }
           if((Auth::user()->user_role==3))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('visisbleChefCabinet','visible')
         ->where('courrier_etat','Affecté')->get();

          
         return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
           }
            if((Auth::user()->user_role==4))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('visibleSG','visible')
         ->where('courrier_etat','Affecté')->get();

          
         return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
           }
            if((Auth::user()->user_role==5))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites =  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('statut_courrier','Affecté')
         ->where('direction_affectation',Auth::user()->departement_id)
         ->get();

          
        
            }
            if((Auth::user()->user_role==6))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
          ->where('statut_courrier','Affecté')
         ->where('service_affecte',Auth::user()->service_id)
         ->get();

          
         
            }
             if((Auth::user()->user_role==7))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->join('users', 'users.id', '=', 'user_affecter')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','name','courriers.id' )
         ->where('statut_courrier','Trasmis')
         ->where('direction_affectation',Auth::user()->departement_id)
         ->get();

          
         
            }
            $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();
         return view('groupes.create',['courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
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
        $departement= new Groupe();
       $departement->nom_groupe = $request->get('nom');
       $departement->sigle = $request->get('sigle');
       $departement->save();

        return redirect()->route('element_groupe')->with('success', 'Groupe crée avec succès');
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
            if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites =  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('courrier_etat','Affecté')->get();

           }
           if((Auth::user()->user_role==3))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('visisbleChefCabinet','visible')
         ->where('courrier_etat','Affecté')->get();

          
         return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
           }
            if((Auth::user()->user_role==4))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('visibleSG','visible')
         ->where('courrier_etat','Affecté')->get();

          
         return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
           }
            if((Auth::user()->user_role==5))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites =  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('statut_courrier','Affecté')
         ->where('direction_affectation',Auth::user()->departement_id)
         ->get();

          
        
            }
            if((Auth::user()->user_role==6))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('statut_courrier','Affecté')
         ->where('service_affecte',Auth::user()->service_id)
         ->get();

          
         
            }
             if((Auth::user()->user_role==7))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->join('users', 'users.id', '=', 'user_affecter')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','name','courriers.id' )
         ->where('statut_courrier','Trasmis')
         ->where('direction_affectation',Auth::user()->departement_id)
       
         ->get();

          
         
            }
            $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();
         $editdepartements = Groupe::findOrFail($id);
        return view('groupes.edit',['editdepartements'=>$editdepartements,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
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
          $departement = Groupe::findOrFail($request->id);
          $departement->update(['nom_groupe' => $request->nom, 'sigle' => $request->sigle]);

         return redirect()->route('groupe')->with('success', 'Information du Groupe Modifier avec succès');
           }
    else
        {
          return view('auth.login'); 
        }
    }


     public function elementgroupe()
    { 
        if(isset(Auth::user()->id))
        {
            if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites =  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('courrier_etat','Affecté')->get();

           }
           if((Auth::user()->user_role==3))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('visisbleChefCabinet','visible')
         ->where('courrier_etat','Affecté')->get();

          
         return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
           }
           if((Auth::user()->user_role==4))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('visibleSG','visible')
         ->where('courrier_etat','Affecté')->get();

          
         return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
           }
            if((Auth::user()->user_role==5))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites =  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('statut_courrier','Affecté')
         ->where('direction_affectation',Auth::user()->departement_id)
         ->get();

          
        
            }
            if((Auth::user()->user_role==6))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
          ->where('statut_courrier','Affecté')
         ->where('service_affecte',Auth::user()->service_id)
         ->get();

          
         
            }
  if((Auth::user()->user_role==7))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->join('users', 'users.id', '=', 'user_affecter')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','name','courriers.id' )
         ->where('statut_courrier','Trasmis')
         ->where('direction_affectation',Auth::user()->departement_id)
         ->get();

          
         
            }
              $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();
        $utilisateurs= DB::table('users')
         ->join('departements', 'departements.id', '=', 'departement_id')
         ->join('postes', 'postes.id', '=', 'user_role')
         ->select('users.*','departements.nom','User_poste')
         ->get();

          $departements = Groupe::where('actif', 1)
        ->get();
        
           return view('groupes.element_groupe',['utilisateurs'=>$utilisateurs,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites,'departements'=>$departements]);
        }
      else
        {
             return view('auth.login'); 
        }

    }


        public function liste_elementgroupe(Request $request)
    { 
        if(isset(Auth::user()->id))
        {
            if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites =  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('courrier_etat','Affecté')->get();

           }
           if((Auth::user()->user_role==3))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('visisbleChefCabinet','visible')
         ->where('courrier_etat','Affecté')->get();

          
         return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
           }
           if((Auth::user()->user_role==4))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('visibleSG','visible')
         ->where('courrier_etat','Affecté')->get();

          
         return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
           }
            if((Auth::user()->user_role==5))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites =  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('statut_courrier','Affecté')
         ->where('direction_affectation',Auth::user()->departement_id)
         ->get();

          
        
            }
            if((Auth::user()->user_role==6))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
          ->where('statut_courrier','Affecté')
         ->where('service_affecte',Auth::user()->service_id)
         ->get();

          
         
            }
  if((Auth::user()->user_role==7))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->join('users', 'users.id', '=', 'user_affecter')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','name','courriers.id' )
         ->where('statut_courrier','Trasmis')
         ->where('direction_affectation',Auth::user()->departement_id)
         ->get();

          
         
            }
            //MENU
              $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $groupes=$request->groupe;
           if($request->groupe>=1)
            {


            $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();
         $groupes=$request->groupe;
        $utilisateurs= DB::table('users')
         ->join('departements', 'departements.id', '=', 'departement_id')
         ->join('postes', 'postes.id', '=', 'user_role')
         ->select('users.*','departements.nom','User_poste')
         ->get();

          $departements = Groupe::where('id',$groupes )
        ->get();
        
           return view('groupes.liste_element_groupe',['utilisateurs'=>$utilisateurs,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites,'departements'=>$departements,'groupes'=>$groupes]);
        }
        else
        {
return redirect()->route('element_groupe')->with('errore', 'Choisir un élèment');
        }
        
        }
      else
        {
             return view('auth.login'); 
        }

    }
    



      public function elementduGroupe(Request $request)
    {
         

if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites =  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('courrier_etat','Affecté')->get();

           }
           if((Auth::user()->user_role==3))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('visisbleChefCabinet','visible')
         ->where('courrier_etat','Affecté')->get();

          
         return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
           }
           if((Auth::user()->user_role==4))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('visibleSG','visible')
         ->where('courrier_etat','Affecté')->get();

          
         return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
           }
            if((Auth::user()->user_role==5))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites =  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
         ->where('statut_courrier','Affecté')
         ->where('direction_affectation',Auth::user()->departement_id)
         ->get();

          
        
            }
            if((Auth::user()->user_role==6))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )
          ->where('statut_courrier','Affecté')
         ->where('service_affecte',Auth::user()->service_id)
         ->get();

          
         
            }
  if((Auth::user()->user_role==7))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->join('users', 'users.id', '=', 'user_affecter')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','name','courriers.id' )
         ->where('statut_courrier','Trasmis')
         ->where('direction_affectation',Auth::user()->departement_id)
         ->get();

          
         
            }
             //Menu
              $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

       

if($request->choix==0){   $users= User::where('id',$request->id)->get();          $utilisateur = User::findOrFail($request->id);               $utilisateur->update(['groupe_id' => $request->id_groupe]); }else{     $users= User::where('id',$request->id)->get();          $utilisateur = User::findOrFail($request->id);               $utilisateur->update(['groupe_id' =>NULL]); }
         

         $groupes=$request->id_groupe;
        $utilisateurs= DB::table('users')
         ->join('departements', 'departements.id', '=', 'departement_id')
         ->join('postes', 'postes.id', '=', 'user_role')
         ->select('users.*','departements.nom','User_poste')
         ->get();

          $departements = Groupe::where('id', $request->id_groupe)
        ->get();
        
           return view('groupes.liste_element_groupe',['utilisateurs'=>$utilisateurs,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites,'departements'=>$departements,'groupes'=>$groupes]);
             }



               // return redirect()->route('element_groupe')->with('success', 'Membre des groupes créer avec succès');
         // }
         // else
         // {
         //    return redirect()->route('element_groupe')->with('errore', 'Choisir un élèment');
         // }
            
       
    



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
