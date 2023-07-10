<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();

      return view ('menus.index')->with('menus', $menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $menu = new Menu();
       $menu->menu_name = $request->get('menu_name');
      
       $menu->save();
        /**$input = $request->all();
        Menu::create($input);
        return redirect('createMenu')->with('success', 'Menu Crée!');*/
        return redirect()->route('addmenu')->with('success', 'Menu Enregistrée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editmenus = Menu::find($id);
         return view('menus.edit',['editmenus'=>$editmenus]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $menu = Menu::findOrFail($request->id);
          $menu->update(['menu_name' => $request->menu_name]);
       return redirect()->route('listemenu')->with('success', 'Menu Modifié avec succès');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $menu = Menu::find($id);
        $menu->delete();
        
        return redirect('listemenu')->with('success', 'Menu Supprimé avec succès');
    }
}
