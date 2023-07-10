<?php

namespace App\Http\Controllers;
use App\Models\Notification;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poste;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
  public function index()
    {
       //$postes = DB::table('postes')->where('actif', 1)->get();
       //return view('users.create')->with('postes',$postes);
      

       $users= DB::table('postes')
       ->join('users','postes.id', "=",'users.id_poste')
        ->join('sousdepartements','sousdepartements.id', "=",'users.id_sousdepartement')
       ->select('users.*', 'User_poste', 'sousdepartement_name')
       ->get();

      return view ('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $departements = DB::table('departements')->where('actif', 1)->get();
        $postes = DB::table('postes')->where('actif', 1)->get();
        $sousdepartements = DB::table('sousdepartements')->where('actif', 1)->get();
         // var_dump("expression");die();
       return view('users.create',['postes'=>$postes, 'sousdepartements'=>$sousdepartements, 'departements'=>$departements]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	
        $user= new User();
       $user->name = $request->get('name');
       $user->email = $request->get('email');
       $user->telephone = $request->get('telephone');
       $user->password = Hash::make($request->get('password'));
       $user->id_poste = $request->get('id_poste');
       $user->id_sousdepartement = $request->get('id_sousdepartement');
       
       var_dump("expression");die();
       $user->save();
     return redirect('createUser')->with('success', 'User Crée!');
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

         $users = User::find($id);
         $postes = DB::table('postes')->where('actif', 1)->get();
         $sousdepartements = DB::table('sousdepartements')->where('actif', 1)->get();
        return view('users.edit',['users'=>$users,'postes'=>$postes, 'sousdepartements'=>$sousdepartements, 'departements'=>$departements,'id'=>$id]);
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
         $user = User::find($id);
         $input = $request->all();
       $user->update($input);
        return redirect('showUser')->with('success', 'Utilisateur Modifié!');
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
