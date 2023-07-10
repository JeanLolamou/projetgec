<?php



namespace App\Http\Controllers;

use DB;

use App\User;

use Illuminate\Http\Request;

use App\Courrier;
use App\Models\Priorite;

use App\Reponse;

use App\Departement;

use App\Affectation;

use App\Numerocourrier;

use App\Annotationtype;

use Mail;

use App\Mail\Envoimail;

use Illuminate\Support\Facades\Auth;

use App\Mail\MailEnregistrementCourrier;

use App\Mail\MailDechargerCourrier;

use App\Mail\MailEnregistrementCourrierDestinateur;

use App\Mail\MailEnregistrementCourrierDepartDestinateur;

use App\Mail\MailEnregistrementCourrierDepart;
use App\Mail\MailRelanceAnnotationCourrier;







class CourrierController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */







    public function accueil()

    {

       
     
         if(isset(Auth::user()->id))

         {
         
         if(Auth::user()->user_statut==1)
         {

                   if((Auth::user()->user_role==1)||(Auth::user()->user_role==2)) 

           {


       return redirect()->route('listeCourrierAffecter');

           }
         
           if((Auth::user()->user_role==8)||(Auth::user()->user_role==9))

           {

            return redirect()->route('listeCourrierAttente');

           }


           if((Auth::user()->user_role==3)||(Auth::user()->user_role==4))

           {

           return redirect()->route('listeCourrierAffecter');

           }

            if((Auth::user()->user_role==5)||(Auth::user()->user_role==7)||(Auth::user()->user_role==6))

           {

            return redirect()->route('listeCourrierAffecter');

           }



         }
           
           else{
             return view ('pages/pagedesactiver');

           } 
              }

    }

  public function relance()
    {
      
      
      //RELANCE DG ANNOTATION
        $responsables=DB::table('users')
        ->join('postes','postes.id','=','user_role' )
         ->select('email','User_poste','name')
       ->where('user_role',2)->get(); 
        $courriers=Courrier::where('courrier_etat','attente')
        ->where('date_arrivee','<',date("Y-m-d H:i:s"))
         ->get();
          $lien="http://courrier.apipguinee.com/";
         foreach ($responsables as $responsable) {
           $emailresponsable=$responsable->email;
            $postresponsable=$responsable->name;
          }
       
if(count($courriers)>=1)
{
  $annotationscourrierRelance=count($courriers);
   Mail::to($emailresponsable)->send(new MailRelanceAnnotationCourrier($annotationscourrierRelance,$lien,$postresponsable));
}
//RELANCE TRAITEMENT COURRIER MANAGER
 $managers=User::where('user_role',3)->Orwhere('user_role',4)->Orwhere('user_role',5)->Orwhere('user_role',8)->Orwhere('user_role',9)->get(); 

foreach ($managers as $key => $value) {

         $courrierEnAttenteTraites =  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','affectations.date_affectationManager', 'commentaire','courriers.id' )
         ->where('statut_courrier','Affecté')
         ->where('direction_affectation','=',$value->departement_id)
         ->where('affectations.date_affectation','<',date("Y-m-d H:i:s"))
         ->get();

         if(count($courrierEnAttenteTraites)>=1)
         { $emailresponsable=$value->email;
            $postresponsable=$value->name;

          $RelanceTraitementCourrier=count($courrierEnAttenteTraites);
          Mail::to($emailresponsable)->send(new MailRelanceTraitementCourrier($RelanceTraitementCourrier,$lien,$postresponsable));
         }
}
 //RELANCE TRAITEMENT COURRIER COLLABORATUER
$managers=User::where('user_role',6)->get(); 

foreach ($managers as $key => $value) {

         $courrierEnAttenteTraites =  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation', 'affectations.date_affectationManager', 'commentaire','courriers.id' )
         ->where('statut_courrier','Trasmis')
         ->where('user_affecter','=',$value->id)
         ->where('date_affecter_manager','<',date("Y-m-d H:i:s"))
         ->get();

         if(count($courrierEnAttenteTraites)>=1)
         { $emailresponsable=$value->email;
            $postresponsable=$value->name;

          $RelanceTraitementCourriercoll=count($courrierEnAttenteTraites);
          Mail::to($emailresponsable)->send(new MailRelanceTraitementCourrier($RelanceTraitementCourriercoll,$lien,$postresponsable));
         }
}
  return redirect()->route('listeCourrierAttente')->with('success','Relance des courriers effectuées avec succès')->withInput();

}
  

    public function index()

    {

        if(isset(Auth::user()->id))

        {

            return view('manifestation.index');

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

    public function create($id)

    {

        if(isset(Auth::user()->id))

        {    

 $val=0;



 $departements = Departement::where('actif', 1)->get(); 
        
$priorites = Priorite::where('actif', 1)->get();
      $vals=Numerocourrier::get();

      foreach ( $vals as  $value) {

        $val=$value->numeroC;

        }

        $val+=1;

      if(strlen($val)==1)

      {

        $numero='000'.$val.'/'.(date("Y"));

      }

        if(strlen($val)==2)

      {

        $numero='00'.$val.'/'.(date("Y"));

      }

         if(strlen($val)==3)

      {

        $numero='0'.$val.'/'.(date("Y"));

      }     

          if(strlen($val)==4)

      {

        $numero=$val.'/'.(date("Y"));

      } 

      

      

      if($id==1)
      {
         return view('courriers.add_courrier',['numero'=>$numero,'priorites'=>$priorites, 'departements'=>$departements]);
      }

      if($id==2)
      {
         return view('courriers.add_courrier_presidence',['numero'=>$numero,'priorites'=>$priorites, 'departements'=>$departements]);
      }

      if($id==3)
      {
         return view('courriers.add_courrier_minier',['numero'=>$numero,'priorites'=>$priorites, 'departements'=>$departements]);
      }

                

           

           

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

    { $emailresponsable='';

      

       if(isset(Auth::user()->id))

       {$val=0;

           // $fichierName = $request->file_path->getClientOriginalName().'.'.$request->file_path->getClientOriginalExtension();



           $fichierName = $request->file_path->getClientOriginalName();



         

        if($request->type_courrier=='Arrivée')

        {

            $request->file_path->move(public_path('/documents/Arrives'), $fichierName);
            // var_dump($fichierName);die();

            $attente="attente";

        }

         else

         {

            $request->file_path->move(public_path('/documents/Depart'), $fichierName);

            $attente="expedié";

         }

        $vals=Numerocourrier::get();

      foreach ( $vals as  $value) {

        $val=$value->numeroC;

        }

        $val+=1;

      if(strlen($val)==1)

      {

        $numero='000'.$val.'/'.(date("Y"));

      }

        if(strlen($val)==2)

      {

        $numero='00'.$val.'/'.(date("Y"));

      }

         if(strlen($val)==3)

      {

        $numero='0'.$val.'/'.(date("Y"));

      }     

          if(strlen($val)==4)

      {

        $numero=$val.'/'.(date("Y"));

      } 

         

      

    

      

          $courrier = Courrier::create(['objet'=>$request->objet,'reference'=>$request->reference,'destinataire'=>$request->destinataire,'file_path'=>$request->file_path->getClientOriginalName(),'type_courrier'=>$request->type_courrier,'email'=>$request->email,'courrier_etat'=>$attente,'telephone'=>$request->telephone,'numero'=>$numero,'date_arrivee'=>date("Y-m-d H:i:s"),'categorieCourrier'=>$request->categorie,'user_id'=>Auth::user()->id,'synthese'=>$request->synthese, 'direction_suivie'=>$request->suivie]);

          $numcou=Numerocourrier::create(['numeroC'=>$val,'dateNC'=>date("Y")]);

          $responsables=User::where('user_role',2)->get();





          foreach ($responsables as $responsable) {

           $emailresponsable=$responsable->email;

            $postresponsable=$responsable->name;

              

          }

          $objet=$request->objet;

          $reference=$request->reference;

          $destinataire=$request->destinataire;

          $file_path=$request->file_path->getClientOriginalName();

          $type_courrier=$request->type_courrier;

          $lien="http://mtp.inektogec.com/listeCourrierAttente";

         

  

  // Mail::to($emailresponsable)->send(new MailEnregistrementCourrier($objet,$reference, $destinataire,$type_courrier,$file_path,$lien));

             if($request->type_courrier=='Arrivée')

             {
              
                 //Mail::to($emailresponsable)->send(new MailEnregistrementCourrier($objet,$reference, $destinataire,$type_courrier,$file_path,$lien,$postresponsable,$request->categorie));

                   // Mail::to($request->email)->send(new MailEnregistrementCourrierDestinateur($objet,$reference, $destinataire,$type_courrier,$file_path,$numero,$postresponsable,$request->categorie));
          



             }

             else{

                    // Mail::to($request->email)->send(new MailEnregistrementCourrierDepartDestinateur($objet,$reference, $destinataire,$type_courrier,$file_path,$numero,$postresponsable,$fichierName));

                    $lien="http://mtp.inektogec.com/listeCourrierDepart";

                   

                   //Mail::to($emailresponsable)->send(new MailEnregistrementCourrierDepart($objet,$reference, $destinataire,$type_courrier,$file_path,$lien,$postresponsable,$request->categorie));

             }

       return redirect()->route('listeCourrierArrive')->with('success','Courrier enregistré avec succès')->withInput();
    
       
     

        }



        else

        {

            return view('auth.login'); 

        }



     // $image1 = $request->file('doc')->store('img');

     //    return $request->file('doc');

    }

 // liste courrier affecter au groupe



     public function liste_descourrierenAffecteAuGroupe()

    {

       

        if(isset(Auth::user()->id))

        {

           

          

            if((Auth::user()->groupe_id>=1))

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'affecter_groupe')
         ->join('priorites','priorites.id', "=",'courriers.id_priorite') 
        ->join('couleurs','couleurs.id', "=",'priorites.id_couleur') 


         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation', 'affectations.date_affectationManager', 'commentaire','sigle','courriers.id','file_path', 'id_priorite','couleur_name', 'priorite_name','affecter_groupe','direction_affectation' )

           

         ->where('affecter_groupe',Auth::user()->groupe_id)

        ->where('statut_courrier','Affecté')

         ->get();

           $courrierEnAttenteTraites=$courriers;

          

         return view('courriers.liste_courrier_affecterUser',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

            }

         }

      else

        {

             return view('auth.login'); 

        }

    }

public function liste_descourrierTraiteAuGroupe()

    {

       

        if(isset(Auth::user()->id))

        {

           

          

            if((Auth::user()->groupe_id>=1))

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



           $courriers =  DB::table('courriers')

         ->join('reponses', 'courriers.id', '=', 'courier_id')

         ->join('departements', 'departements.id', '=', 'reponses.direction_id')

         ->join('users', 'users.id', '=', 'reponses.user_id')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'date_reponse','commentaire','commentaireReponse','sigle','name','courriers.id','affectations.date_affectation', 'affectations.date_affectationManager' )

         ->where('courrier_etat','Traité')

          ->where('affecter_groupe',Auth::user()->groupe_id)

         ->get();

 $courrierEnAttenteTraites=$courriers;

          

          

        return view('courriers.liste_courrier_traite',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
            }

         }

      else

        {

             return view('auth.login'); 

        }

    }





   public function liste_descourrierenAffecte()

    {

       

        if(isset(Auth::user()->id))

        {

           

           if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==4)||(Auth::user()->user_role==8))

           { 

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' ,'id_priorite','affecter_groupe','direction_affectation')
         ->where('statut_courrier','Affecté')
        ->where('categorieCourrier','Autres')->get();



          $courrierEnAttenteTraites=$courriers;
             
  $courrierGroupes =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('groupes', 'groupes.id', '=', 'affecter_groupe')
          
        
        ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom_groupe','courriers.id', 'affectations.date_affectationManager' ,'id_priorite','affecter_groupe','direction_affectation')
         ->where('statut_courrier','Affecté')
        ->where('categorieCourrier','Autres')->get();

         

          
         return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites, 'courrierGroupes'=>$courrierGroupes]);

           }

