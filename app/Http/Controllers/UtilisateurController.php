<?php

namespace App\Http\Controllers;
use App\User;
use App\Models\Notification;
use DB;
use Mail;
use Illuminate\Support\Facades\Auth;
use App\Affectation;
use App\Models\Sousdepartement;
use App\Reponse;
use Illuminate\Http\Request;
use App\Departement;
use App\Service;
use App\Courrier;
use App\Poste;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Mail\MailModifiPass;


class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { if(isset(Auth::user()->id))
        {
        
        $departements=Departement::get();
         $sousdepartements=Sousdepartement::get();
        $utilisateurs= DB::table('users')
         // ->join('sousdepartements', 'sousdepartements.id', '=', 'id_sousdepartement')
         ->join('departements', 'departements.id', '=', 'departement_id')
         ->join('postes', 'postes.id', '=', 'user_role')
         ->select('users.*','departements.nom','postes.User_poste')
         ->get();
// ,'sousdepartement_name'
// var_dump("expression");die();
        
           return view('utilisateurs.index',['utilisateurs'=>$utilisateurs,'sousdepartements'=>$sousdepartements, 'departements'=>$departements]);
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
          
        
         $sousdepartements = Sousdepartement::where('actif', 1)->orderBy('sousdepartement_name', 'asc')->get();
           $postes = Poste::where('actif', 1)->orderBy('User_poste', 'asc')->get();


        return view('utilisateurs.create',['sousdepartements'=>$sousdepartements,'postes'=>$postes])->with('success', 'Utilisateur Enregistrée avec succès');
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

        
        $utlisateur= new User();
       $utlisateur->name = $request->get('name');
       $utlisateur->email = $request->get('email');
       $utlisateur->telephone = $request->get('telephone');
       $utlisateur->password = Hash::make($request->get('password'));
       $utlisateur->user_role = $request->get('poste');
       $utlisateur->departement_id = $request->get('id_departement');
        $utlisateur->id_sousdepartement = $request->get('id_sousdepartement');

       
        
       $utlisateur->save();
       return redirect()->route('adduser')->with('success', 'Information du Collaborateur Enregistrer avec succès');
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
          
            
         
       $departements = Departement::where('actif', 1)->get();
$postes = Poste::where('actif', 1)->get();
       $editusers= DB::table('users')
         ->join('departements', 'departements.id', '=', 'departement_id')
         ->select('users.*','departements.nom')
         ->where('users.id', $id)->get();

        return view('utilisateurs.modifUser',['departements'=>$departements,'editusers'=>$editusers,'postes'=>$postes]);
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
          
          $utilisateur = User::findOrFail($request->id);
          $utilisateur->update(['name' => $request->get('name'),'email' => $request->get('email'),'telephone' => $request->get('telephone'),'user_role'=>$request->get('poste'),'departement_id' => $request->get('direction'),'password'=>Hash::make($request->get('password'))]);
          return redirect()->back()->with('success', 'Information du Collaborateur Modifier avec succès');
       
    }

       public function updateprofil(Request $request)
    {
          
          $utilisateur = User::findOrFail($request->id);
          $utilisateur->update(['name' => $request->get('name'),'email' => $request->get('email')]);
          return redirect()->back()->with('success', 'Information du Collaborateur Modifier avec succès');
       
    }

        public function updatepassword(Request $request)
    {
          
          $utilisateur = User::findOrFail($request->id);
          $utilisateur->update(['password'=>Hash::make($request->get('password'))]);
          return redirect()->back()->with('success', 'Information du Collaborateur Modifier avec succès');
       
    }

    
    
      public function updateActif(Request $request)
    {
          $users= User::where('id',$request->id)->get();
          $utilisateur = User::findOrFail($request->id);
          foreach ($users as $key => $value) {
            if($value->user_statut==1)
            {
               $utilisateur->update(['user_statut' => 0]);
               return redirect()->route('utilisateur')->with('success', 'Compte du Collaborateur est desactivé avec succès');
            }
          
         else
         {
             $utilisateur->update(['user_statut' => 1]);
             return redirect()->route('utilisateur')->with('success', 'Compte du Collaborateur est activé avec succès');
         }
       
    }
}
 
 public function emailverification()
{
    return view('utilisateurs.verificationMail');
}
public function envoiMail(Request $request)
{
     $responsables=User::where('email',$request->email)->get();

          foreach ($responsables as $responsable) {
           $emailresponsable=$responsable->email;
            $nomresponsable=$responsable->name;
               $lien="http://courrier.apipguinee.com/editUserMdp/".$responsable->id;
         
          }
         
            Mail::to($emailresponsable)->send(new MailModifiPass($nomresponsable,$lien));
            return redirect()->route('motdepassoublier')->with('success','Veillez verifier votre adresse email, un mail vous a été envoyé.')->withInput();
}
   public function editmdp($id)
    {
        $editusers = User::where('id',$id)->get();
        return view('utilisateurs.edit')->with('editusers', $editusers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatemdp(Request $request)
    {
          $utilisateur = User::findOrFail($request->id);
          $utilisateur->update(['password' => Hash::make($request->get('password'))]);
         
   return view('auth.login'); 
}
     public function pagesucces()
     {

        return view('utilisateurs.page');
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


     public function pageuser()
    {
        
        $departements = Departement::where('actif', 1)->get();
        $postes = Poste::where('actif', 1)->get();
        $personnel =DB::table('users')
         ->where('id',Auth::user()->id)
        ->get();

        return view('utilisateurs.pageuser',['personnel'=>$personnel,'postes'=>$postes,'departements'=>$departements]);


    }
   
    
}
