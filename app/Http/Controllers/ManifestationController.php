<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use Illuminate\Http\Request;
use App\Manifestation;
use App\Departement;
use App\Operation;
use Mail;
use App\Mail\Envoimail;
use Illuminate\Support\Facades\Auth;

class ManifestationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
     public function liste_besoin()
    {
       

        // $manifestations = Manifestation::where('statut_manifestation', 'envoyer')->get();
        
        //    return view('manifestation.liste_demande_besoin', ['manifestations'=>$manifestations]);
        if(isset(Auth::user()->id))
        {
            $manifestations= DB::table('manifestations')
         ->join('users', 'users.id', '=', 'id_user')
         ->select('name', 'titre', 'manifestations.id') 
         ->where('statut_manifestation','=','envoyer')
         ->where('departement_envoi', Auth::user()->nom_departement)
         ->get();
         return view('manifestation.liste_demande_besoin')->with('manifestations',$manifestations);
         }
      else
        {
             return view('auth.login'); 
        }
    }
    public function validationd($id)
    { if(isset(Auth::user()->id))
        {
        $editvalidations =  DB::table('manifestations')
         ->join('users', 'users.id', '=', 'id_user')
         ->select('nom_departement','name', 'poste', 'email', 'manifestations.id','date_bedut', 'titre', 'besoin_manifestation') 
         ->where('manifestations.id',$id)->get();
        return view('manifestation.validation')->with('editvalidations', $editvalidations);
        }
      else
        {
             return view('auth.login'); 
        }
    }
     public function apercud($id)
    { if(isset(Auth::user()->id))
        {
        $editvalidations =  DB::table('manifestations')
        ->join('users', 'users.id', '=', 'manifestations.id_user')
        ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
        ->select('*')
        ->where('operations.id',$id)
        ->where('departement_envoi', Auth::user()->nom_departement)
        ->where('operations.etat','traitée')

        ->get();   
        return view('departements.apercu')->with('editvalidations', $editvalidations);
        }
      else
        {
             return view('auth.login'); 
        }
    }
      public function apercudencour($id)
    { if(isset(Auth::user()->id))
        {
        $editvalidations =  DB::table('manifestations')
        ->join('users', 'users.id', '=', 'manifestations.id_user')
        ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
        ->select('*')
        ->where('operations.id',$id)
        ->where('departement_envoi', Auth::user()->nom_departement)
        ->where('operations.etat','encour')
        ->get();   
        return view('departements.apercu')->with('editvalidations', $editvalidations);
        }
      else
        {
             return view('auth.login'); 
        }
    }
    
    
    
    public function tacheemploye($id)
    { if(isset(Auth::user()->id))
        {
        $editvalidations =  DB::table('manifestations')
         ->join('users', 'users.id', '=', 'id_user')
         ->select('nom_departement','name', 'poste', 'email', 'manifestations.id','date_bedut', 'titre', 'besoin_manifestation') 
         ->where('manifestations.id',$id)->get();
         if(Auth::user()->nom_departement=='Service Administratif et Financier')
         {
            return view('departements.operation_comptable')->with('editvalidations', $editvalidations);
         }
         else
         {
             return view('demandeur.apercu_tache')->with('editvalidations', $editvalidations);
         }
       
        }
      else
        {
             return view('auth.login'); 
        }
    }
     public function tacheemployeencour($id)
    { if(isset(Auth::user()->id))
        {
        $editvalidations = 
        DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('manifestations.id', $id)
                    ->where('etat','encours de traitement')->get();
         
        return view('demandeur.apercu_operationencour')->with('editvalidations',$editvalidations);
        }
      else
        {
             return view('auth.login'); 
        }
    }

    public function tachechefdepartement($id)
    { if(isset(Auth::user()->id))
        {
        $editvalidations =  DB::table('manifestations')
         ->join('users', 'users.id', '=', 'id_user')
         ->select('nom_departement','name', 'poste', 'email', 'manifestations.id','date_bedut', 'titre', 'besoin_manifestation') 
         ->where('manifestations.id',$id)->get();

         $employers= User::where('supprime_user', 0)
         ->where('nom_departement',Auth::user()->nom_departement)
         ->distinct('nom_departement')->get();
        return view('departements.apercu_tache',['editvalidations'=>$editvalidations,'employers'=>$employers]) ;
        }
      else
        {
             return view('auth.login'); 
        }
    }
     public function apercudirectionrejeter($id)
    { if(isset(Auth::user()->id))
        {
        $editvalidations =  DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->select('*')
                    ->where('manifestations.id',$id)
                    ->get();
        return view('direction.apercusuivi')->with('editvalidations', $editvalidations);
        }
      else
        {
             return view('auth.login'); 
        }
    }

    
     public function rejeter($id)
    { if(isset(Auth::user()->id))
        {
        $editvalidations =  DB::table('manifestations')
         ->join('users', 'users.id', '=', 'id_user')
         ->select('nom_departement','name', 'poste', 'email', 'manifestations.id','date_bedut', 'titre', 'besoin_manifestation') 
         ->where('manifestations.id',$id)->get();

        $departements= Departement::where('supprimer_departement', 0)->distinct('nom_departement')->get();

        return view('manifestation.affectation',['editvalidations'=>$editvalidations,'departements'=>$departements]);
        }
      else
        {
             return view('auth.login'); 
        }

    }
      public function updatevalidation(Request $request,$id)
    {  if(isset(Auth::user()->id))
        {
          $updvalidations = Manifestation::findOrFail($id);
          $updvalidations->update(['statut_manifestation' =>'valider']);
         return redirect()->route('home')->with('succes', 'Data has been successfully');
         }
      else
        {
             return view('auth.login'); 
        }
    }
     public function affectationvalidation(Request $request,$id)
    { if(isset(Auth::user()->id))
        {
          $updvalidations = Manifestation::findOrFail($id);
          $updvalidations->update(['statut_manifestation' =>'affecter','departement_affecte'=>$request->departement_affecte]);
         return redirect()->route('home')->with('succes', 'Data has been successfully');
         }
      else
        {
             return view('auth.login'); 
        }
    }

     public function affectationdepartement(Request $request,$id)
    {
        if(isset(Auth::user()->id))
        {
          $updvalidations = Manifestation::where('id',$id);
          $updvalidations->update(['employer_affecter'=>$request->employer_affecter,'etat_operation'=>'envoyer','statut_manifestation' =>'encours de traitement']);
         return redirect()->route('home')->with('succes', 'Data has been successfully');
         }
      else
        {
            return view('auth.login'); 
        }
    }

   public function rejetervalidation(Request $request,$id)
    {
          if(isset(Auth::user()->id))
        {
            $updvalidations = Manifestation::findOrFail($id);
          $updvalidations->update(['statut_manifestation' =>'rejetée']);
         return redirect()->route('home')->with('succes', 'Data has been successfully');
         }
      else
        {
             return view('auth.login'); 
        }
    }


     public function editmanifestation($id)
    {
        if(isset(Auth::user()->id))
        {
            $editmanifestations = Manifestation::findOrFail($id);
        return view('manifestation.modifier')->with('editmanifestations', $editmanifestations);
        }
      else
        {
             return view('auth.login'); 
        }
    }


     public function modifiervalidation(Request $request,$id)
    {
         if(isset(Auth::user()->id))
        {
         $updvalidations = Manifestation::where('id','=',$id);
          $updvalidations->update(['titre'=>$request->titre,'besoin_manifestation'=>$request->besoin_manifestation,'statut_manifestation' =>'valider']);
         return redirect()->route('home')->with('succes', 'Data has been successfully');
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
            if(Auth::user()->poste=="Direction")
            {
              $departements = Departement::where('supprimer_departement', 0)->get();
              return view('manifestation.create_direction')->with('departements',$departements);
            }
            else
            {
                 return view('manifestation.create');
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
    {
      
       if(isset(Auth::user()->id))
       {
          
        $manifestation= new Manifestation();
      $manifestation->titre= $request->get('titre');
       $manifestation->id_user= Auth::user()->id;
      $manifestation->besoin_manifestation = $request->get('besoin_manifestation');
      if(Auth::user()->poste=="Direction")
       { $manifestation->statut_manifestation ="affecter"; 
         $manifestation->departement_affecte=$request->departement_affecte;
        
        }
      elseif(Auth::user()->poste=="Chef de Departement")
       { $manifestation->statut_manifestation ="valider"; }
   elseif(Auth::user()->nom_departement=="Direction Générale")
       { $manifestation->statut_manifestation ="valider"; }
    else{$manifestation->statut_manifestation = "envoyer";}
       
      $manifestation->supprime_manifestation = 0;
      $manifestation->date_bedut =date('d-m-Y');
      $manifestation->departement_envoi=Auth::user()->nom_departement;
      $manifestation->save();
       
          $users = User::where('nom_departement','Auth::user()->nom_departement')->where('poste','Chef de Departement')->where('email','<>',null)->select('email')->get();
           // dispatch(new SendEmail($users,$courrier));
        
        Mail::to('sallkadiatoum@gmail.com')->send(new Envoimail($manifestation));
        // foreach($users as $user){
            
        //     Mail::to($user)->send(new Envoimail($manifestation));
        // }
     
       return redirect()->route('home');
          
        }

        else
        {
            return view('auth.login'); 
        }

     // $image1 = $request->file('doc')->store('img');
     //    return $request->file('doc');
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
        //
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
        //
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

    public function demandeurencour()
    {
        if(isset(Auth::user()->id))
       {
        $demandeurmanifestations=DB::table('manifestations')
        ->join('users', 'users.id', '=', 'manifestations.id_user')
        ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
        ->select('*')
        ->where('operations.id_user', Auth::user()->id)
        ->where('etat','encours de traitement')->get();                      
       if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.liste_traiter')->with('demandeurmanifestations', $demandeurmanifestations);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }

        }

        else
        {
             return view('auth.login'); 
        }

    }
     public function demandeurtraiter()
    { if(isset(Auth::user()->id))
       {
         $demandeurmanifestations=DB::table('manifestations')
        ->join('users', 'users.id', '=', 'manifestations.id_user')
        ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
        ->select('*')
        ->where('operations.id_user', Auth::user()->id)
        ->where('etat','traitée')->get();                      
       if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.liste_traiter')->with('demandeurmanifestations', $demandeurmanifestations);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }

        }

        else
        {
             return view('auth.login'); 
        }
    }
    public function demandeurtachetraiter()
    { if(isset(Auth::user()->id))
       {
         $demandeurmanifestations=DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('operations.employer', Auth::user()->email)
                    ->where('etat','traitée')->get();                       
       if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.liste_tachetraite')->with('demandeurmanifestations', $demandeurmanifestations);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
        }

        else
        {
             return view('auth.login'); 
        }
    }
   
     public function demandeurtache()
    {
        if(isset(Auth::user()->id))
       {
        $demandeurmanifestations= Manifestation::where('employer_affecter',Auth::user()->email)->where('etat_operation','envoyer')->get();                      
        
        if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.liste_tache')->with('demandeurmanifestations', $demandeurmanifestations);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
         }

        else
        {
             return view('auth.login'); 
        }
    }

    public function demandeurtacheencours()
    {
        if(isset(Auth::user()->id))
       {
        $demandeurmanifestations= DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('operations.employer', Auth::user()->email)
                    ->where('etat','encours de traitement')->get();
        if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.liste_tacheencour')->with('demandeurmanifestations', $demandeurmanifestations);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
        }

        else
        {
             return view('auth.login'); 
        }

    }
      public function demandeurenvoyer()
    
    { if(isset(Auth::user()->id))
       {
        $demandeurmanifestations= Manifestation::where('id_user', Auth::user()->id)
                                ->where('statut_manifestation','envoyer')->get();                        
        
        if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.liste_suivi')->with('demandeurmanifestations', $demandeurmanifestations);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
         }

        else
        {
            return view('auth.login'); 
        }
    }
      public function demandeurdirection()
    {
        if(isset(Auth::user()->id))
       {
        $demandeurmanifestations= Manifestation::where('id_user', Auth::user()->id)
                                ->where('statut_manifestation','valider')->get();                        
        
        if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.liste_suivi')->with('demandeurmanifestations', $demandeurmanifestations);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
        }

        else
        {
             return view('auth.login'); 
        }
    }
    public function apercusuivi($id)
    { if(isset(Auth::user()->id))
       {
        $editvalidations =DB::table('manifestations')
        ->join('users', 'users.id', '=', 'manifestations.id_user') 
        ->select('*')
        ->where('manifestations.id',$id)
        ->get();
        return view('demandeur.apercusuivi')->with('editvalidations', $editvalidations);
        }

        else
        {
             return view('auth.login'); 
        }
    }
     public function demandeurrejeter()
    { if(isset(Auth::user()->id))
       {
        $demandeurmanifestations= Manifestation::where('id_user', Auth::user()->id)
                                ->where('statut_manifestation','rejetée')->get();                        
        
        if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.liste_suivi')->with('demandeurmanifestations', $demandeurmanifestations);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
        }

        else
        {
             return view('auth.login'); 
        }
    }
    public function demandeurapercuoperationfin()
    {
        if(isset(Auth::user()->id))
       {
        $demandeurmanifestations=DB::table('manifestations')
         ->join('operations', 'manifestations.id', '=', 'id_manifestation')
         ->join('users', 'users.id', '=', 'manifestations.id_user')
         ->select('nom_departement','commentaire', 'poste', 'email', 'operations.id','date_bedut', 'manifestations.titre', 'besoin_manifestation','name')
         ->where('employer', Auth::user()->email) 
         ->where('etat','encours de traitement')->get();
        
        if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.demandeur_operationfin')->with('demandeurmanifestations', $demandeurmanifestations);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
        }

        else
        {
             return view('auth.login'); 
        }
    }

// debut nouveau menu EMPLOYER

    public function listemanifestation()
    {
        if(isset(Auth::user()->id))
        {
        $demandeurmanifestations= Manifestation::where('id_user', Auth::user()->id)
                                
                                ->get();

        $operations=Operation::where('id_user', Auth::user()->id)->get();
        if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.liste_manifestation',['demandeurmanifestations'=> $demandeurmanifestations,'operations'=>$operations]);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
    }
    else
        {
          return view('auth.login'); 
        }
}
public function apercuemploye($id)
    {
        $editvalidations =DB::table('manifestations')
        ->join('users', 'users.id', '=', 'manifestations.id_user')
        ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
        ->select('*')
        ->where('operations.id_manifestation',$id)
        ->get();
        return view('demandeur.aprecu')->with('editvalidations', $editvalidations);
    }

public function listenouvelletache()
    {
        if(isset(Auth::user()->id))
        {
        $demandeurmanifestations=DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                     ->select('manifestations.id','departement_envoi','name','titre','date_bedut','statut_manifestation','etat_operation')
                    -> where('employer_affecter', Auth::user()->email)
                    ->where('statut_manifestation','<>','traitée')->get();
        if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.liste_novelletache',['demandeurmanifestations'=> $demandeurmanifestations]);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
    }
    else
        {
          return view('auth.login'); 
        }
}
public function listenouvelletachecomptablite()
    {
        if(isset(Auth::user()->id))
        {
        $demandeurmanifestations=DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                     ->select('manifestations.id','departement_envoi','name','titre','date_bedut','statut_manifestation','etat_operation')
                    -> where('departement_affecte', Auth::user()->nom_departement)
                    ->where('statut_manifestation','<>','traitée')->get();
        if(count($demandeurmanifestations)>0)
        {
            return view('departements.liste_operation_comptable',['demandeurmanifestations'=> $demandeurmanifestations]);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
    }
    else
        {
          return view('auth.login'); 
        }
}

public function apercunouvelletache($id)
    {
        if(isset(Auth::user()->id))
        {
        $editvalidations=DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->select('date_bedut','manifestations.id','nom_departement','name','poste','besoin_manifestation')
                    ->where('manifestations.id',$id)->get();
        if(count($editvalidations)>0)
        {
            return view('demandeur.apercu_nouvelletache',['editvalidations'=> $editvalidations]);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
    }
    else
        {
          return view('auth.login'); 
        }
}

public function listetacherealisee()
    {
        if(isset(Auth::user()->id))
        {
        $demandeurmanifestations= DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('etat','date','departement_affecte', 'manifestations.id','commentaire','date_bedut','nom_departement','name','poste','besoin_manifestation','departement_envoi','manifestations.titre')
                    ->where('operations.employer', Auth::user()->email)
                    ->get(); 
        if(count($demandeurmanifestations)>0)
        {
            return view('demandeur.liste_tacherealisee',['demandeurmanifestations'=> $demandeurmanifestations]);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
    }
    else
        {
          return view('auth.login'); 
        }
}
public function apercutacherealisee($id)
    {
        if(isset(Auth::user()->id))
        {
        $editvalidations= DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('manifestations.id',$id)->get(); 
        if(count($editvalidations)>0)
        {
            return view('demandeur.apercu_tacherealisee',['editvalidations'=> $editvalidations]);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
    }
    else
        {
          return view('auth.login'); 
        }
}

//Fin menu employer
//Debut menu departement
public function listemanifestationdepartement()
    {
        if(isset(Auth::user()->id))
        {
           $demandeurmanifestations=DB::table('users')
                    ->join('Manifestations', 'users.id', '=', 'Manifestations.id_user') 
                    ->select('*')
                     ->where('departement_envoi', Auth::user()->nom_departement)
                      ->where('statut_manifestation','<>','envoyer')->get();

        $operations=DB::table('users')
                    ->join('operations', 'users.id', '=', 'operations.id_user') 
                    ->select('*')
                    ->where('nom_departement',Auth::user()->nom_departement)->get(); 

        if(count($demandeurmanifestations)>0)
        {
            return view('departements.liste_manifestation',['demandeurmanifestations'=> $demandeurmanifestations,'operations'=>$operations]);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
    }
    else
        {
          return view('auth.login'); 
        }
}
public function apercudepartement($id)
    {
        $editvalidations =DB::table('manifestations')
        ->join('users', 'users.id', '=', 'manifestations.id_user')
        ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
        ->select('*')
        ->where('operations.id_manifestation',$id)
        ->get();
        return view('departements.apercu')->with('editvalidations', $editvalidations);
    }
    public function listenouvelletachedepartement()
    {
        if(isset(Auth::user()->id))
        {
        $demandeurmanifestations=DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                     ->select('manifestations.id','departement_envoi','name','titre','date_bedut','statut_manifestation','etat_operation')
                    -> where('departement_affecte', Auth::user()->nom_departement)
                   ->whereIn('statut_manifestation', ['affecter', 'encours de traitement'])
                    ->get();
        if(count($demandeurmanifestations)>0)
        {
            return view('departements.liste_nouvelletache',['demandeurmanifestations'=> $demandeurmanifestations]);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
    }
    else
        {
          return view('auth.login'); 
        }
}
public function tacheemployeencourdepartement($id)
    {
        $editvalidations = 
        DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('manifestations.id', $id)
                    ->where('etat','encours de traitement')->get();
         
        return view('departements.apercu_operationencourdepartement')->with('editvalidations',$editvalidations);
    }
    public function listetacherealiseedepartement()
    {
        if(isset(Auth::user()->id))
        {
        $demandeurmanifestations= DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('etat','date','departement_affecte', 'manifestations.id','commentaire','date_bedut','nom_departement','name','poste','besoin_manifestation','departement_envoi','manifestations.titre','departement_affecte','ficher','operations.id_user','id_manifestation','employer_affecter')
                    ->where('departement_affecte', Auth::user()->nom_departement)->where('etat','traitée')
                    ->get(); 
        $demandeurnoms= DB::table('operations')
                    ->join('users', 'users.email', '=', 'operations.employer')
                    ->select('name','poste','users.id','operations.id_user','id_manifestation','employer')
                    ->get();
        if(count($demandeurmanifestations)>0)
        {
            return view('departements.liste_tacherealisedepartement',['demandeurmanifestations'=> $demandeurmanifestations,'demandeurnoms'=>$demandeurnoms]);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
    }
    else
        {
          return view('auth.login'); 
        }
}
//fin menu departement

//Debut menu direction
public function listemanifestationdirection()
    {
        if(isset(Auth::user()->id))
        {
           $demandeurmanifestations=DB::table('users')
                    ->join('Manifestations', 'users.id', '=', 'Manifestations.id_user') 
                    ->select('*')
                    ->where('statut_manifestation','<>','valider')
                     ->get();

        $operations=DB::table('users')
                    ->join('operations', 'users.id', '=', 'operations.id_user') 
                    ->select('*')
                    ->get(); 

        if(count($demandeurmanifestations)>0)
        {
            return view('direction.liste_manifestation',['demandeurmanifestations'=> $demandeurmanifestations,'operations'=>$operations]);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
    }
    else
        {
          return view('auth.login'); 
        }
}

public function apercudirection($id)
    {
        $editvalidations =DB::table('manifestations')
        ->join('users', 'users.id', '=', 'manifestations.id_user')
        ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
        ->select('*')
        ->where('operations.id_manifestation',$id)
        ->get();
        return view('direction.apercudirection')->with('editvalidations', $editvalidations);
    }
    public function listenouvelletachedirection()
    {
        if(isset(Auth::user()->id))
        {
        $demandeurmanifestations=DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                     ->select('manifestations.id','departement_envoi','name','titre','date_bedut','statut_manifestation','etat_operation','departement_affecte')
                    ->where('statut_manifestation','<>','traitée')->get();
        if(count($demandeurmanifestations)>0)
        {
            return view('direction.liste_nouvelletache',['demandeurmanifestations'=> $demandeurmanifestations]);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
    }
    else
        {
          return view('auth.login'); 
        }
}
public function tacheemployeencourdirection($id)
    {
        $editvalidations = 
        DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('*')
                    ->where('manifestations.id', $id)
                    ->where('etat','encours de traitement')->get();
         
        return view('direction.apercu_operationencourdepartement')->with('editvalidations',$editvalidations);
    }
    public function listetacherealiseedirection()
    {
        if(isset(Auth::user()->id))
        {
        $demandeurmanifestations= DB::table('manifestations')
                    ->join('users', 'users.id', '=', 'manifestations.id_user')
                    ->join('operations', 'manifestations.id', '=', 'id_manifestation') 
                    ->select('etat','date','departement_affecte', 'manifestations.id','commentaire','date_bedut','nom_departement','name','poste','besoin_manifestation','departement_envoi','manifestations.titre','departement_affecte','ficher','operations.id_user','id_manifestation','employer_affecter')
                    ->where('etat','traitée')
                    ->get(); 
        $demandeurnoms= DB::table('operations')
                    ->join('users', 'users.email', '=', 'operations.employer')
                    ->select('name','poste','users.id','operations.id_user','id_manifestation','employer')
                    ->get();
        if(count($demandeurmanifestations)>0)
        {
            return view('direction.liste_tacherealisee',['demandeurmanifestations'=> $demandeurmanifestations,'demandeurnoms'=>$demandeurnoms]);
        }
        else
        {
           return redirect()->route('home')->with('succes', 'Data has been successfully'); 
        }
    }
    else
        {
          return view('auth.login'); 
        }
}

//fin menu direction
}