//            if((Auth::user()->user_role==3))

//            {

//                 $courrierAttentes= Courrier::where('courrier_etat','attente')

//                  ->get();



//           $courriers =  DB::table('courriers')

//          ->join('affectations', 'courriers.id', '=', 'courrier_id')

//          ->join('departements', 'departements.id', '=', 'direction_affectation')

//          ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id', 'affectations.date_affectationManager', 'id_priorite','affecter_groupe','direction_affectation' )

         

//          ->where('courriers.courrier_etat','Affecté')
//           ->where('direction_affectation',Auth::user()->departement_id)


//          ->get();



//           $courrierEnAttenteTraites=$courriers;

         


// return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

        

//            }

           if((Auth::user()->user_role==4))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

                 ->get();



          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' ,'id_priorite','affecter_groupe','direction_affectation')

         

         ->where('courriers.courrier_etat','Affecté')->get();



          $courrierEnAttenteTraites=$courriers;

return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

        

           }

            if((Auth::user()->user_role==5)||(Auth::user()->user_role==3))

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager','id_priorite','affecter_groupe','direction_affectation' )

         ->where('statut_courrier','Affecté')

         ->where('direction_affectation',Auth::user()->departement_id)

         ->get();
          $courrierpartagers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager','id_priorite','affecter_groupe','direction_affectation' )

         ->where('statut_courrier','Affecté')

         ->where('partage_courrier',Auth::user()->departement_id)

         ->get();

 $courrierEnAttenteTraites=$courriers;

          

         return view('courriers.liste_courrier_affecterUser',['courriers'=>$courriers,'courrierpartagers'=>$courrierpartagers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

            }



 



            

            if((Auth::user()->user_role==6))

            {



                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' ,'id_priorite','affecter_groupe','direction_affectation')

         ->where('statut_courrier','Trasmis')

         ->where('direction_affectation',Auth::user()->departement_id)


         ->get();

      $courrierEnAttenteTraites=$courriers;

          

         return view('courriers.liste_courrier_affecterUser',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

            }

            if((Auth::user()->user_role==7))

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->join('users', 'users.id', '=', 'user_affecter')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','name','courriers.id', 'affectations.date_affectationManager','id_priorite','affecter_groupe','direction_affectation' )

         ->where('statut_courrier','Trasmis')

         ->where('direction_affectation',Auth::user()->departement_id)

         ->get();

 $courrierEnAttenteTraites=$courriers;

          

         return view('courriers.liste_courrier_affecterUser',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

            }

         }

      else

        {

             return view('auth.login'); 

        }

    }












