<?php

namespace App\Http\Controllers;
use App\Activite;
use App\Reporting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportingController extends Controller
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
        $activite =DB::table('activites')
         ->where('id',$request->activite)
        ->get();

        foreach ($activite as $activite) {
            $debut=$activite->date_debut;
            $fin=$activite->date_fin;
        }

         Reporting::create(['id_activite'=>$request->activite, 'date_debut'=>$debut, 'date_fin'=>$fin]);

        $activite1 = Activite::where('id','=',$request->activite);
        $activite1->update(['reporter'=>1,'date_debut'=>$request->date_debut,'date_fin'=>$request->date_fin]);
         

     session()->flash('success','Reporting efféctué avec succès');

        

        return redirect()->back();
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
        $reportings = DB::table('reportings')->where('id',$id)->get();
        return view('paos.reporting_edit',compact('reportings'));
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
        $reporting1 = Reporting::where('id','=',$id);

        if (isset($request->sup)) {
          //suppression
           $reporting1 = Reporting::where('id','=',$id);
         
              $reporting1->update(['supprimer'=>1]);
         

          
         session()->flash('success','Suppression effectuée avec succées');

         return redirect()->back();
         }else{

             $reporting1->update(['date_debut'=>$request->date_debut, 'date_fin'=>$request->date_fin]);

             

              session()->flash('success','modification effectuée avec succées');

         return redirect()->back();
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
