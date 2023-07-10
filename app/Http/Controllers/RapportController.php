<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\HebdoExport;
use App\Rapport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Auth;
use PDF;

class RapportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

 

    public function index(Request $request)
    {
        $data = $this->getActivitesWithQuery($request);
      $rapport = $data['rapport'];
      $direction = $data['direction'];
      $query = "direction=$request->direction&date=$request->date&mois=$request->mois&semaine=$request->semaine";
      return view('paos.rapport',compact('rapport','direction',"query"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $activites = DB::table('activites')->where('supprimer',1)->get();
       return view('paos.rapport_ajout')->with('activites',$activites);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       $rapport = Rapport::create(['date'=>$request->date,'rapport'=>$request->rapport,'delai'=>$request->delai,'responsable'=>Auth::user()->name,'lien'=>$request->lien,'niveau'=>$request->niveau,'activite_pao'=>$request->activite_pao, 'id_direction'=>Auth::user()->departement_id, 'id_user'=>Auth::user()->user_role,'rapportplan'=>$request->rapportplan,'defis'=>$request->defis,'demarche'=>$request->demarche,'decision'=>$request->decision,'type_rapport'=>$request->type_rapport,'mois'=>$request->mois,'semaine'=>$request->semaine]);

     session()->flash('message','Rapport ajouté avec succés');

        

        return redirect()->route('rapport');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rapport = DB::table('rapports')->where('id',$id)->get();

        $directions = DB::table('directions')->where('supprimer',0)->get();




        return view('paos.rapport_details',compact('rapport'))->with('directions',$directions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

          $rapport = DB::table('rapports')->where('id',$id)->get();

          $activites = DB::table('activites')->where('supprimer',0)->get();

        return view('paos.rapport_edit',compact('rapport'))->with('activites',$activites);
        
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
           
            $rapport1 = Rapport::where('id','=',$id);
           
          
           $rapport1->update(['date'=>$request->date,'rapport'=>$request->rapport,'delai'=>$request->delai, 'lien'=>$request->lien,'niveau'=>$request->niveau,'activite_pao'=>$request->activite_pao,'rapportplan'=>$request->rapportplan,'defis'=>$request->defis,'demarche'=>$request->demarche,'decision'=>$request->decision,'type_rapport'=>$request->type_rapport,'mois'=>$request->mois,'semaine'=>$request->semaine]);

         return redirect()->route('rapport')->with('success', 'Information Direction Modifier avec succès');
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


     public function export_rapport(Request $request)
  {
    $data = $this->getActivitesWithQuery($request);
    $rapport = $data['rapport'];
    $direction = $data['direction'];

    if($request->format == "excel")
    {
      return Excel::download(new ActiviteExport($data), 'rapportmens.xlsx');
    } else{
      $pdf = PDF::loadView('exports.hebdo', 
                            compact("data")
                          )->setPaper('a4', 'landscape');
      return $pdf->stream('rapporthebdo.pdf');
    }

    
  }

  public function getActivitesWithQuery(Request $request)
  {
      $direction = DB::table('departements')->where('actif',1)->get();

         if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==3)||(Auth::user()->user_role==8)||(Auth::user()->user_role==4))

           {       
        
           $rapport = DB::table('rapports')->where('supprimer',0)->orderBY('id','DESC')->get();      
        $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
        // ->join('activites','activites.id', "=",'rapports.id_activite')
       ->where([['rapports.supprimer',0],['rapports.id_user',5]])
       
       ->select('rapports.*', 'departements.sigle');
}
elseif (Auth::user()->user_role==6) {
    
           $rapport = DB::table('rapports')->where([['supprimer',0],['id_user',Auth::user()->user_role]])->orderBY('id','DESC')->get();

        $rapport = DB::table('rapports')
      ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_user',Auth::user()->user_role],['rapports.id_direction',Auth::user()->departement_id],['rapports.responsable',Auth::user()->name]])
       ->select('rapports.*', 'departements.sigle');
}
elseif (Auth::user()->user_role==5) {
    
        $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_direction',Auth::user()->departement_id]])
       ->select('rapports.*', 'departements.sigle');
}
       // dd($request->direction && $request->direction != "");

      if($request->direction && $request->direction != null)
      {
        $rapport = $rapport->where("id_direction", $request->direction);
      }

      if($request->mois && $request->mois != null)
      {
        $rapport = $rapport->where("mois", $request->mois);
      }

      if($request->date && $request->date != null)
      {
        $rapport = $rapport->whereDate("date","=", $request->date);
      }

      if($request->semaine && $request->semaine != null)
      {
        $rapport = $rapport->where("semaine", $request->semaine);
      }


      return [
        "direction" => $direction,
        "rapport" => $rapport->get()
      ];
    }

     public function global()
    {
      $direction = DB::table('departements')->where('actif',1)->get();
         $rapport = DB::table('rapports')->where('supprimer',1)->get();
       return view('paos.rapport_global',['rapport'=>$rapport, 'direction'=>$direction]);
    }

     public function globalmanager()
    {
      $direction = DB::table('departements')->where('actif',1)->get();
         $rapport = DB::table('rapports')->where('supprimer',1)->get();
       return view('paos.rapport_globalman',['rapport'=>$rapport, 'direction'=>$direction]);
    }

}
