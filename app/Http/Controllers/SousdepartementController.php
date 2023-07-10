<?php

namespace App\Http\Controllers;

use App\Models\Sousdepartement;
use Illuminate\Http\Request;
use App\Models\Departement;
use Illuminate\Support\Facades\DB;

class SousdepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $sousdepartements= DB::table('departements')
       ->join('sousdepartements','departements.id', "=",'sousdepartements.id_departement')
       ->select('sousdepartements.*', 'nom')
       ->get();
      
      return view ('sousdepartements.index')->with('sousdepartements', $sousdepartements);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departements = DB::table('departements')->where('actif', 1)->get();
       return view('sousdepartements.create')->with('departements',$departements);
        //return view('sousdepartements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $input = $request->all();
        Sousdepartement::create($input);
        return redirect('createSousdepartement')->with('success', 'Sous Departement Crée!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sousdepartement  $sousdepartement
     * @return \Illuminate\Http\Response
     */
    public function show(Sousdepartement $id)
    {
        $sousdepartement = Sousdepartement::find($id);
        return view('sousdepartements.show')->with('sousdepartements', $sousdepartement);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sousdepartement  $sousdepartement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $sousdepartements = Sousdepartement::find($id);
               $departements = DB::table('departements')->where('actif', 1)->get();
        return view('sousdepartements.edit',['sousdepartements'=>$sousdepartements,'departements'=>$departements,'id'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sousdepartement  $sousdepartement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $sousdepartement = Sousdepartement::find($request->id);

         $input = $request->all();
       $sousdepartement->update($input);
       
        return redirect('showSousdepartement')->with('success', 'Sous departement Modifié!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sousdepartement  $sousdepartement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sousdepartement $sousdepartement)
    {
        //
    }
}
