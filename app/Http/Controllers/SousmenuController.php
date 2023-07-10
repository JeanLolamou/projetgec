<?php

namespace App\Http\Controllers;

use App\Models\Sousmenu;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class SousmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sousmenus = DB::table('menus')
       ->join('sousmenus','menus.id', "=",'sousmenus.id_menu')
       ->select('sousmenus.*', 'menu_name')
       ->get();
      
      return view ('sousmenus.index')->with('sousmenus', $sousmenus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $menus = DB::table('menus')->where('actif', 1)->get();
       return view('sousmenus.create')->with('menus',$menus);
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
        Sousmenu::create($input);
        return redirect('addsousmenu')->with('success', 'Sous Menu Crée!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sousmenu  $sousmenu
     * @return \Illuminate\Http\Response
     */
    public function show(Sousmenu $sousmenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sousmenu  $sousmenu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sousmenus = Sousmenu::find($id);
               $menus = DB::table('menus')->where('actif', 1)->get();
        return view('sousmenus.edit',['sousmenus'=>$sousmenus,'menus'=>$menus,'id'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sousmenu  $sousmenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $sousmenu = Sousmenu::find($request->id);

         $input = $request->all();
         // var_dump("expression");die();
       $sousmenu->update($input);
        return redirect('listesousmenu')->with('success', 'Sous Menu Modifié!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sousmenu  $sousmenu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $sousmenu = Sousmenu::find($id);
        //  $sousmenu = DB::table('sousmenus')->where('actif', 1)->get();
        // $sousmenu->delete();
        
        // return redirect('listesousmenu')->with('success', ' Sous Menu Supprimé avec succès');
    }
}
