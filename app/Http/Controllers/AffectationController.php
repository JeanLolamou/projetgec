<?php



namespace App\Http\Controllers;

use DB;
use App\User;

use Illuminate\Http\Request;
use App\Models\Priorite;
use App\Courrier;

use App\Reponse;

use App\Departement;

use App\Affectation;

use App\Annotationtype;

use App\Service;

use App\Groupe;

use Mail;

use App\Mail\Envoimail;

use App\Mail\MailReponseCourrierDestinateur;

use Illuminate\Support\Facades\Auth;

use App\Mail\MailEnregistrementCourrier;

use App\Mail\MailAnotationCourrier;

use App\Mail\MailTraiteCourrier;

use App\Mail\MailAnotationCourrierGroupe;







class AffectationController extends Controller

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

 



  public function employe()

  {

   $parent_id =4;

     $utilisateurs=User::where('departement_id',$parent_id)->where('user_statut','=',1)->get();

     return response()->json(['utilisateurs'=>$utilisateurs]);



  } 



    public function store(Request $request)

    { $noms;

      $emails;

        $emaildgas;

            $nomdgas;

            $utilisateurDGAs;

            $VisibleSg;

            $VisibleCfc;







        if($request->courrierVdepartement=='')

       {

        $VisibleCservice="invisible";

       }

       else

       {

       $VisibleCservice=$request->courrierVdepartement;

       } 

        if($request->courrierVcfc=='')

       {

        $VisibleCfc="invisible";

       }

       else

       {

       $VisibleCfc=$request->courrierVcfc;

       }



       if($request->courrierVsg=='')

       {

        $VisibleSg="invisible";

       }

       else

       {

        $VisibleSg=$request->courrierVsg;

       }

if($request->direction==2)

      {

         $VisibleSg="visible";

      }

      if($request->direction==3)

      {

         $VisibleCfc="visible";

      }

      if(($request->direction<1) AND ($request->groupe<1) )

      {

        return back()->with('errore', 'Choisir une Direction ou un Groupe à annoter');

       

      }

      else{





     $direction=0;

      if($request->direction>=1)

      {

         $direction=$request->direction;



         

      }

      

       $service=0;

      if($request->service>=1)

      {

         $service=$request->service;

       

      }

        $groupe=0;

      if($request->groupe>=1)

      {

         $groupe=$request->groupe;

       

      }

       $encopie=$request->encopie;

      if($request->encopie>0)

      {

         $encopie=$request->encopie;

       

      }
      $employe=0;

      if($request->employe>=1)

      {

         $useraffecter=$request->employe;

        $statutCourrier="Trasmis";

      }


 }

       if(Auth::user()->user_role==3)

            {

               $VisibleCfc="visible";

            }

            if(Auth::user()->user_role==4)

            {

                $VisibleSg="visible";

            }

            
if(Auth::user()->user_role==3)
{
  // var_dump($request->direct);die();
  $courrierAff=Affectation::where('courrier_id','=',$request->id)->get();
  foreach ($courrierAff as $key => $value) {
   $id_affect=$value->id;
  }

  $courrier = Affectation::findOrFail($id_affect);
        $courrier->update(['user_dga'=>Auth::user()->id,'date_affectationdga'=>date("Y-m-d H:i:s"),'direction_affectation'=> $direction,'statut_courrier'=>'Affecté','affecter_groupe'=>$groupe,'commentaire_dga'=>$request->commentaire,'user_affecter'=>$request->employe]);
        // , 'user_affecter'=>$request->collaborateur
        // 'service_affecte'=>$service,'date_affecter_service'=>date("Y-m-d H:i:s"),


          $courriers=Courrier::where('id',$request->courrier_id)->get();
if($request->employe>=1)
{
  $utilisateurs=User::where('id',$request->employe)

       ->get();



        foreach ($utilisateurs as $key => $value) {

            $emails=$value->email;

            $noms=$value->name;

         }
}
}
if(Auth::user()->user_role==4)
{
  $courrierAff=Affectation::where('courrier_id','=',$request->id)->get();
  foreach ($courrierAff as $key => $value) {
   $id_affect=$value->id;
  }

 $courrier = Affectation::findOrFail($id_affect);
        $courrier->update(['user_sg'=>Auth::user()->id,'date_affectationsg'=>date("Y-m-d H:i:s"),'direction_affectation'=> $direction,'commentaireSg'=>$request->commentaire,'statut_courrier'=>'Affecté','service_affecte'=>$service,'date_affecter_service'=>date("Y-m-d H:i:s"),'affecter_groupe'=>$groupe]);
}


// if(isset($encopie)){


// foreach ($encopie as $value) {
  
if((Auth::user()->user_role==2)||(Auth::user()->user_role==8)){
     $courrier = Affectation::create(['user_dg'=>Auth::user()->id,'courrier_id'=>$request->id,'date_affectation'=>date("Y-m-d H:i:s"),'direction_affectation'=> $direction,'lu'=>"non",'commentaire'=>$request->commentaire,'statut_courrier'=>'Affecté','affecter_groupe'=>$groupe]);

  
  }
  


        $updAffectation = Courrier::findOrFail($request->id);

        $updAffectation->update(['courrier_etat'=>"Affecté",'date_affectation'=>date("Y-m-d H:i:s"),'id_priorite'=>$request->priorite]);



        $commentaire=$request->commentaire;


        $courriers=Courrier::where('id',$request->id)->get();

        foreach ($courriers as $key => $value) {

          $objet=$value->objet;


          $reference=$value->reference;

          $destinataire=$value->destinataire;

          $file_path=$value->file_path;

          $type_courrier=$value->type_courrier;

          $lien="http://gec.apipguinee.com/";

}

        if($request->courrierVsg=="visible")

        {

          $utilisateurSGs=User::where('user_role',4)

        ->get();

        $utilisateurs=User::where('departement_id',$request->direction)

        ->where('user_role',5)
        ->where('user_role',3)

        ->Orwhere('user_role',4)

        ->get();

         foreach ($utilisateurs as $key => $value) {

            $emails=$value->email;

            $noms=$value->name;

         }

           foreach ($utilisateurSGs as $key => $value) {

            $emailsgs=$value->email;

            $nomsgs=$value->name;

         }

Mail::to($emailsgs)->send(new MailAnotationCourrier($nomsgs,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien));

  Mail::to($emails)->send(new MailAnotationCourrier($noms,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien));

       }

       else if($request->courrierVcfc=="visible")

        {

          $utilisateurCfcs=User::where('user_role',3)

        ->get();

        $utilisateurs=User::where('departement_id',$request->direction)

        ->where('user_role',5)

        ->Orwhere('user_role',3)

        ->get();

         foreach ($utilisateurs as $key => $value) {

            $emails=$value->email;

            $noms=$value->name;

         }

           foreach ($utilisateurCfcs as $key => $value) {

            $emailcfcs=$value->email;

            $nomcfcs=$value->name;

         }

Mail::to($emailcfcs)->send(new MailAnotationCourrier($nomcfcs,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien));

  Mail::to($emails)->send(new MailAnotationCourrier($noms,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien));

       }



       

       else{

          $utilisateurs=User::where('departement_id',$request->direction)

        ->where('user_role',4)

        ->Orwhere('user_role',3)

        ->get();

            foreach ($utilisateurs as $key => $value) {

            $emails=$value->email;

            $noms=$value->name;

         }

Mail::to($emails)->send(new MailAnotationCourrier($noms,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien));

          }

        

       

if($request->groupe>=1)

      {

          $utilisateurs=User::where('groupe_id',$request->groupe)

        ->get();

        $groupes=Groupe::where('id',$request->groupe)->get();

        foreach ($groupes as $key => $value) {

          $groupe=$value->nom_groupe;

        }

            foreach ($utilisateurs as $key => $value) {

            $emails=$value->email;

            $noms=$value->name;

         Mail::to($emails)->send(new MailAnotationCourrierGroupe($noms,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien,$groupe));

         }

      }



 





if(Auth::user()->user_role==2)

  {

    return redirect()->route('listeCourrierAttente')->with('success', 'Courrier affecté avec succès');

  }

  if((Auth::user()->user_role==3)||(Auth::user()->user_role==4)||(Auth::user()->user_role==8))

  {

    return redirect()->route('listeCourrierAffecter')->with('success', 'Courrier Affecté avec succès');

  }



       

        

    }



   public function storeManager(Request $request)

    { $noms;

      $emails;

      if($request->courrierVdepartement=='')

       {

        $VisibleCservice="invisible";

       }

       else

       {

       $VisibleCservice=$request->courrierVdepartement;

       } 

        if($request->courrierVcfc=='')

       {

        $VisibleCfc="invisible";

       }

       else

       {

       $VisibleCfc=$request->courrierVcfc;

       }



       if($request->courrierVsg=='')

       {

        $VisibleSg="invisible";

       }

       else

       {

        $VisibleSg=$request->courrierVsg;

       }

if($request->direction==2)

      {

         $VisibleSg="visible";

      }

      if($request->direction==3)

      {

         $VisibleCfc="visible";

      }

     $direction=0;

      if($request->direction>=1)

      {

         $direction=$request->direction;

         

      }

      

$useraffecter=0;

      if($request->employe>=1)

      {

         $useraffecter=$request->employe;

        $statutCourrier="Trasmis";

      }
       $service=0;

      if($request->service>=1)

      {

         $service=$request->service;
         $statutCourrier="Affecté";

       

      }



        $groupe=0;

      if($request->groupe>=1)

      {

         $groupe=$request->groupe;

       

      }

      

        $courrier = Affectation::findOrFail($request->id);




        $courrier->update(['user_manager'=>Auth::user()->id,'date_affectationManager'=>date("Y-m-d H:i:s"),'user_affecter'=>$useraffecter,'commentaire_manager'=>$request->commentaire,'statut_courrier'=>$statutCourrier,'partage_courrier'=>$service]);



       

        $courriers=Courrier::where('id',$request->courrier_id)->get();
if($request->employe>=1)
{
  $utilisateurs=User::where('id',$request->employe)

       ->get();



        foreach ($utilisateurs as $key => $value) {

            $emails=$value->email;

            $noms=$value->name;

         }
}

if($request->service>=1)
{
  $utilisateurs=User::where('departement_id',$request->service)
  ->where('user_role',5)

       ->get();



        foreach ($utilisateurs as $key => $value) {

            $emails=$value->email;

            $noms=$value->name;

         }
}

        

foreach ($courriers as $key => $value) {

          $objet=$value->objet;

          $reference=$value->reference;

          $destinataire=$value->destinataire;

          $file_path=$value->file_path;

          $type_courrier=$value->type_courrier;

          $lien="http://gec.apipguinee.com/";

}

$commentaire=$request->commentaire;

  Mail::to($emails)->send(new MailAnotationCourrier($noms,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien));



        return redirect()->route('listeCourrierAffecter')->with('success', 'Courrier Affecté avec succès');

        

    }







    public function reponseCourrier($id)

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

         // ->where('visisbleChefCabinet','visible')

 

         ->where('courrier_etat','Affecté')->get();



          

         

           }

            if((Auth::user()->user_role==4))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites=  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )

         

 

         ->where('courrier_etat','Affecté')->get();



          

         

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

          ->where('direction_affectation',Auth::user()->departement_id)

         ->where('courriers.id',$id)

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



            // detail courrier groupe


             $courriersA = Affectation::where('courrier_id',$id)->get();

           foreach ($courriersA as $courriers) {

           if(Auth::user()->groupe_id>0) 
           {
             if($courriers->affecter_groupe==Auth::user()->groupe_id)

          {

            $valC=$courriers->statut_courrier;

          
        $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('groupes', 'groupes.id', '=', 'affecter_groupe')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom_groupe','file_path','commentaireRelance','affectations.id','commentaire_manager','courrier_id','affecter_groupe','commentaire_dga')

         ->where('statut_courrier','Affecté')
          ->where('courriers.id',$id)

         ->get();

          return view('reponse_courriers.traiter_courrier',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

          }



           }

              



        }



            

           if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

           ->select('*')

         ->where('courriers.id',$id)->get();



          

         return view('reponse_courriers.traiter_courrierDg',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

           }

if((Auth::user()->user_role==3)||(Auth::user()->user_role==4))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier','commentaireSg', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','file_path','commentaireRelance','affectations.id','commentaire_manager','courrier_id','affecter_groupe','commentaire_dga')

         ->where('courriers.id',$id)->get();



          

         return view('reponse_courriers.traiter_courrier',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

           }



           if((Auth::user()->user_role==5))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

        

         ->select('objet','reference', 'numero' ,'type_courrier','commentaireSg', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','file_path','commentaireRelance','affectations.id','commentaire_manager','courrier_id','affecter_groupe','commentaire_dga')

         ->where('courriers.id',$id)->get();



          

         return view('reponse_courriers.traiter_courrier',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

           }

           if((Auth::user()->user_role==7)) {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->join('users', 'users.id', '=', 'user_affecter')

         ->select('objet','reference', 'numero' ,'type_courrier','commentaireSg', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','name','affectations.id','file_path','commentaireRelance','commentaire_manager','courrier_id','affecter_groupe','commentaire_dga' )

         ->where('statut_courrier','Trasmis')

         ->where('direction_affectation',Auth::user()->departement_id)

          ->where('courriers.id',$id)

         ->get();



          

         return view('reponse_courriers.traiter_courrier',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

            }

            if((Auth::user()->user_role==6)) {




          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'commentaireSg','expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','affectations.id','file_path','commentaireRelance','commentaire_manager','courrier_id','affecter_groupe','commentaire_dga' )

    ->where('statut_courrier','Trasmis')

          ->where('direction_affectation',Auth::user()->departement_id)

          ->where('courriers.id',$id)

         ->get();



          

         return view('reponse_courriers.traiter_courrier',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

            }



            else

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->join('users', 'users.id', '=', 'user_affecter')

         ->select('objet','reference', 'numero' ,'type_courrier', 'commentaireSg','expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','name','affectations.id','file_path','commentaireRelance','commentaire_manager','courrier_id','affecter_groupe','commentaire_dga' )

         ->where('statut_courrier','Trasmis')

         ->where('direction_affectation',Auth::user()->departement_id)

         ->where('user_affecter',Auth::user()->id)

          ->where('courriers.id',$id)

         ->get();



          

         return view('reponse_courriers.traiter_courrier',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites]);

            }

         }

      else

        {

             return view('auth.login'); 

        }

    }





