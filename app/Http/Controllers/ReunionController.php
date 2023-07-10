<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Reunion;
use auth;

class ReunionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $reunion = DB::table('reunions')->where('supprimer',0)->orderBY('id','DESC')->get();
        return view('paos.reunion',compact('reunion'));
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
        $reunion = Reunion::create(['libelle'=>$request->libelle,'debut_seance'=>$request->debut_seance,'leve_seance'=>$request->leve_seance,'date'=>$request->date]);

     session()->flash('success','Reunion créée avec succés');

        

        return redirect()->route('listereunion');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reunion = DB::table('reunions')->where('id',$id)->get();

        return view('paos.reunion_details',compact('reunion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $reunion = DB::table('reunions')->where('id',$id)->get();
        return view('paos.reunion_edit',compact('reunion'));
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
         $reunion1 = Reunion::where('id','=',$id);
         

        if (isset($request->sup)) {
          //suppression
           $reunion1 = Reunion::where('id','=',$id);
         
              $reunion1->update(['supprimer'=>1]);
         

          
         session()->flash('success','Suppression effectuée avec succées');

         return redirect()->route('listereunion');
         }elseif (isset($request->ordre)) {
          //modif ordre du jour
          
            $reunion1->update(['ordre'=>$request->ordre]);

              session()->flash('success','modification effectuée avec succées');

         return redirect()->back();
         }else{

             

            $reunion1->update(['libelle'=>$request->libelle,'debut_seance'=>$request->debut_seance,'leve_seance'=>$request->leve_seance,'date'=>$request->date]);

              session()->flash('success','modification effectuée avec succées');

         return redirect()->route('editReunion',$id);
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
        //   $reunion = Reunion::find($id);
        // $reunion->delete();
        
        // return redirect('listereunion')->with('success', 'Menu Supprimé avec succès');
    }
}