public function DetailcourrierenTraite($id)

    {

       

        if(isset(Auth::user()->id))

        {

           if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8)||(Auth::user()->user_role==9))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



         $courrierEnAttenteTraites =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

         ->where('statut_courrier','Affecté')->get();



           }

           if((Auth::user()->user_role==3))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites=  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

        

 

         ->where('statut_courrier','Affecté')->get();



          

            }

            if((Auth::user()->user_role==4))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites=  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

         

 

         ->where('statut_courrier','Affecté')->get();



          

            }

            if((Auth::user()->user_role==5))

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

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

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

          ->where('statut_courrier','Trasmis')

           ->where('direction_affectation',Auth::user()->departement_id)

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

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','name','courriers.id', 'affectations.date_affectationManager' )

         ->where('statut_courrier','Trasmis')

         ->where('direction_affectation',Auth::user()->departement_id)

        

         ->get();



          

         

            }



             // MENU

            $courriersA = Affectation::where('courrier_id',$id)

        ->get();

        //    foreach ($courriersA as $courriers) { 

        //      if($courriers->affecter_groupe==Auth::user()->groupe_id)

        //   {

        //     $valC=$courriers->statut_courrier;

        //     $courriers =  DB::table('courriers')

        //  ->join('affectations', 'courriers.id', '=', 'courrier_id')

        //  ->join('groupes', 'groupes.id', '=', 'affecter_groupe')

        //   ->join('users', 'users.id', '=', 'user_affecter')

        //   ->join('reponses', 'courriers.id', '=', 'courier_id')

        //   ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaireReponse','nom_groupe','users.name' ,'file_path','commentaireRelance','courriers.id','courrier_id','commentaire_manager','document','commentaire')

        //  ->where('courrier_etat','Traité')

        //  ->where('courriers.id',$id)->get();



        //    return view('reponse_courriers.detail_traitement_courrier',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

        //   }



        // }



    

           if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8)||(Auth::user()->user_role==9))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

        ->join('reponses', 'courriers.id', '=', 'courier_id')

        ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->join('users', 'users.id', '=', 'user_affecter')

         ->select('objet','reference', 'numero' ,'type_courrier','direction_affectation', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaireReponse','sigle','users.name' ,'file_path','commentaireRelance','courriers.id','courrier_id','commentaire_manager','document','commentaire', 'affectations.date_affectationManager')

         ->where('courrier_etat','Traité')

         ->where('courriers.id',$id)->get();


           foreach ($courriers as $courrier) { 

           if($courrier->direction_affectation>0)
          {
		             
        return view('reponse_courriers.detail_traitement_courrier',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
          }
          else
          {
		
            return redirect()->route('detailCourriertraiteGroupe', ['id' => $id]);


          }
        }
          

       
           }

             if(Auth::user()->user_role==3)

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

        ->join('reponses', 'courriers.id', '=', 'courier_id')

        ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->join('users', 'users.id', '=', 'user_affecter')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaireReponse','sigle','users.name' ,'file_path','commentaireRelance','courriers.id','courrier_id','commentaire_manager','document','commentaire', 'affectations.date_affectationManager')

         ->where('courrier_etat','Traité')

        

         ->where('courriers.id',$id)->get();



          

         return view('reponse_courriers.detail_traitement_courrier',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

           }

             if(Auth::user()->user_role==4)

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

        ->join('reponses', 'courriers.id', '=', 'courier_id')

        ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->join('users', 'users.id', '=', 'user_affecter')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaireReponse','sigle','users.name' ,'file_path','commentaireRelance','courriers.id','courrier_id','commentaire_manager','document','commentaire', 'affectations.date_affectationManager')

         ->where('courrier_etat','Traité')

         

         ->where('courriers.id',$id)->get();



          

         return view('reponse_courriers.detail_traitement_courrier',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

           }

 if(Auth::user()->user_role==6)

  {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

        ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('reponses', 'courriers.id', '=', 'courier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->join('users', 'users.id', '=', 'reponses.user_id')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaireReponse','sigle','courriers.id','file_path','commentaireRelance','courrier_id','commentaire_manager','document','commentaire','name', 'affectations.date_affectationManager' )

         ->where('courrier_etat','Traité')

          ->where('direction_affectation',Auth::user()->departement_id)

          ->where('courriers.id',$id)

         ->get();



          

        return view('reponse_courriers.detail_traitement_courrier',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

            }

            else

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

        ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('reponses', 'courriers.id', '=', 'courier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->join('users', 'users.id', '=', 'user_affecter')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaireReponse','sigle','name','courriers.id','file_path','commentaireRelance','courrier_id','commentaire_manager','document','commentaire', 'affectations.date_affectationManager' )

         ->where('courrier_etat','Traité')

         ->where('direction_affectation',Auth::user()->departement_id)

        

          ->where('courriers.id',$id)

         ->get();



          

        return view('reponse_courriers.detail_traitement_courrier',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

            }

         }

      else

        {

             return view('auth.login'); 

        }

    }


