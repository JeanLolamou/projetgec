<?php

namespace App\Http\Controllers;
use App\Poste;
use Illuminate\Support\Facades\Auth;

use DB;
use App\Affectation;
use App\Courrier;
use App\Reponse;
use App\Annotationtype;

use Illuminate\Http\Request;

class AnnotationtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { if(isset(Auth::user()->id))
        {
            
        $annotations = Annotationtype::where('actifAnnotation', 1)->get();
        
           return view('annotationtypes.index',['annotations'=>$annotations]);

    }
    else
        {
          return view('auth.login'); 
        }   

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(isset(Auth::user()->id))
        { 
            
         return view('annotationtypes.create');
    }
    else
        {
          return view('auth.login'); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { if(isset(Auth::user()->id))
        {
        $annoation= new Annotationtype();
       $annoation->commentairAnnotation  = $request->get('annotation');
      
       $annoation->save();

        return redirect()->route('addannotation')->with('success', 'Type d\' Annotation Enregistrée avec succè');
         }
    else
        {
          return view('auth.login'); 
        }
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
       if(isset(Auth::user()->id))
        {
           
         $editannotations = Annotationtype::findOrFail($id);
        return view('annotationtypes.edit',['editannotations'=>$editannotations]);
          }
    else
        {
          return view('auth.login'); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {  if(isset(Auth::user()->id))
        {
          $annotation = Annotationtype::findOrFail($request->id);
          $annotation->update(['commentairAnnotation' => $request->commentairAnnotation]);
         return redirect()->route('annotation')->with('success', 'Annotation type Modifier avec succès');
           }
    else
        {
          return view('auth.login'); 
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
