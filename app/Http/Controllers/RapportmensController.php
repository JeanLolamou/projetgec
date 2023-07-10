<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\RapportExport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Rapportmens;
use PDF;

use Illuminate\Support\Facades\Auth;

class RapportmensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

 

    public function index(Request $request)
    {

$data = $this->getActivitesWithQuery($request);
      $rapportmen = $data['rapportmen'];
      $direction = $data['direction'];
      $query = "direction=$request->direction&date=$request->date&mois=$request->mois";
      return view('paos.rapportmens',compact('rapportmen','direction',"query"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $activites = DB::table('activites')->where('supprimer',1)->get();
       return view('paos.rapportmens_ajout')->with('activites',$activites);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       $rapportmen = Rapportmens::create(['date'=>$request->date,'rapport'=>$request->rapport,'delai'=>$request->delai,'responsable'=>Auth::user()->name,'lien'=>$request->lien,'niveau'=>$request->niveau,'activite_pao'=>$request->activite_pao, 'id_direction'=>Auth::user()->departement_id, 'id_user'=>Auth::user()->user_role,'rapportplan'=>$request->rapportplan,'positif'=>$request->positif,'defis'=>$request->defis,'solution'=>$request->solution,'type_rapport'=>$request->type_rapport,'mois'=>$request->mois,'semaine'=>$request->semaine]);

     session()->flash('message','Rapport mensuel ajouté avec succés');

        

        return redirect()->route('rapportmen');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rapportmen = DB::table('rapportmens')->where('id',$id)->get();

        $directions = DB::table('directions')->where('supprimer',0)->get();




        return view('paos.rapportmens_details',compact('rapportmen'))->with('directions',$directions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

          $rapportmen = DB::table('rapportmens')->where('id',$id)->get();

          $activites = DB::table('activites')->where('supprimer',0)->get();

        return view('paos.rapportmens_edit',compact('rapportmen'))->with('activites',$activites);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

 

    public function update(Request $request, $id)
    {  if(isset(Auth::user()->id))
        {
            // dd();
           
            $rapport1 = Rapportmens::where('id','=',$id);
           
          
           $rapport1->update(['date'=>$request->date,'rapport'=>$request->rapport,'delai'=>$request->delai, 'lien'=>$request->lien,'niveau'=>$request->niveau,'activite_pao'=>$request->activite_pao,'rapportplan'=>$request->rapportplan,'positif'=>$request->positif,'defis'=>$request->defis,'solution'=>$request->solution,'type_rapport'=>$request->type_rapport,'mois'=>$request->mois,'semaine'=>$request->semaine]);

         return redirect()->route('rapportmen')->with('success', 'Information Direction Modifier avec succès');
           }
    else
        {
          return view('auth.login'); 
        }
    }

    

        // $rapport1 = Rapport::where('id','=',$id);

        // if (isset($request->sup)) {
        //   //suppression
        //    $rapport1 = Rapport::where('id','=',$id);
         
        //       $rapport1->update(['supprimer'=>1]);
         

          
        //  session()->flash('message','Suppression effectuée avec succées');

        //  return redirect()->route('rapport');
        //  }else{

             

        //     $rapport1->update(['date'=>$request->date,'rapport'=>$request->rapport,'delai'=>$request->delai,'responsable'=>$request->responsable,'id_direction'=>$request->id_direction, 'lien'=>$request->lien,'niveau'=>$request->niveau,'activite_pao'=>$request->activite_pao]);

        //       session()->flash('message','modification effectuée avec succées');

        
    

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


    public function globalmens()
    {
       if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==3)||(Auth::user()->user_role==8))

           {       
        
           // $globalrapportmen = DB::table('rapportmens')->where('supprimer',0)->orderBY('id','DESC')->get();      

        $direction = DB::table('departements')->where('actif',1)->get();
        // $activite = DB::table('activites')->where('supprimer',1)->get();

        $globalrapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
        // ->join('activites','activites.id', "=",'rapports.id_activite')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_user',5],['rapportmens.type_rapport','Mensuel']])
       ->orderBY('id','DESC')
       
       ->select('rapportmens.*', 'departements.sigle')
       // ->select('rapports.*', 'departements.nom', 'activites.libelle')
       ->get();
}
return view('paos.globalrapportmens',['rapportmen'=>$rapportmen, 'direction'=>$direction]);

    }


    public function search()
    {
        // $search=$request->get('search');
        $search_text = $_GET['query'];

        $rapport = DB::table('rapports')
        ->orWhere('date','like','%'.$search_text.'%')
        ->orWhere('rapport','like','%'.$search_text.'%')
         ->orWhere('id_direction','like','%'.$search_text.'%')
         ->orWhere('responsable','like','%'.$search_text.'%')
         ->where('supprimer',0)->take(500)->get();

         $rapport = DB::table('directions')
       ->join('rapports','directions.id', "=",'rapports.id_direction')
       ->select('rapports.*', 'nom')
       ->get();

        

        return view('paos.search',compact('search_text','rapport'));
    }

     public function global()
    {
      $direction = DB::table('departements')->where('actif',1)->get();
         $rapportmen = DB::table('rapportmens')->where('supprimer',1)->get();
       return view('paos.rapportmens_global',['rapportmen'=>$rapportmen, 'direction'=>$direction]);
    }

     public function globalmanager()
    {
      $direction = DB::table('departements')->where('actif',1)->get();
         $rapportmen = DB::table('rapportmens')->where('supprimer',1)->get();
       return view('paos.rapportmens_globalman',['rapportmen'=>$rapportmen, 'direction'=>$direction]);
    }

    public function export_rapportmens(Request $request)
  {
    $data = $this->getActivitesWithQuery($request);
    $rapportmen = $data['rapportmen'];
    $direction = $data['direction'];

    if($request->format == "excel")
    {
      return Excel::download(new ActiviteExport($data), 'rapportmens.xlsx');
    } else{
      $pdf = PDF::loadView('exports.rapportmens', 
                            compact("data")
                          )->setPaper('a4', 'landscape');
      return $pdf->stream('rapportmens.pdf');
    }

    
  }

  public function getActivitesWithQuery(Request $request)
  {
      $direction = DB::table('departements')->where('actif',1)->get();

        if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==3)||(Auth::user()->user_role==8)||(Auth::user()->user_role==4))

           {  
        
           $rapportmen = DB::table('rapportmens')->where('supprimer',0)->orderBY('id','DESC');      

        $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
        // ->join('activites','activites.id', "=",'rapports.id_activite')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_user',5]])
       
       ->select('rapportmens.*', 'departements.sigle') ;
}
elseif (Auth::user()->user_role==6) {
    
           $rapportmen = DB::table('rapportmens')->where([['supprimer',0],['id_user',Auth::user()->user_role]])->orderBY('id','DESC')->get();
  
        $rapportmen = DB::table('rapportmens')
      ->join('departements','departements.id', "=",'rapportmens.id_direction')
        // ->join('activites','activites.id', "=",'rapports.id_activite')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_user',Auth::user()->user_role],['rapportmens.id_direction',Auth::user()->departement_id],['rapportmens.responsable',Auth::user()->name]])
       ->select('rapportmens.*', 'departements.sigle');
}
elseif (Auth::user()->user_role==5) {
  
        $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
        // ->join('activites','activites.id', "=",'rapports.id_activite')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_direction',Auth::user()->departement_id]])
       ->select('rapportmens.*', 'departements.sigle');
}
       // dd($request->direction && $request->direction != "");

      if($request->direction && $request->direction != null)
      {
        $rapportmen = $rapportmen->where("id_direction", $request->direction);
      }

      if($request->mois && $request->mois != null)
      {
        $rapportmen = $rapportmen->where("mois", $request->mois);
      }

      if($request->date && $request->date != null)
      {
        $rapportmen = $rapportmen->whereDate("date","=", $request->date);
      }


      return [
        "direction" => $direction,
        "rapportmen" => $rapportmen->get()
      ];
    }

}