public function DetailcourrierenTraiteGroupe($id)
    {
       
        if(isset(Auth::user()->id))
        {
           if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==4)||(Auth::user()->user_role==8))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courrierEnAttenteTraites =  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )
         ->where('statut_courrier','Affecté')->get();

           }
           if((Auth::user()->user_role==3))
           {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites=  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id' )
         // ->where('visibleDGA','visible')
 
         ->where('statut_courrier','Affecté')->get();

          
            }
            if((Auth::user()->user_role==5))
            {
                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

          $courrierEnAttenteTraites =  DB::table('courriers')
         ->join('affectations', 'courriers.id', '=', 'courrier_id')
         ->join('departements', 'departements.id', '=', 'direction_affectation')
         
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )
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
         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','name','courriers.id', 'affectations.date_affectationManager' )
         ->where('statut_courrier','Trasmis')
         ->where('direction_affectation',Auth::user()->departement_id)
         ->where('user_affecter',Auth::user()->id)
         ->get();

          
         
            }
//MENU


                $courrierAttentes= Courrier::where('courrier_etat','attente')
         ->get();

         $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('groupes', 'groupes.id', '=', 'affecter_groupe')

          ->join('reponses', 'courriers.id', '=', 'courier_id')
          ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaireReponse','nom_groupe','users.name' ,'file_path','commentaireRelance','courriers.id','courrier_id','commentaire_manager','document','commentaire', 'affectations.date_affectationManager')
         ->where('courrier_etat','Traité')

         ->where('courriers.id',$id)->get();

           return view('reponse_courriers.detail_traitement_courrier',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);
          
         }
      else
        {
             return view('auth.login'); 
        }
    }




