<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Participantdepartement;
use auth;

class ParticipantdepartementController extends Controller
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
         Participantdepartement::create(['nom'=>$request->nom,'id_reuniondepartement'=>$request->reuniondepartement]);

     session()->flash('success','Participant ajouté avec succés');

        

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
        //
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
        $participantdepartement1 = Participantdepartement::where('id','=',$id);

        if (isset($request->sup)) {
          //suppression
           $participantdepartement1 = Participantdepartement::where('id','=',$id);
         
              $participantdepartement1->update(['supprimer'=>1]);
         

          
         session()->flash('success','Suppression effectuée avec succées');

         return redirect()->back();
         }else{

             

              $participantdepartement1->update(['nom'=>$request->nom]);

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
