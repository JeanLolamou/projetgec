<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Direction;
use auth;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $direction =DB::table('directions')
         ->where('supprimer',0)
         ->orderBY('id')
        ->get();
        
        return view('paos.direction',compact('direction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Direction::create(['nom'=>$request->nom, 'description'=>$request->description,  'objectif'=>$request->objectif]);

     session()->flash('success','Direction ajoutée avec succès');

        

        return redirect()->route('listedirection');
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
        $direction = DB::table('directions')->where('id',$id)->get();
        
        return view('paos.direction_edit',compact('direction'));
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

         $direction1 = Direction::where('id','=',$id);

        if (isset($request->sup)) {
          //suppression
           $direction1 = Direction::where('id','=',$id);
         
              $direction1->update(['supprimer'=>1]);
         

          
         session()->flash('success','Suppression effectuée avec succées');

         return redirect()->back();
         }else{

             

              $direction1->update(['nom'=>$request->nom, 'description'=>$request->description,  'objectif'=>$request->objectif]);

              session()->flash('success','modification effectuée avec succées');

         return redirect()->route('editDirection',$id);
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