public function liste_descourrierenTraite()

    {

       

        if(isset(Auth::user()->id))

        {

          if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8)||(Auth::user()->user_role==9))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



         $courrierEnAttenteTraites =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

         ->where('statut_courrier','Affecté')->get();



           }

           if((Auth::user()->user_role==3))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites=  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

        

         ->where('statut_courrier','Affecté')->get();



          

            }

            if((Auth::user()->user_role==4))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites=  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

         

        ->where('statut_courrier','Affecté')->get();



          

            }

            if((Auth::user()->user_role==5))

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

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

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

           ->where('statut_courrier','Affecté')

           ->where('direction_affectation',Auth::user()->departement_id)

         ->get();



          

         

            }

            //MENU

           if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8)||(Auth::user()->user_role==9))

           {

$nbrcourrierAttenteTraiteAutre= Courrier::where('courrier_etat','Affecté')
          ->where('categorieCourrier','Autres')
          ->get();
          $nbrcourrierAttenteTraitePresidence=Courrier::where('courrier_etat','Affecté')
          ->where('categorieCourrier','Présidence')
          ->get();
          $nbrcourrierAttenteTraiteMini=Courrier::where('courrier_etat','Affecté')
          ->where('categorieCourrier','Minier')
          ->get();

          $nbrcourrierAttenteAutre= Courrier::where('courrier_etat','attente')
          ->where('categorieCourrier','Autres')
          ->get();
          $nbrcourrierAttentePresidence=Courrier::where('courrier_etat','attente')
          ->where('categorieCourrier','Présidence')
          ->get();
          $nbrcourrierAttenteMini=Courrier::where('courrier_etat','attente')
          ->where('categorieCourrier','Minier')
          ->get();

          $nbrcourrierAutre=Courrier::where('categorieCourrier','Autres')
          ->get();
           $nbrcourrierPresidence=Courrier::where('categorieCourrier','Présidence')
          ->get();
          $nbrcourrierMini=Courrier::where('categorieCourrier','Minier')
          ->get();


                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('reponses', 'courriers.id', '=', 'courier_id')

         ->join('departements', 'departements.id', '=', 'reponses.direction_id')

         ->join('users', 'users.id', '=', 'reponses.user_id')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'date_reponse','commentaire','commentaireReponse','sigle','name','courriers.id','affectations.date_affectation', 'affectations.date_affectationManager' )

         ->where('courrier_etat','Traité')

          ->orderBy('date_reponse', 'ASC')

         ->get();



          $courrierTraiter=$courriers;

         return view('courriers.liste_courrier_traite',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierTraiter'=>$courrierTraiter,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites,'nbrcourrierAttenteAutre'=>$nbrcourrierAttenteAutre,'nbrcourrierAttentePresidence'=>$nbrcourrierAttentePresidence,'nbrcourrierAttenteMini'=>$nbrcourrierAttenteMini,'nbrcourrierAutre'=>$nbrcourrierAutre,'nbrcourrierPresidence'=>$nbrcourrierPresidence,'nbrcourrierMini'=>$nbrcourrierMini,'nbrcourrierAttenteTraiteAutre'=>$nbrcourrierAttenteTraiteAutre,'nbrcourrierAttenteTraitePresidence'=>$nbrcourrierAttenteTraitePresidence,'nbrcourrierAttenteTraiteMini'=>$nbrcourrierAttenteTraiteMini]);

           }

           if((Auth::user()->user_role==7))

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



         $courrierEnAttenteTraites=  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->join('users', 'users.id', '=', 'user_affecter')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','name','courriers.id', 'affectations.date_affectationManager' )

         ->where('statut_courrier','Trasmis')

         ->where('direction_affectation',Auth::user()->departement_id)

        ->distinct()

         ->get();



          

         

            }



            if((Auth::user()->user_role==5)||(Auth::user()->user_role==7))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('reponses', 'courriers.id', '=', 'courier_id')

         ->join('departements', 'departements.id', '=', 'reponses.direction_id')

         ->join('users', 'users.id', '=', 'reponses.user_id')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'date_reponse','commentaire','commentaireReponse','sigle','name','courriers.id','affectations.date_affectation', 'affectations.date_affectationManager' )

         ->where('courrier_etat','Traité')

          ->where('direction_affectation',Auth::user()->departement_id)

          ->distinct()

         ->get();



           $courrierTraiter=$courriers;

         return view('courriers.liste_courrier_traite',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierTraiter'=>$courrierTraiter,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

           }

            if((Auth::user()->user_role==3))

            {

             $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('reponses', 'courriers.id', '=', 'courier_id')

         ->join('departements', 'departements.id', '=', 'reponses.direction_id')

         ->join('users', 'users.id', '=', 'reponses.user_id')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'date_reponse','commentaire','commentaireReponse','sigle','name','courriers.id','affectations.date_affectation', 'affectations.date_affectationManager' )

         ->where('courrier_etat','Traité')
          ->where('direction_affectation',Auth::user()->departement_id)

          

           ->distinct()

         ->get();

 $courrierTraiter=$courriers;

          

         return view('courriers.liste_courrier_traite',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierTraiter'=>$courrierTraiter,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

           

            }

            if((Auth::user()->user_role==4))

            {

                      $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('reponses', 'courriers.id', '=', 'courier_id')

         ->join('departements', 'departements.id', '=', 'reponses.direction_id')

         ->join('users', 'users.id', '=', 'reponses.user_id')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'date_reponse','commentaire','commentaireReponse','sigle','name','courriers.id','affectations.date_affectation', 'affectations.date_affectationManager' )

         ->where('courrier_etat','Traité')

           

  

         ->get();

 $courrierTraiter=$courriers;

          

         return view('courriers.liste_courrier_traite',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierTraiter'=>$courrierTraiter,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

           

            }

            if((Auth::user()->user_role==6))

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('reponses', 'courriers.id', '=', 'courier_id')

         ->join('departements', 'departements.id', '=', 'reponses.direction_id')

        

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'date_reponse','commentaire','commentaireReponse','sigle','courriers.id','affectations.date_affectation', 'affectations.date_affectationManager' )

         ->where('courrier_etat','Traité')

           ->where('user_affecter',Auth::user()->id)

         ->get();

 $courrierTraiter=$courriers;

          

          

         return view('courriers.liste_courrier_traiteUser',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierTraiter'=>$courrierTraiter,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

            }

         }

      else

        {

             return view('auth.login'); 

        }

    }



     public function liste_descourrierenAttente()

    {

       

        if(isset(Auth::user()->id))

        {

          if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8)||(Auth::user()->user_role==9))

           { 

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



         $courrierEnAttenteTraites =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

         ->where('statut_courrier','Affecté')->get();



           }

           if((Auth::user()->user_role==3))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites=  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

        

 

         ->where('statut_courrier','Affecté')->get();



          

            }

            if((Auth::user()->user_role==4))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites=  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

         

 

         ->where('statut_courrier','Affecté')->get();



          

            }

            if((Auth::user()->user_role==5)||(Auth::user()->user_role==7))

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

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

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

            ->where('statut_courrier','Affecté')

           ->where('direction_affectation',Auth::user()->departement_id)

         ->get();



          

         

            }

           $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();
