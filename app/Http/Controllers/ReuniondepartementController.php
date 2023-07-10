<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Reuniondepartement;
use Illuminate\Support\Facades\Auth;

class ReuniondepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


       
        $direction = DB::table('departements')->where('actif',1)->get();

 $reuniondepartement = DB::table('reuniondepartements')
         ->where([['reuniondepartements.supprimer',0],['reuniondepartements.id_direction',Auth::user()->departement_id]])
        ->orderBY('id','DESC')
        ->get();
        return view('paos.reuniondepartement',compact('reuniondepartement'));
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
        $reuniondepartement = Reuniondepartement::create(['libelle'=>$request->libelle,'debut_seance'=>$request->debut_seance,'leve_seance'=>$request->leve_seance,'date'=>$request->date,'id_direction'=>Auth::user()->departement_id]);

     session()->flash('success','Reunion créée avec succés');

        

        return redirect()->route('listereuniondepartement');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reuniondepartement = DB::table('reuniondepartements')->where('id',$id)->get();

        return view('paos.reuniondepartement_details',compact('reuniondepartement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $reuniondepartement = DB::table('reuniondepartements')->where('id',$id)->get();
        return view('paos.reuniondepartement_edit',compact('reuniondepartement'));
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
         $reuniondepartement1 = Reuniondepartement::where('id','=',$id);
         

        if (isset($request->sup)) {
          //suppression
           $reuniondepartement1 = Reuniondepartement::where('id','=',$id);
         
              $reuniondepartement1->update(['supprimer'=>1]);
         

          
         session()->flash('success','Suppression effectuée avec succées');

         return redirect()->route('listereuniondepartement');
         }elseif (isset($request->ordre)) {
          //modif ordre du jour
          
            $reuniondepartement1->update(['ordre'=>$request->ordre]);

              session()->flash('success','modification effectuée avec succées');

         return redirect()->back();
         }else{

             

            $reuniondepartement1->update(['libelle'=>$request->libelle,'debut_seance'=>$request->debut_seance,'leve_seance'=>$request->leve_seance,'date'=>$request->date]);

              session()->flash('success','modification effectuée avec succées');

         return redirect()->route('editReuniondepartement',$id);
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
