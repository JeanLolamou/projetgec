<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\MailConge;
use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
      Session::put('getCurrentApp', '');
      
        return redirect()->route('dashboard');
         
    }

public function accueilGEC()
    {
        Session::put('getCurrentApp', 'gec');
        return view('courriers/liste_courrier_arrive');
    }

    public function accueilPAO()
    {
        Session::put('getCurrentApp', 'pao');
        return view('pao/accueil');
    }

    public function accueilMANIFBESOIN()
    {
        Session::put('getCurrentApp', 'besoin');
        return view('manifbesoin/accueil');
    }


     public function gerer($id)
    {    
      

      $user = User::find($id);
    Auth::login($user);
       return redirect()->route('accueil');
          
    }

     public function accueil()
    {
      if (Auth::user()->statut!=1) {

          return view('paos.redirection');
         }else{


  

           
         $activite = DB::table('activites')
         ->where('supprimer',0)
         ->whereBetween('date_debut', [$debut,$fin])
         ->orderBY('id','DESC')->get();
        $direction = DB::table('directions')->where('supprimer',0)->get();

        
        return view('paos.index',compact('activite','direction'));

         }
    }

     public function direction()
    {  
        $direction =DB::table('directions')
         ->where('supprimer',0)
         ->orderBY('id')
        ->get();


        return view('paos.direction',compact('direction'));
        
    }


     public function profil()
    {  
  
       $editusers= DB::table('users')
   
         ->where('id',Auth::user()->id)
        ->get();

         

        


        return view('paos.personnel_profil_manager',compact('editusers'));
        
    }

    

    public function personnel()
    {  
       

        if (Auth::user()->poste=="Administrateur") {
            $personnel =DB::table('users')->orderBY('id','DESC')->get();
        return view('paos.personnel',compact('personnel'));
        }else{
            return redirect()->route("home");
        }
    }
    

     public function inscription()
    {   

       $direction = DB::table('directions')->where('supprimer',0)->get();
       return view('auth.register',compact('direction'));
    }

     public function role()
    {   
       if (Auth::user()->id_role==3) {
         $notification =DB::table('notifications')
        ->where([['etat',0],['id_user',Auth::user()->id]])
        ->orWhere([['etat',0],['id_user',0]])
        ->orderBY('id','DESC')
        ->get();
        }else{

          $notification =DB::table('notifications')
         ->where([['etat',0],['id_user',Auth::user()->id]])
        ->orderBY('id','DESC')
        ->get();

        }


        if (Auth::user()->id_role==3) {
            $personnel =DB::table('users')->orderBY('id','DESC')->get();
           $role = DB::table('roles')->get();
        return view('paos.role',compact('personnel','role','notification'));
        }
    }



    public function activite(Request $request)
    {   

       

        if (isset($request->date_debut)) {
           $requete="select * from activites where supprimer=0";
        }else{
          $requete="select * from activites where supprimer=0 and date_debut>=''";
        }
        $exist_dir=$request->direction;
        $exist_statut=$request->statut;
        $exist_debut=$request->date_debut;
        $exist_fin=$request->date_fin;


        if (isset($request->direction) and ($request->direction!=-1)) {
            $requete.=" and direction=".$request->direction;
        }

        if (isset($request->statut) and ($request->statut!=-1)) {
           $requete.=" and statut=".$request->statut;
        }

        if (isset($request->date_debut)) {
           $debut=date($request->date_debut);
           $requete.=" and date_debut>='$debut'";
        }

        if (isset($request->date_fin)) {
           $fin=date($request->date_fin);
           $requete.=" and date_fin<='$fin'";
        }


          $requete.=" order BY id DESC";

         $activite=DB::SELECT($requete);

        $direction = DB::table('directions')->where('supprimer',0)->get();
        
        if ($request->page==1) {
           return view('paos.index',compact('activite','direction','exist_dir','exist_statut','exist_debut','exist_fin'));
        }else{
            return view('paos.activite',compact('activite','direction','exist_dir','exist_statut','exist_debut','exist_fin'));
        }

    }



      public function parametrerReunion($id)
    {   
      $ordre="";
       $reunion = DB::table('reunions')->where('id',$id)->get();
        foreach ($reunion as $reunion) {
          $ordre=$reunion->ordre;
        }
       $participant = DB::table('participants')->where([['id_reunion',$id],['supprimer',0]])->get();
       $expose = DB::table('exposes')->where([['id_reunion',$id],['supprimer',0]])->get();
       $action = DB::table('actions')->where([['id_reunion',$id],['supprimer',0]])->get();

       $recommandation = DB::table('recommandations')->where([['id_reunion',$id],['supprimer',0]])->get();

        return view('paos.reunion_parametre',compact('id','participant','expose','recommandation','ordre','action'));
    }