$categorie="Autres";
          $courriers= Courrier::where('courrier_etat','attente')
          ->where('categorieCourrier','Autres')
          ->get();

          $nbrcourrierAttenteAutre= Courrier::where('courrier_etat','attente')
          ->where('categorieCourrier','Autres')
          ->get();
          $nbrcourrierAttentePresidence=Courrier::where('courrier_etat','attente')
          ->where('categorieCourrier','Présidence')
          ->get();
          $nbrcourrierAttenteMini=Courrier::where('courrier_etat','attente')
          ->where('categorieCourrier','Minier')
          ->get();

          $nbrcourrierAutre=Courrier::where('categorieCourrier','Autres')
          ->get();
           $nbrcourrierPresidence=Courrier::where('categorieCourrier','Présidence')
          ->get();
          $nbrcourrierMini=Courrier::where('categorieCourrier','Minier')
          ->get();

$nbrcourrierAttenteTraiteAutre= Courrier::where('courrier_etat','Affecté')
          ->where('categorieCourrier','Autres')
          ->get();
          $nbrcourrierAttenteTraitePresidence=Courrier::where('courrier_etat','Affecté')
          ->where('categorieCourrier','Présidence')
          ->get();
          $nbrcourrierAttenteTraiteMini=Courrier::where('courrier_etat','Affecté')
          ->where('categorieCourrier','Minier')
          ->get();

         return view('courriers.liste_courrier_attente',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites,'categorie'=>$categorie,'nbrcourrierAttenteAutre'=>$nbrcourrierAttenteAutre,'nbrcourrierAttentePresidence'=>$nbrcourrierAttentePresidence,'nbrcourrierAttenteMini'=>$nbrcourrierAttenteMini,'nbrcourrierAutre'=>$nbrcourrierAutre,'nbrcourrierPresidence'=>$nbrcourrierPresidence,'nbrcourrierMini'=>$nbrcourrierMini
          ,'nbrcourrierAttenteTraiteAutre'=>$nbrcourrierAttenteTraiteAutre,'nbrcourrierAttenteTraitePresidence'=>$nbrcourrierAttenteTraitePresidence,'nbrcourrierAttenteTraiteMini'=>$nbrcourrierAttenteTraiteMini]);

         }

      else

        {

             return view('auth.login'); 

        }

    }

 

 

      public function liste_descourrierenAttenteCollaborateur()

    {

       

        if(isset(Auth::user()->id))

        {

           if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8)||(Auth::user()->user_role==9))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



         $courrierEnAttenteTraites =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

         ->where('statut_courrier','Affecté')->get();



           }

         //   if((Auth::user()->user_role==3))

         //   {

         //        $courrierAttentes= Courrier::where('courrier_etat','attente')

         // ->get();



         //  $courrierEnAttenteTraites=  DB::table('courriers')

         // ->join('affectations', 'courriers.id', '=', 'courrier_id')

         // ->join('departements', 'departements.id', '=', 'direction_affectation')

         // ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id', 'affectations.date_affectationManager' )

        

 

         // ->where('statut_courrier','Affecté')->get();



          

         // return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

         //   }

           if((Auth::user()->user_role==4))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites=  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

         

 

         ->where('statut_courrier','Affecté')->get();



          

         return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

           }

            if((Auth::user()->user_role==5)||(Auth::user()->user_role==3))

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

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

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

            ->where('statut_courrier','Affecté')

           ->where('direction_affectation',Auth::user()->departement_id)

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

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','name','courriers.id', 'affectations.date_affectationManager' )

         ->where('statut_courrier','Trasmis')

         ->where('direction_affectation',Auth::user()->departement_id)

         ->get();



          

         

            }

           $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



         $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->join('users', 'users.id', '=', 'user_affecter')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','name','courriers.id', 'affectations.date_affectationManager' )

         ->where('statut_courrier','Trasmis')

         ->where('direction_affectation',Auth::user()->departement_id)

         ->get();



         return view('courriers.liste_niveau_manager',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

         }

      else

        {

             return view('auth.login'); 

        }

    }



     public function liste_descourrierenArrive()

    {

       

        if(isset(Auth::user()->id))

        {

          if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8)||(Auth::user()->user_role==9))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



         $courrierEnAttenteTraites =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

         ->where('statut_courrier','Affecté')->get();



           }

           if((Auth::user()->user_role==3))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites=  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

 

         ->where('statut_courrier','Affecté')->get();



          

           }

              if((Auth::user()->user_role==4))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites=  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

         

 

         ->where('statut_courrier','Affecté')->get();



          

           }

            if((Auth::user()->user_role==5))

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

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

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

         ->where('statut_courrier','Affecté')

           ->where('direction_affectation',Auth::user()->departement_id)

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

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','name','courriers.id', 'affectations.date_affectationManager' )

         ->where('statut_courrier','Trasmis')

         ->where('direction_affectation',Auth::user()->departement_id)

    

         ->get();



          

         

            }