public function transmission_Reponse(Request $request)

    { 
	      
       
          $fileName ="";

if(isset($request->file_path))

{

    $fileName = $request->file_path->getClientOriginalName();
         $request->file_path->move(public_path('/documents/Traités'), $fileName);
          

   // var_dump($fichierName);die();


}



 // $courrier = Reponse::create(['courier_id'=>$request->id,'user_id'=>Auth::user()->id,'date_reponse'=>date("Y-m-d H:i:s"),'direction_id'=>Auth::user()->departement_id,'document'=>$fileName,'commentaireReponse'=>$request->reponse]);
 // var_dump($fileName);die();
// var_dump($fichierName);die();

       $courriergroupes=Affectation::where('courrier_id',$request->id)



       ->where('affecter_groupe',Auth::user()->groupe_id)
      //->where('direction_affectation',Auth::user()->direction_id)
     
      ->get();

   // var_dump(count($courriergroupes) );die();

        foreach ($courriergroupes as $key => $courriergroupe) {


       if($courriergroupe->direction_affectation==Auth::user()->groupe_id)

       {

        
          $courrier = Reponse::create(['courier_id'=>$request->id,'user_id'=>Auth::user()->id,'date_reponse'=>date("Y-m-d H:i:s"),'direction_id'=>Auth::user()->groupe_id,'document'=>$fichierName,'commentaireReponse'=>$request->reponse]);



        $updAffectation = Courrier::findOrFail($request->courrier_id);

        $updAffectation->update(['courrier_etat'=>"Traité",'date_traitement'=>date("Y-m-d H:i:s")]);



        $courrierA = Affectation::findOrFail($request->id);

        $courrierA->update(['user_affecter'=>Auth::user()->id,'statut_courrier'=>'Traité']);



$courriers=Courrier::where('id',$request->id)->get();

foreach ($courriers as $key => $value) {

          $objet=$value->objet;

          $reference=$value->reference;

          $destinataire=$value->destinataire;

          $file_path=$value->file_path;

          $type_courrier=$value->type_courrier;

          $lien="http://gec.apipguinee.com/";

          $emailOrigine=$value->email;

}



$commentaire=$request->reponse;



   $groupes=Groupe::where('id',$courriergroupe->affecter_groupe)

        ->where('groupe','=',1)->get();



            if(count($groupes)==1)

     {



       

        $utilisateurs=User::where('groupe_id',$courriergroupe->affecter_groupe)

        ->get();

        foreach ($utilisateurs as $key => $value) {

         $emails=$value->email;

            $noms=$value->name;

            

         Mail::to($value->email)->send(new MailTraiteCourrier($noms,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien));



        }

     }

return redirect()->route('home')->with('success', 'Courrier Traité avec succès');

       }

      }      

if ((Auth::user()->user_role==2)||(Auth::user()->user_role==8))

    {   



     $VisibleDGA="invisible";

          $courrier = Affectation::create(['user_dg'=>Auth::user()->id,'user_affecter'=>Auth::user()->id,'courrier_id'=>$request->id,'date_affectation'=>date("Y-m-d H:i:s"),'direction_affectation'=>Auth::user()->departement_id,'lu'=>"non",'commentaire'=>$request->commentaire,'statut_courrier'=>'Traité']);



        $updAffectation = Courrier::findOrFail($request->id);

        $updAffectation->update(['courrier_etat'=>"Traité",'date_affectation'=>date("Y-m-d H:i:s"),'date_traitement'=>date("Y-m-d H:i:s")]);





 



     $courrier = Reponse::create(['courier_id'=>$request->id,'user_id'=>Auth::user()->id,'date_reponse'=>date("Y-m-d H:i:s"),'direction_id'=>Auth::user()->departement_id,'document'=>$fichierName,'commentaireReponse'=>$request->reponse]);



        



  



        $utilisateus=User::where('id',Auth::user()->id)->get();



        foreach ($utilisateus as $key => $value) {

            $emails=$value->email;

            $noms=$value->name;

         }



      $courriers=Courrier::where('id',$request->id)->get();

foreach ($courriers as $key => $value) {

          $objet=$value->objet;

          $reference=$value->reference;

          $destinataire=$value->destinataire;

          $file_path=$value->file_path;

          $type_courrier=$value->type_courrier;

          $lien="http://gec.apipguinee.com/";

          $emailOrigine=$value->email;

}

  

  $courrierRepondus=Affectation::where('courrier_id',$request->id)->get();

        foreach ($courrierRepondus as $key => $courrierRepondu) {

     $courrierA = Affectation::findOrFail($courrierRepondu->id);

        $courrierA->update(['user_affecter'=>Auth::user()->id,'statut_courrier'=>'Traité']);

        }



$commentaire=$request->reponse;

 Mail::to($emails)->send(new MailTraiteCourrier($noms,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien));



        return redirect()->route('home')->with('success', 'Réponse Envoyé avec succès');

  

}





   if (Auth::user()->user_role!=2)

      {
       $fileName = ""; 

     
      // var_dump($fileName);die();

if(isset($request->file_path))


{

 $fileName = $request->file_path->getClientOriginalName();
 
        $request->file_path->move(public_path('/documents/Traités'), $fileName);

         
      
 // $request->file_path->move(public_path('/documents/Traités'), $fileName);


 // $size = $request->file->getSize();
        // $request->file->move(public_path('/documents/Traités'), $fichierName);

         // var_dump($fichierName);die();

  // $fichierName = $request->file_path->getClientOriginalName();
  
   // $request->file_path->move(public_path('/documents/Traités'),$fichierName);
 
}

 $courrier = Reponse::create(['courier_id'=>$request->courrier_id,'user_id'=>Auth::user()->id,'date_reponse'=>date("Y-m-d H:i:s"),'direction_id'=>Auth::user()->departement_id,'document'=>$fileName,'commentaireReponse'=>$request->reponse]); 



// var_dump($fichierName);die();


        $updAffectation = Courrier::findOrFail($request->courrier_id);

        $updAffectation->update(['courrier_etat'=>"Traité",'date_traitement'=>date("Y-m-d H:i:s")]);



$courrierRepondus=Affectation::where('courrier_id',$request->courrier_id)->get();

        foreach ($courrierRepondus as $key => $courrierRepondu) {

     $courrierA = Affectation::findOrFail($courrierRepondu->id);

        $courrierA->update(['user_affecter'=>Auth::user()->id,'statut_courrier'=>'Traité']);

        }







      

        $courriers=Courrier::where('id',$request->courrier_id)->get();



        $utilisateus=User::where('user_role',2)->get();



        foreach ($utilisateus as $key => $value) {

            $emails=$value->email;

            $noms=$value->name;

         }

          $utilisateuManagers=User::where('user_role',5)->get();



        foreach ($utilisateuManagers as $key => $value) {

            $emailManagers=$value->email;

            $nomManagers=$value->name;

         }

foreach ($courriers as $key => $value) {

          $objet=$value->objet;

          $reference=$value->reference;

          $destinataire=$value->destinataire;

          $file_path=$value->file_path;

          $type_courrier=$value->type_courrier;

          $lien="http://gec.apipguinee.com/";

          $emailOrigine=$value->email;

}

}

$commentaire=$request->reponse;

 if (Auth::user()->user_role==5)

 {

  Mail::to(Auth::user()->email)->send(new MailTraiteCourrier(Auth::user()->name,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien));

  Mail::to($emails)->send(new MailTraiteCourrier($noms,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien));

 }

  if ((Auth::user()->user_role==3)||(Auth::user()->user_role==4))

 {

  Mail::to(Auth::user()->email)->send(new MailTraiteCourrier(Auth::user()->name,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien));

  Mail::to($emails)->send(new MailTraiteCourrier($noms,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien));

 }

 

if (Auth::user()->user_role==6)

 {

   Mail::to(Auth::user()->email)->send(new MailTraiteCourrier(Auth::user()->name,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien));

  Mail::to($emails)->send(new MailTraiteCourrier($noms,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien));

  Mail::to($emailManagers)->send(new MailTraiteCourrier($nomManagers,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien));

 }

 // Mail::to($emailOrigine)->send(new MailReponseCourrierDestinateur($objet,$reference,$destinataire,$file_path));

        return redirect()->route('listeCourrierAffecter')->with('success', 'Courrier Traité avec succès');

      

     

        

    }





    



 public function relanceannotation(Request $request)

    { 



        $updAffectation = Affectation::findOrFail($request->id);

        $updAffectation->update(['commentaireRelance'=>$request->editor2]);

        $utilisateus=User::where('id',$request->employe)->get();

        foreach ($utilisateus as $key => $value) {

            $emails=$value->email;

            $noms=$value->name;

         }

         $courriers = Courrier::where('id',$request->courrier_id)

         ->get();  

foreach ($courriers as $key => $value) {

          $objet=$value->objet;

          $reference=$value->reference;

          $destinataire=$value->destinataire;

          $file_path=$value->file_path;

          $type_courrier=$value->type_courrier;

          $lien="http://gec.apipguinee.com/";

}

$commentaire=$request->editor1;

  //Mail::to($emails)->send(new MailAnotationCourrier($noms,$commentaire,$objet,$reference, $destinataire,$type_courrier,$file_path,$lien));



        return redirect()->route('listeCourrierAttente')->with('success', 'Courrier Affecté avec succès');

        

    }











      public function anotationdirection(Request $request)

    { if(isset(Auth::user()->id))

        {

          if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8)||(Auth::user()->user_role==9))

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

         // ->where('visisbleChefCabinet','visible')



         ->where('courrier_etat','Affecté')


         ->get();



          

             }

              if((Auth::user()->user_role==4))

           {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courrierEnAttenteTraites=  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation','commentaire','nom','courriers.id' )

         



         ->where('courrier_etat','Affecté')->get();



          

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

            ->where('statut_courrier','Affecté')

          ->where('direction_affecte',Auth::user()->departement_id)

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

            //Fin Menu

           if ((Auth::user()->user_role==2)||(Auth::user()->user_role==8)||(Auth::user()->user_role==9)) {

            # code...

         $annotationtypes=Annotationtype::where('actifAnnotation',1)->get();
         $priorites = Priorite::where('actif', 1)->get();

         $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();

         $courriers = Courrier::where('id',$request->id)

         ->get();  

         $directions = Departement::where('actif', 1)->get(); 

         $services=Service::where('actif',1)->get();

         $groupes=Groupe::where('actif',1)->get();



         return view('anotations.anotation',['courriers'=> $courriers,'directions'=>$directions,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites,'annotationtypes'=>$annotationtypes,'services'=>$services,'groupes'=>$groupes, 'priorites'=>$priorites]);

           }

         if((Auth::user()->user_role==3))

            {

               $courrierAttentes= Courrier::where('courrier_etat','Affecté')->get();



                $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation', 'courrier_id','commentaire','nom','affectations.id','file_path','commentaireRelance','affecter_groupe' )

         // ->where('visisbleChefCabinet','visible')

         ->where('courrier_etat','Affecté')

          ->where('courriers.id',$request->id)

         ->get();







             

 $services=Service::where('actif',1)->get();

            $annotationtypes=Annotationtype::where('actifAnnotation',1)->get();
             $priorites = Priorite::where('actif', 1)->get();

               $directions = Departement::where('actif', 1)->get(); 

                $groupes=Groupe::where('actif',1)->get();
                  $utilisateurs = User::where('user_statut', 1)->where('departement_id',Auth::user()->departement_id)->get();

         return view('anotations.anotationDGA',['courriers'=> $courriers,'directions'=>$directions,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites,'annotationtypes'=>$annotationtypes,'services'=>$services,'groupes'=>$groupes, 'utilisateurs'=>$utilisateurs,'priorites'=>$priorites]);

            }

            if((Auth::user()->user_role==4))

            {

               $courrierAttentes= Courrier::where('courrier_etat','Affecté')->get();



                $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

        ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation', 'courrier_id','commentaire','nom','affectations.id','file_path','commentaireRelance' ,'affecter_groupe')

         

         ->where('courrier_etat','Affecté')

          ->where('courriers.id',$request->id)

         ->get();







             

$services=Service::where('actif',1)->get();

            $annotationtypes=Annotationtype::where('actifAnnotation',1)->get();
             $priorites = Priorite::where('actif', 1)->get();

               $directions = Departement::where('actif', 1)->get(); 

                $groupes=Groupe::where('actif',1)->get();
                  $utilisateurs = User::where('user_statut', 1)->where('departement_id',Auth::user()->departement_id)->get();

         return view('anotations.anotationDGA',['courriers'=> $courriers,'directions'=>$directions,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites,'annotationtypes'=>$annotationtypes,'services'=>$services,'groupes'=>$groupes, 'utilisateurs'=>$utilisateurs,'priorites'=>$priorites]);

            }



           if((Auth::user()->user_role==5))

            {

               $courrierAttentes= Courrier::where('courrier_etat','Affecté')->get();

                $priorites = Priorite::where('actif', 1)->get();



                $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation', 'courrier_id','commentaire','nom','affectations.id','file_path','commentaireRelance','affecter_groupe' )

         ->where('courrier_etat','Affecté')

         ->where('direction_affectation',Auth::user()->departement_id)

         // ->where('user_affecter',Auth::user()->id)

          ->where('courriers.id',$request->id)

         ->get();

         

               $utilisateurs = User::where('user_statut', 1)->where('departement_id',Auth::user()->departement_id)->get(); 

 $directions = Departement::where('actif', 1)->get(); 

         return view('anotations.anotationManager',['courriers'=> $courriers,'utilisateurs'=>$utilisateurs,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites,'directions'=>$directions, 'priorites'=>$priorites]);

            }

        }

      else

        {

             return view('auth.login');  

        }

    }



 

 public function DetailcourrierenAffecte($id)

    {

     $valC;

       

        if(isset(Auth::user()->id))

        {


            // Menu

            // detail courrier groupe

     

            $courriersA = Affectation::where('courrier_id',$id)

             ->get();



           if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==3)||(Auth::user()->user_role==4)||(Auth::user()->user_role==8)||(Auth::user()->user_role==9))

           {

             




      $courriersA = Affectation::where('courrier_id',$id)

        ->get(); 

        foreach($courriersA as $courriers) {


 



       



          if($courriers->statut_courrier=="Affecté")

          {
            if($courriers->affecter_groupe>0)
             {

               $valC=$courriers->statut_courrier;

            $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('groupes', 'groupes.id', '=', 'affecter_groupe')
          ->join('priorites','priorites.id', "=",'courriers.id_priorite') 
        ->join('couleurs','couleurs.id', "=",'priorites.id_couleur')


         ->join('users', 'users.id', '=', 'user_dg')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation', 'courrier_id','commentaire','nom_groupe','name','affectations.id','file_path','commentaireRelance','affecter_groupe','couleur_name','priorite_name','direction_affectation','courrier_etat' )

         ->where('statut_courrier','Affecté')

          ->where('courriers.id',$id)

         ->get();

          return view('anotations.detail_anotationManager',['courriers'=>$courriers]);

          

             }
             if (($courriers->direction_affectation>0)||($courriers->partage_courrier>0)) {

               $valC=$courriers->statut_courrier;

            $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')
          ->join('priorites','priorites.id', "=",'courriers.id_priorite') 
        ->join('couleurs','couleurs.id', "=",'priorites.id_couleur') 

         ->join('users', 'users.id', '=', 'user_dg')

         ->select('objet','reference', 'numero' ,'type_courrier','commentaireSg', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation', 'courrier_id','commentaire','nom','name','affectations.id','file_path','commentaireRelance','affecter_groupe','direction_affectation', 'courrier_etat', 'id_priorite','couleur_name', 'priorite_name')

         ->where('courrier_etat','Affecté')

          ->where('courriers.id',$id)

         ->get();
          $priorites = Priorite::where('actif', 1)->get();
          foreach ($courriers as $key => $value) {
            
              $nomuser=User::where('departement_id',$value->direction_affectation)->where('user_role',5)->get();
           
         
           

         }

return view('anotations.detail_anotationManager',['courriers'=>$courriers,'nomuser'=>$nomuser, 'priorites'=>$priorites]);
               
             }

           

   
           
         
           

         }

          

          

           if($courriers->statut_courrier=="Trasmis")

          {


$priorites = Priorite::where('actif', 1)->get();
            $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')
           ->join('priorites','priorites.id', "=",'courriers.id_priorite') 
        ->join('couleurs','couleurs.id', "=",'priorites.id_couleur') 

         ->join('users', 'users.id', '=', 'user_affecter')

         ->select('objet','reference', 'numero' ,'type_courrier','commentaireSg', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation', 'courrier_id','commentaire','nom','name','courriers.id','file_path','commentaireRelance','commentaire_manager','affecter_groupe', 'courrier_etat', 'id_priorite','couleur_name', 'priorite_name','direction_affectation','affecter_groupe','commentaire_dga' )

         ->where('statut_courrier','Trasmis')

        

        

          ->where('courriers.id',$id)

         ->get();

         return view('anotations.detail_anotationUser',['courriers'=>$courriers, 'priorites'=>$priorites]);

        }



          

        

           }

         }
if((Auth::user()->user_role==8))

            {
             

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();

 $courriersA = Affectation::where('courrier_id',$id)

        ->get(); 

        foreach ($courriersA as $courriers) {

          if($courriers->statut_courrier=="Affecté")

          {


            $valC=$courriers->statut_courrier;

            $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')
          ->join('priorites','priorites.id', "=",'courriers.id_priorite') 
        ->join('couleurs','couleurs.id', "=",'priorites.id_couleur') 

           ->join('users', 'users.id', '=', 'user_dg')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','commentaireSg','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation', 'courrier_id','commentaire','nom','name','affectations.id','file_path','commentaireRelance','affecter_groupe', 'id_priorite'  ,'couleur_name', 'priorite_name','direction_affectation','affecter_groupe')

         ->where('statut_courrier','Affecté')


          ->where('courriers.id',$id)

         ->get();

          return view('anotations.detail_anotationManager',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites, 'priorites'=>$priorites]);

          }

           if($courriers->statut_courrier=="Trasmis")

          {



            $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')
          ->join('priorites','priorites.id', "=",'courriers.id_priorite') 
        ->join('couleurs','couleurs.id', "=",'priorites.id_couleur') 

         ->join('users', 'users.id', '=', 'user_affecter')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','commentaireSg','courriers.email','courriers.telephone', 'affectations.date_affectation', 'courrier_id','commentaire','nom','name','courriers.id','file_path','commentaireRelance','commentaire_manager','affecter_groupe', 'id_priorite','couleur_name', 'priorite_name','direction_affectation','affecter_groupe','commentaire_dga'  )

         ->where('statut_courrier','Trasmis')

          ->where('courriers.id',$id)

         ->get();

         return view('anotations.detail_anotationUser',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites, 'priorites'=>$priorites]);

        }



          

}

      

        

            }
            if((Auth::user()->user_role==5))

            {
             

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();

 $courriersA = Affectation::where('courrier_id',$id)
->get(); 
   $priorites = Priorite::where('actif', 1)->get();
        foreach ($courriersA as $courriers) {
        

          if($courriers->statut_courrier=="Affecté")

          {
if ($courriers->direction_affectation>0) {

            $valC=$courriers->statut_courrier;


            $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')
          ->join('priorites','priorites.id', "=",'courriers.id_priorite') 
        ->join('couleurs','couleurs.id', "=",'priorites.id_couleur') 

           ->join('users', 'users.id', '=', 'user_dg')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','commentaireSg','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation', 'courrier_id','commentaire','nom','name','affectations.id','file_path','commentaireRelance','affecter_groupe', 'courrier_etat', 'id_priorite','couleur_name', 'priorite_name','direction_affectation','partage_courrier' )

         ->where('courrier_etat','Affecté')

         ->where('direction_affectation',Auth::user()->departement_id)

       // ->where('user_affecter',Auth::user()->id)

          ->where('courriers.id',$id)

         ->get();
       }
 //       if ($courriers->partage_courrier>0) {
 // $courriers =  DB::table('courriers')

 //         ->join('affectations', 'courriers.id', '=', 'courrier_id')

 //         ->join('departements', 'departements.id', '=', 'direction_affectation')
 //          ->join('priorites','priorites.id', "=",'courriers.id_priorite') 
 //        ->join('couleurs','couleurs.id', "=",'priorites.id_couleur') 

 //           ->join('users', 'users.id', '=', 'user_dg')

 //         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','commentaireSg','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation', 'courrier_id','commentaire','nom','name','affectations.id','file_path','commentaireRelance','affecter_groupe', 'courrier_etat', 'id_priorite','couleur_name', 'priorite_name','direction_affectation','partage_courrier' )

 //         ->where('courrier_etat','Affecté')

 //         ->where('partage_courrier',Auth::user()->departement_id)

 //         // ->where('user_affecter',Auth::user()->id)

 //          ->where('courriers.id',$id)

 //         ->get();
 //       }

          return view('anotations.detail_anotationManager',['courriers'=>$courriers, 'priorites'=>$priorites]);

          }

           if($courriers->statut_courrier=="Trasmis")

          {

$priorites = Priorite::where('actif', 1)->get();

            $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->join('priorites','priorites.id', "=",'courriers.id_priorite') 
        ->join('couleurs','couleurs.id', "=",'priorites.id_couleur') 

         ->join('users', 'users.id', '=', 'user_affecter')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','commentaireSg','courriers.email','courriers.telephone', 'affectations.date_affectation', 'courrier_id','commentaire','nom','name','courriers.id','file_path','commentaireRelance','commentaire_manager','affecter_groupe','courrier_etat', 'id_priorite','couleur_name', 'priorite_name','direction_affectation','commentaire_dga'  )

         ->where('statut_courrier','Trasmis')

        

         ->where('direction_affectation',Auth::user()->departement_id)

          ->where('courriers.id',$id)

         ->get();

         return view('anotations.detail_anotationUser',['courriers'=>$courriers, 'priorites'=>$priorites]);

        }



          

}

      

        

            }



            

           

           

  

      

        



            if(Auth::user()->user_role==6)

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();
$priorites = Priorite::where('actif', 1)->get();


          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')
         ->join('priorites','priorites.id', "=",'courriers.id_priorite') 
        ->join('couleurs','couleurs.id', "=",'priorites.id_couleur') 

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation', 'courrier_id','commentaire','nom','courriers.id','file_path','commentaireRelance','commentaire_manager','affecter_groupe', 'courrier_etat', 'id_priorite','couleur_name','priorite_name','direction_affectation','commentaire_dga' )

        ->where('courrier_etat','Affecté')

          ->where('direction_affectation',Auth::user()->departement_id)

          ->where('courriers.id',$id)

         ->get();



          

         return view('anotations.detail_anotationUser',['courriers'=>$courriers, 'priorites'=>$priorites]);

            }

            if(Auth::user()->user_role==7)

            {

                $courrierAttentes= Courrier::where('courrier_etat','attente')

         ->get();



          $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('departements', 'departements.id', '=', 'direction_affectation')
          ->join('priorites','priorites.id', "=",'courriers.id_priorite') 
        ->join('couleurs','couleurs.id', "=",'priorites.id_couleur') 

         ->join('users', 'users.id', '=', 'user_affecter')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation', 'courrier_id','commentaire','nom','name','courriers.id','file_path','commentaireRelance','commentaire_manager','affecter_groupe', 'courrier_etat', 'id_priorite','couleur_name', 'priorite_name','direction_affectation','commentaire_dga'  )

         ->where('statut_courrier','Trasmis')

         ->where('direction_affectation',Auth::user()->departement_id)

          ->where('courriers.id',$id)

         ->get();



          

         return view('anotations.detail_anotationUser',['courriers'=>$courriers,'courrierAttentes'=>$courrierAttentes,'courrierEnAttenteTraites'=>$courrierEnAttenteTraites, 'priorites'=>$priorites]);

            }

         }

      else

        {

             return view('auth.login'); 

        }

    }





