<?php

namespace App\Http\Controllers;
use App\Departement;
use DB;
use Illuminate\Support\Facades\Auth;

use App\Affectation;
use App\Courrier;
use App\Reponse;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
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
        $services = DB::table('services')
         ->join('departements', 'departements.id', '=', 'direction_id')
          ->select('departements.nom','services.*')
         ->where('services.actif', 1)->get();
        
           return view('services.index',['services'=>$services,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
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
        { if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8))
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
         $departements = Departement::where('actif', 1)->get();
         return view('services.create',['courrierAttentes'=>$courrierAttentes,'departements'=>$departements,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites])->with('success', 'Direction Enregistré avec succès');
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
        $departement= new Service();
       $departement->nom = $request->get('nom_service');
       $departement->sigle = $request->get('sigle');
        $departement->direction_id = $request->get('direction');
       $departement->save();

        return redirect()->route('adddepartement')->with('success', 'Service Enregistrée avec succès');
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
         $editdepartements = Service::where('id',$id)->get();
        return view('departements.edit',['editdepartements'=>$editdepartements,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites,'courrierAttentes'=>$courrierAttentes]);
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
    public function update(Request $request,$id)
    {  if(isset(Auth::user()->id))
        {
          $departement = Service::findOrFail($id);
          $departement->update(['nom' => $request->nom, 'sigle' => $request->sigle]);
         return redirect()->route('departement.index')->with('succes', 'Data has been successfully');
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
