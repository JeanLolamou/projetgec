<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use App\Affectation;
use App\Courrier;
use App\Reponse;
use App\Visiteur;
use App\Rendez_vou;
use App\Numerorendezvou;
use App\Poste;
use App\Mail\MailEnregistrementRendezVous;
use App\Mail\MailPresenceRendezVous;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Http\Request;

class VisiteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { if(isset(Auth::user()->id))
        {
             if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8)||(Auth::user()->user_role>10))
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
        $visiteurs = DB::table('visiteurs')
        ->join('rendez_vous','visiteurs.id','=','id_visiteur')
        ->select('nomvisiteur', 'telephonevisiteur', 'emailvisiteur','entreprisevisiteur','titre','motif','date_rendez_vous','type_rendez_vous','priorite','rendez_vous.id','numerovisite','statut')
          ->where('statut',"Attente")
        ->get();
        $texte="Liste des Rendez vous en Attente";
           return view('visiteurs.index',['visiteurs'=>$visiteurs,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites,'texte'=>$texte]);

    }
    else
        {
          return view('auth.login'); 
        }   

    }

    public function present_rendez_vous()
    { if(isset(Auth::user()->id))
        {
             if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8)||(Auth::user()->user_role>10))
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
        $visiteurs = DB::table('visiteurs')
        ->join('rendez_vous','visiteurs.id','=','id_visiteur')
        ->select('nomvisiteur', 'telephonevisiteur', 'emailvisiteur','entreprisevisiteur','titre','motif','date_rendez_vous','type_rendez_vous','priorite','rendez_vous.id','numerovisite','statut')
        ->where('statut',"Présent")
        ->get();
        
            $texte="Liste des Visiteurs Presents au Rendez vous";
           return view('visiteurs.index',['visiteurs'=>$visiteurs,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites,'texte'=>$texte]);


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
            if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8)||(Auth::user()->user_role>10))
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
         $visiteurs=Visiteur::where('actif',1)->get();
         return view('visiteurs.create',['courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites,'visiteurs'=>$visiteurs]);
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
      public function storevisiteur(Request $request)
    { if(isset(Auth::user()->id))
        {
        $visiteur= new Visiteur();
       $visiteur->nomvisiteur = $request->get('nomvisiteur');
       $visiteur->telephonevisiteur = $request->get('telephonevisiteur');
        $visiteur->emailvisiteur = $request->get('emailvisiteur');
        $visiteur->entreprisevisiteur = $request->get('entreprisevisiteur');
        $visiteur->save();

 

        return redirect()->route('addRendez_vous');
         }
    else
        {
          return view('auth.login'); 
        }
    }

    public function store(Request $request)
    { if(isset(Auth::user()->id))
        {
             $val=0;
            $vals=Numerorendezvou::get();

      foreach ( $vals as  $value) {

        $val=$value->numeroR;

        }

        $val+=1;

      if(strlen($val)==1)

      {

        $numero='MTP/V/000'.$val.'/'.(date("Y"));

      }

        if(strlen($val)==2)

      {

        $numero='MTP/V/00'.$val.'/'.(date("Y"));

      }

         if(strlen($val)==3)

      {

        $numero='MTP/V/0'.$val.'/'.(date("Y"));

      }     

          if(strlen($val)==4)

      {

        $numero=$val.'MTP/V/'.(date("Y"));

      } 

      

        $visiteur= new Rendez_vou();
       $visiteur->id_visiteur = $request->get('id_visiteur');
       $visiteur->titre = $request->get('titre');
        $visiteur->type_rendez_vous = $request->get('type_rendez_vous');
        $visiteur->priorite = $request->get('');
        $visiteur->lieuRendez_vous = $request->get('lieu');
         $visiteur->motif = $request->get('motif');
        $visiteur->date_rendez_vous = $request->get('date_rendez_vous');
        $visiteur->statut = "Attente";
        $visiteur->date_enregistrement=date('d/m/Y H:i:s');
        $visiteur->numerovisite=$numero;
        $visiteur->save();
$numcou=Numerorendezvou::create(['numeroR'=>$val,'dateNR'=>date("Y")]);

        $rendezvous= DB::table('rendez_vous')
         ->join('visiteurs', 'visiteurs.id', '=', 'id_visiteur')
         ->select('rendez_vous.id','titre','type_rendez_vous', 'priorite' ,'motif', 'date_rendez_vous','statut', 'date_enregistrement','nomvisiteur','telephonevisiteur', 'emailvisiteur','entreprisevisiteur','numerovisite','lieuRendez_vous')
      ->get();

foreach ($rendezvous as $key => $value) {
    $nomvisiteur=$value->nomvisiteur;
    $emailvisiteur=$value->emailvisiteur;
    $date_rendez_vous=$value->date_rendez_vous;
    $motif=$value->motif;
    $titre=$value->titre;
    $numero=$value->numerovisite;
    $lieu=$value->lieuRendez_vous;
}
setlocale(LC_TIME, 'fr_FR');
$MaVariable1 = str_replace("T", "",  $date_rendez_vous);
  $date= date("d-F-Y à H:i:s",strtotime($MaVariable1 ));
  
   
Mail::to($emailvisiteur)->send(new MailEnregistrementRendezVous($titre,$motif,$date,$nomvisiteur,$numero, $lieu));
        return redirect()->route('addRendez_vous')->with('success', 'Rendez-vous Enregistré avec succès');
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
            if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8)||(Auth::user()->user_role>10))
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
      
         $editvisiteur =DB::table('rendez_vous')
         ->join('visiteurs', 'visiteurs.id', '=', 'id_visiteur')
         ->select('rendez_vous.id','titre','type_rendez_vous', 'priorite' ,'motif', 'date_rendez_vous','statut', 'date_enregistrement','nomvisiteur','telephonevisiteur', 'emailvisiteur','entreprisevisiteur','numerovisite','lieuRendez_vous','statut')
         ->where('rendez_vous.id',$id)->get();

        return view('visiteurs.edit',['editvisiteur'=>$editvisiteur,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
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

public function validationRendez_vous(Request $request)
{
    if(isset(Auth::user()->id))
        {
 
            $visiteur = Rendez_vou::findOrFail($request->id);
            $visiteur->update(['statut'=>"Présent",'date_visite'=>date("Y-m-d H:i:s")]);

            $rendezvous= DB::table('rendez_vous')
         ->join('visiteurs', 'visiteurs.id', '=', 'id_visiteur')
         ->select('rendez_vous.id','titre','type_rendez_vous', 'priorite' ,'motif', 'date_rendez_vous','statut', 'date_enregistrement','nomvisiteur','telephonevisiteur', 'emailvisiteur','entreprisevisiteur','numerovisite','lieuRendez_vous')
         ->where('rendez_vous.id',$request->id)->get();

foreach ($rendezvous as $key => $value) {
    $nomvisiteur=$value->nomvisiteur;
    $emailvisiteur=$value->emailvisiteur;
    $date_rendez_vous=$value->date_rendez_vous;
    $motif=$value->motif;
    $titre=$value->titre;
    $numero=$value->numerovisite;
    $lieu=$value->lieuRendez_vous;
}
setlocale(LC_TIME, 'fr_FR');
$MaVariable1 = str_replace("T", "",  $date_rendez_vous);
  $date= date("d-F-Y à H:i:s",strtotime($MaVariable1 ));
  
   $utilisateurs=User::where('user_role',2)->get();

   foreach ($utilisateurs as $key =>$utilisateur) {
    $emailministre=$utilisateur->email;
    $nomministre=$utilisateur->name;
       # code...
   }

Mail::to($emailministre)->send(new MailPresenceRendezVous($nomministre,$titre,$motif,$date,$nomvisiteur,$numero, $lieu));
return redirect()->route('listeRendez_vous')->with('success', 'presence valider avec succès');
 
}
    else
        {
          return view('auth.login'); 
        }
}
    public function update(Request $request)
    {  if(isset(Auth::user()->id))
        {
          
          $visiteur = Visiteur::findOrFail($request->id);
          $visiteur->update(['nomvisiteur' => $request->nomvisiteur,
                            'telephonevisiteur' => $request->telephonevisiteur,
                             'emailvisiteur' => $request->emailvisiteur,
                             'entreprisevisiteur' => $request->entreprisevisiteur,
                             'motif' => $request->motif,
                             'date_rendez_vous' => $request->date_rendez_vous]);

         return redirect()->route('poste')->with('success', 'Information Poste Modifier avec succès');
           }
    else
        {
          return view('auth.login'); 
        }
    }
    public function validerRendez_vous(Request $request)
    {  if(isset(Auth::user()->id))
        {
          
          $visiteur = Visiteur::findOrFail($request->id);
          $visiteur->update(['commentaire' => $request->commentaire,
                            'datevisite' => $request->datevisite,
                             'presence' => $request->presence,
                             'datevisite' => date()
                            ]);

         return redirect()->route('poste')->with('success', 'Information Poste Modifier avec succès');
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
