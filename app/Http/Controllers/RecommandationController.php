<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Recommandation;
use auth;

class RecommandationController extends Controller
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
         Recommandation::create(['details'=>$request->details,'id_reunion'=>$request->reunion]);

     session()->flash('success','Exposé ajouté avec succés');

        

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
        $recommandation1 = Recommandation::where('id','=',$id);

        if (isset($request->sup)) {
          //suppression
           $recommandation1 = Recommandation::where('id','=',$id);
         
              $recommandation1->update(['supprimer'=>1]);
         

          
         session()->flash('success','Suppression effectuée avec succées');

         return redirect()->back();
         }else{

             

              $recommandation1->update(['details'=>$request->details]);

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