//Menu
          $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();

          if((Auth::user()->user_role==1)||(Auth::user()->user_role==2))

          {

             $courriers= Courrier::where('type_courrier','arrivée')

        ->get();

            
          return view('courriers.liste_courrier_arrive',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

         }

         if((Auth::user()->user_role==8))

         { $courriers= Courrier::where('type_courrier','arrivée')
              ->where('categorieCourrier','Autres')
            ->get();

          return view('courriers.liste_courrier_arriveDga',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

         }
              if((Auth::user()->user_role==9))

         {

           $courriers= Courrier::where('type_courrier','arrivée')
            ->where('categorieCourrier','Présidence')
             ->Orwhere('categorieCourrier','Minier')
            ->get();

          return view('courriers.liste_courrier_arriveDga',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

         }

         if((Auth::user()->user_role==3))

         {

           $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','courrier_id','commentaire','sigle','affectations.id','file_path','commentaireRelance','courrier_etat', 'affectations.date_affectationManager' )


 ->get();

          return view('courriers.liste_courrier_arriveDga',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

         }

          if((Auth::user()->user_role==4))

         {
             $courriers= Courrier::where('type_courrier','arrivée')

        ->get();

          return view('courriers.liste_courrier_arrive',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

         }

        

        

         }

      else

        {

             return view('auth.login'); 

        }

    }
    
     

    public function liste_descourrierenDepart()

    {

       

        if(isset(Auth::user()->id))

        {

          if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8)||(Auth::user()->user_role==9)||(Auth::user()->user_role==4)||(Auth::user()->user_role==3))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



         $courrierEnAttenteTraites =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

         ->where('statut_courrier','Affecté')->get();



           }
//DGA 3 if((Auth::user()->user_role==3))
           if((Auth::user()->user_role==10))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites=  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

        

 

         ->where('statut_courrier','Affecté')->get();



          

         return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

           }

         //   if((Auth::user()->user_role==4))

         //   {

         //        $courrierAttentes= Courrier::where('courrier_etat','attente')

         // ->get();



         //  $courrierEnAttenteTraites=  DB::table('courriers')

         // ->join('affectations', 'courriers.id', '=', 'courrier_id')

         // ->join('departements', 'departements.id', '=', 'direction_affectation')

         // ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )

         

 

         // ->where('statut_courrier','Affecté')->get();



          

         // return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

         //   }

            if((Auth::user()->user_role==5))

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

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

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

           ->where('statut_courrier','Affecté')

           ->where('direction_affectation',Auth::user()->departement_id)

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

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','name','courriers.id', 'affectations.date_affectationManager' )

         ->where('statut_courrier','Trasmis')

         ->where('direction_affectation',Auth::user()->departement_id)

     

         ->get();



          

         

            }

          $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();

 // $courriers= Courrier::where('type_courrier','depart')

         // $rapport = DB::table('rapports')->where('supprimer',0)->orderBY('id','DESC')->get();

         // $courriers = DB::select('SELECT * from users');
           $courriers = DB::select("SELECT c.*, d.sigle
FROM courriers c left JOIN departements d ON c.direction_suivie = d.id
WHERE type_courrier='Départ' ");

          // $courriers = DB::table('courriers')
           
          //   ->join('departements','departements.id', "=",'courriers.direction_suivie')

             

          //    ->select('courriers.*', 'departements.sigle')

          //    ->where('type_courrier','depart')
          //    ->get();


              if((Auth::user()->user_role==5)||(Auth::user()->user_role==3)||(Auth::user()->user_role==7))
            {

         $courriers = DB::table('courriers')
           
            ->join('departements','departements.id', "=",'courriers.direction_suivie')
             ->select('courriers.*', 'departements.sigle')

             ->where('type_courrier','depart')
             ->where('direction_suivie',Auth::user()->departement_id)
             ->get();

         }

         

         return view('courriers.liste_courrier_depart',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

         }

      else

        {

             return view('auth.login'); 

        }

    }



     public function detailCourrierA($id)

    { if(isset(Auth::user()->id))
      {


      $courriers= DB::table('courriers')
       
       ->join('users','users.id', "=",'courriers.user_id') 
       ->select('courriers.*', 'name')
       ->where('courriers.id',$id)
       ->get();
  

        foreach ($courriers as $key => $value) {

        if($value->type_courrier=='Départ')

        {

          return view('courriers.detail_courrier_depart',['courriers'=>$courriers]);

        }

        else

        {

           return view('courriers.detail_courrier',['courriers'=>$courriers]);

        }

       }

 



       

        }

      else

        {

             return view('auth.login');  

        }

    }

 public function dechargeCourrierDepart($id)

    { if(isset(Auth::user()->id))

        {

          if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8)||(Auth::user()->user_role==4))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



         $courrierEnAttenteTraites =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

         ->where('statut_courrier','Affecté')->get();



           }

           if((Auth::user()->user_role==3))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites=  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' )

        

 

         ->where('statut_courrier','Affecté')->get();



          

         return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

           }

         //   if((Auth::user()->user_role==4))

         //   {

         //        $courrierAttentes= Courrier::where('courrier_etat','attente')

         // ->get();



         //  $courrierEnAttenteTraites=  DB::table('courriers')

         // ->join('affectations', 'courriers.id', '=', 'courrier_id')

         // ->join('departements', 'departements.id', '=', 'direction_affectation')

         // ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )

         

 

         // ->where('statut_courrier','Affecté')->get();



          

         // return view('courriers.liste_courrier_affecter',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

         //   }

            if((Auth::user()->user_role==5))

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id', 'affectations.date_affectationManager' )

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

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id', 'affectations.date_affectationManager' )

           ->where('statut_courrier','Affecté')

           ->where('direction_affectation',Auth::user()->departement_id)

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

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','name','courriers.id', 'affectations.date_affectationManager' )

         ->where('statut_courrier','Trasmis')

         ->where('direction_affectation',Auth::user()->departement_id)

         ->get();



          

         

            }

            $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



        $courriers = Courrier::where('id',$id)

        ->get();   

        return view('dechargeCourrier.enregistrement_decharge',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

        }

      else

        {

             return view('auth.login');  

        }

    }

    



    public function SauvegardeDecharge(Request $request)

    {  $fichierName = $request->file_path->getClientOriginalName();



         $request->file_path->move(public_path('/documents/decharges'), $fichierName);



        $updAffectation = Courrier::findOrFail($request->id);

        $updAffectation->update(['courrier_etat'=>"decharge",'date_traitement'=>date("Y-m-d H:i:s"),'fichierDecharge'=>$request->file_path->getClientOriginalName(),'commentaireDecharge'=>$request->editor3]);



        $courriers=Courrier::where('id',$request->id)->get();

        $responsables=User::where('user_role',2)->get();





          foreach ($responsables as $responsable) {

           $emailresponsable=$responsable->email;

            $postresponsable=$responsable->user_role;

              

          }

foreach ($courriers as $key => $value) {

          $objet=$value->objet;

          $reference=$value->reference;

          $destinataire=$value->destinataire;

          $file_path=$value->file_path;

          $type_courrier=$value->type_courrier;

          $lien="http://mtp.inektogec.com/";

}



  //Mail::to($emailresponsable)->send(new MailDechargerCourrier($objet,$reference, $destinataire,$type_courrier,$file_path,$lien,$postresponsable));



        return redirect()->route('listeCourrierDepart')->with('success', 'Décharge enregistrer avec succées');

        

    }



 

 public function liste_descourrierenAffecteurge()

    {
      if(isset(Auth::user()->id))

        {

      if((Auth::user()->user_role==3))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

                 ->get();



          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id', 'affectations.date_affectationManager', 'id_priorite','affecter_groupe' )

         

         ->where('courriers.courrier_etat','Affecté')
          ->where('direction_affectation',Auth::user()->departement_id)
          ->where('courriers.id_priorite','1')

          
         ->get();



          $courrierEnAttenteTraites=$courriers;

          return view('courriers.listeurgent_courrier_affecte',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

        

           }



   if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==4)||(Auth::user()->user_role==8))

           { 

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' ,'id_priorite','affecter_groupe')
         ->where('statut_courrier','Affecté')
        ->where('categorieCourrier','Autres')
        ->where('courriers.id_priorite','1')

        ->get();



          $courrierEnAttenteTraites=$courriers;  

          $courrierGroupes =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('groupes', 'groupes.id', '=', 'affecter_groupe')
          
        
        ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom_groupe','courriers.id', 'affectations.date_affectationManager' ,'id_priorite','affecter_groupe','direction_affectation')
         ->where('statut_courrier','Affecté')
        ->where('categorieCourrier','Autres')
        ->where('courriers.id_priorite','1')
        ->get();

 return view('courriers.listeurgent_courrier_affecte',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites, 'courrierGroupes'=>$courrierGroupes]);
             

}
       
        
          if((Auth::user()->user_role==5))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

                 ->get();



          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' ,'id_priorite','affecter_groupe')

         

         ->where('statut_courrier','Affecté')
         ->where('direction_affectation',Auth::user()->departement_id)
         ->where('courriers.id_priorite','1')

         ->get();



          $courrierEnAttenteTraites=$courriers;

            $courrierGroupes =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('groupes', 'groupes.id', '=', 'affecter_groupe')
          
        
        ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom_groupe','courriers.id', 'affectations.date_affectationManager' ,'id_priorite','affecter_groupe','direction_affectation')
         ->where('statut_courrier','Affecté')
        ->where('categorieCourrier','Autres')
        ->where('courriers.id_priorite','1')
        ->get();

return view('courriers.listeurgent_courrier_affecte',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites,'courrierGroupes'=>$courrierGroupes]);
        

           }

if((Auth::user()->user_role==6))

            {



                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','sigle','courriers.id', 'affectations.date_affectationManager' ,'id_priorite','affecter_groupe')

         ->where('statut_courrier','Trasmis')

         ->where('direction_affectation',Auth::user()->departement_id)
         ->where('courriers.id_priorite','1')


         ->get();

      $courrierEnAttenteTraites=$courriers;

      return view('courriers.listeurgent_courrier_affecte',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

        

           }


   
           } 
} 



//fin menu direction

}