public function parametrerReuniondepartement($id)
    {   
      $ordre="";
       $reuniondepartement = DB::table('reuniondepartements')->where('id',$id)->get();
        foreach ($reuniondepartement as $reuniondepartement) {
          $ordre=$reuniondepartement->ordre;
        }
       $participantdepartement = DB::table('participantdepartements')->where([['id_reuniondepartement',$id],['supprimer',0]])->get();
       $exposedepartement = DB::table('exposedepartements')->where([['id_reuniondepartement',$id],['supprimer',0]])->get();

       $recommandationdepartement = DB::table('recommandationdepartements')->where([['id_reuniondepartement',$id],['supprimer',0]])->get();

        return view('paos.reuniondepartement_parametre',compact('id','participantdepartement','exposedepartement','recommandationdepartement','ordre'));
    }










     public function rapport(Request $request)
    {   
        $requete="select * from rapports where supprimer=0";
        $exist_dir=$request->direction;
         $exist_debut=$request->date_debut;
        $exist_fin=$request->date_fin;


        if (isset($request->direction) and ($request->direction!=-1)) {
            $requete.=" and id_direction=".$request->direction;
        }

        if (isset($request->date_debut)) {
           $debut=date($request->date_debut);
           $requete.=" and date>='$debut'";
        }

        if (isset($request->date_fin)) {
           $fin=date($request->date_fin);
           $requete.=" and date<='$fin'";
        }

           if (Auth::user()->user_role!=1) {
              $requete.=' and id_direction='.Auth::user()->id_direction.'';
           }

           $requete.=" order BY id DESC";
         
         $rapport=DB::SELECT($requete);

        $direction = DB::table('departements')->where('actif',1)->get();

        session()->flash('message','Filtre effectué avec succés');
        
       return view('paos.rapport',compact('rapport','direction','exist_dir','exist_debut','exist_fin'));

    }

     public function statistique()
    {   
         $annee=anneEnCours();
             $debut1=date($annee.'-01-01');
           $fin1=date($annee.'-12-31');

       $requete="select * from activites where supprimer=0 and date_debut>='$debut1'";
      



       


          $requete.=" order BY id DESC";

         $activite=DB::SELECT($requete);

        $direction = DB::table('departements')->where('actif',1)->get();
        
       return view('paos.statistique',compact('activite','direction'));

    }

       public function statistiquecourrier()
    {   
         $annee=anneEnCours();
             $debut1=date($annee.'-01-01');
           $fin1=date($annee.'-12-31');

       $requete="select * from activites where supprimer=0 ";

          $requete.=" order BY id DESC";

         $courrier=DB::SELECT($requete);

        $direction = DB::table('departements')->where('actif',1)->get();
        
       return view('courriers.statistique_courrier',compact('courrier','direction'));

    }

  public function ajoutSousActivite($id)
    {   
      
       $activites = DB::table('activites')->where('id',$id)->get();
        
        return view('paos.sousactivite_ajout',compact('activites'));
    }






     public function filtrestatistique(Request $request)
    {   
        $requete="select * from activites where supprimer=0";
        $exist_dir=$request->direction;
        $exist_statut=$request->statut;
        $exist_debut=$request->date_debut;
        $exist_fin=$request->date_fin;
        $exist_taux=$request->niveau;



        if (isset($request->direction) and ($request->direction!=-1)) {
            $requete.=" and direction=".$request->direction;
        }

        if (isset($request->statut) and ($request->statut!=-1)) {
           $requete.=" and statut=".$request->statut;
        }

        if (isset($request->date_debut)) {
           $debut=date($request->date_debut);
           $requete.=" and date_debut>='$debut'";
        }

        if (isset($request->date_fin)) {
           $fin=date($request->date_fin);
           $requete.=" and date_fin<='$fin'";
        }

         if (isset($request->niveau)) {
           $requete.=" and niveau=".$request->niveau;
        }


          $requete.=" order BY id DESC";

         $activite=DB::SELECT($requete);

        $direction = DB::table('departements')->where('actif',1)->get();
        
       return view('paos.statistique',compact('activite','direction','exist_dir','exist_statut','exist_debut','exist_fin','exist_taux'));

    }



    public function statistiqueglob()
    {   
       
         $activite=collect();

        $direction = DB::table('departements')->where('actif',1)->get();
        
       return view('paos.statistiqueglob2',compact('activite','direction'));

    }


     public function filtrestatistiqueglob(Request $request)
    {   
        $requete="select * from activites where supprimer=0";
         $exist_dir=$request->direction;
        $exist_statut=$request->statut;
        $exist_debut=$request->date_debut;
        $exist_fin=$request->date_fin;
        $exist_taux=$request->niveau;
        
        if (isset($request->date_debut)) {
           $debut=date($request->date_debut);
           $requete.=" and date_debut>='$debut'";
        }

        if (isset($request->date_fin)) {
           $fin=date($request->date_fin);
           $requete.=" and date_fin<='$fin'";
        }

        

        $direction = DB::table('departements')->where('actif',1)->get();
        
       return view('paos.statistiqueglob2',compact('direction','exist_debut','exist_fin','exist_taux'));

    }