public function DetailcourrierenAffecteGroupe($id)

    { $valC;

       

        if(isset(Auth::user()->id))

        {

          

            // Menu

            // detail courrier groupe

     

            $courriersA = Affectation::where('courrier_id',$id)

           ->get();

           foreach ($courriersA as $courriers) { 

             if($courriers->affecter_groupe==Auth::user()->groupe_id)

          {

            

            $valC=$courriers->statut_courrier;

            $courriers =  DB::table('courriers')

         ->join('affectations', 'courriers.id', '=', 'courrier_id')

         ->join('groupes', 'groupes.id', '=', 'affecter_groupe')
            ->join('priorites','priorites.id', "=",'courriers.id_priorite') 
        ->join('couleurs','couleurs.id', "=",'priorites.id_couleur') 
          
         ->join('users', 'users.id', '=', 'user_dg')

         ->select('objet','reference', 'numero' ,'type_courrier', 'expediteur','destinataire', 'date_arrivee','courriers.email','courriers.telephone', 'affectations.date_affectation', 'courrier_id','commentaire','nom_groupe','name','affectations.id','file_path','commentaireRelance','affecter_groupe','courrier_etat','id_priorite','couleur_name', 'priorite_name','direction_affectation','commentaire_manager','commentaire_dga' )

         ->where('statut_courrier','Affecté')

          ->where('courriers.id',$id)

         ->get();

          return view('anotations.detail_anotationUser',['courriers'=>$courriers]);

          }





        }



          



         

            

         

       

     }

      else

        {

             return view('auth.login'); 

        }

    }


 
   






























}