public function manif()
    {
        if(isset(Auth::user()->id))
        {
                //$manifestations= Manifestation::where('supprime_manifestation', 0)->get();
                $utilisateurs= User::where('id', Auth::user()->id)->get();

                if(Auth::user()->poste=="Charger d'Etude" OR Auth::user()->poste=="Chef Service")
                {
                   
                            $demandeurmanifestation=DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('operations.id_user', Auth::user()->id)
                    ->where('etat','traitée')->get(); 

                      $demandeurtacherealiser=DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('operations.employer', Auth::user()->email)
                    ->where('etat','traitée')->get(); 


                                $demandeurencour= DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('operations.id_user', Auth::user()->id)
                    ->where('etat','encours de traitement')->get();

                    $demandeurrejeter= Manifestation::where('id_user', Auth::user()->id)
                                            ->where('statut_manifestation','rejeter')->get();
                    $demandeurdepartement= Manifestation::where('id_user', Auth::user()->id)
                                            ->where('statut_manifestation','envoyer')->get();
                    $demandeurdirection= Manifestation::where('id_user', Auth::user()->id)
                                            ->where('statut_manifestation','valider')->get();

                    

                     $demandeurtacheencour= DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('operations.employer', Auth::user()->email)
                    ->where('etat','encours de traitement')->get();


                    // debut menu actuel
                    // menu Liste des manifestations

                    $listemanifestation= Manifestation::where('id_user', Auth::user()->id)
                               ->get(); 
                    //  Fin menu Liste des manifestations

                    // menu Nouvelles Taches

                    $demandeurtache= Manifestation::where('employer_affecter', Auth::user()->email)
                    ->where('statut_manifestation','<>','traitée')->get();
                    // fin menu Nouvelles Taches

                    // menu Liste des Taches

                    $listedestache=DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('operations.employer', Auth::user()->email)
                    ->where('etat','traitée')
                    ->get();            
                //fin menu Liste des Taches
                    return view('home\demandeur',['demandeurmanifestation'=>$demandeurmanifestation,'demandeurencour'=>$demandeurencour,'demandeurrejeter'=>$demandeurrejeter,'demandeurdepartement'=>$demandeurdepartement,'demandeurdirection'=>$demandeurdirection,'demandeurtacheencour'=>$demandeurtacheencour,'demandeurtacherealiser'=>$demandeurtacherealiser,'listemanifestation'=>$listemanifestation, 'demandeurtache'=>$demandeurtache,'listedestache'=>$listedestache]);
                }

                if(Auth::user()->poste=="Direction")
                {    $demandeurmanifestation= DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('operations.etat','fait')
                    ->get();

                   


                    $demandeurencour= DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('operations.etat','encour')
                    ->get();


                    $demandeurrejeter= Manifestation::
                    where('statut_manifestation','rejeter')->get();

                    $demandeurdepartement= Manifestation::
                   where('statut_manifestation','envoyer')->get();
                   
                    $demandeurdirection= Manifestation::
                    where('statut_manifestation','valider')->get();

                   // debut menu actuel
                    // menu Liste des manifestations

                    $listemanifestation= Manifestation::where('statut_manifestation','<>','valider')->get(); 
                    //  Fin menu Liste des manifestations

                    // menu Nouvelles Taches

                    $demandeurtache= Manifestation::where('statut_manifestation','<>','traitée')->get();
                    // fin menu Nouvelles Taches
                     $listedemanifestation= Manifestation::where('id_user', Auth::user()->id)
                               ->get();
                    // menu Liste des Taches

                    $listedestache=DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('etat','traitée')
                    ->get();   

                    return view('home\direction',['demandeurmanifestation'=>$demandeurmanifestation,'demandeurencour'=>$demandeurencour,'demandeurrejeter'=>$demandeurrejeter,'demandeurdepartement'=>$demandeurdepartement,'demandeurdirection'=>$demandeurdirection,'listemanifestation'=>$listemanifestation,'demandeurtache'=>$demandeurtache,'listedestache'=>$listedestache,'listedemanifestation'=>$listedemanifestation]);
                }


                if(Auth::user()->poste=="Chef de Departement")
                {
                    $demandeurmanifestation=DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('departement_envoi', Auth::user()->nom_departement)
                    ->where('operations.etat','fait')
                    ->get();

                    

                    $demandeurencour= DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('departement_envoi', Auth::user()->nom_departement)
                    ->where('operations.etat','encour')
                    ->get(); 



                    $demandeurrejeter= Manifestation::
                    where('departement_envoi', Auth::user()->nom_departement)->where('statut_manifestation','rejeter')->get();

                    $demandeurdepartement= Manifestation::
                    where('departement_envoi', Auth::user()->nom_departement)->where('statut_manifestation','envoyer')->get();
                    
                    $demandeurdirection= Manifestation::
                    where('departement_envoi', Auth::user()->nom_departement)->where('statut_manifestation','valider')->get();

                     $demandeurtache= Manifestation::where('departement_affecte', Auth::user()->nom_departement)
                                               ->where('etat_operation',NULL)
                                               ->get();


                     // debut menu actuel
                    // menu Liste des manifestations

                    $listemanifestation= Manifestation::where('departement_envoi', Auth::user()->nom_departement)
                    ->where('statut_manifestation','<>','envoyer')
                               ->get(); 
                    //  Fin menu Liste des manifestations

                    // menu Nouvelles Taches

                    $demandeurtache= Manifestation::where('departement_affecte', Auth::user()->nom_departement)
                    ->whereIn('statut_manifestation', ['affecter', 'encours de traitement'])
                    ->get();
                    // fin menu Nouvelles Taches

                    // menu Liste des Taches
                    $listedemanifestation= Manifestation::where('id_user', Auth::user()->id)
                               ->get();

                    $listedestache=DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('departement_affecte', Auth::user()->nom_departement)
                    ->where('etat','traitée')
                    ->get();   

                    return view('home\departement',['demandeurmanifestation'=>$demandeurmanifestation,'demandeurencour'=>$demandeurencour,'demandeurrejeter'=>$demandeurrejeter,'demandeurdepartement'=>$demandeurdepartement,'demandeurdirection'=>$demandeurdirection, 'demandeurtache'=>$demandeurtache,'listemanifestation'=>$listemanifestation,'demandeurtache'=>$demandeurtache,'listedestache'=>$listedestache,'listedemanifestation'=>$listedemanifestation]);
                }


                 if(Auth::user()->role=="administrateur")
                {
                    return view('home');
                }

    }
    else
        {
          return view('auth.login'); 
        }   

       
}
     



}
