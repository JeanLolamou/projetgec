<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Activite;
use App\Exports\ActiviteExport;
use Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use PDF;
use Illuminate\Support\Facades\Auth;

class ActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Request $request)
    {
      $data = $this->getActivitesWithQuery($request);
      $activite = $data['activite'];
      $direction = $data['direction'];
      $query = "direction=$request->direction&statut=$request->statut&date_debut=$request->date_debut&date_fin=$request->date_fin";
      return view('paos.activite',compact('activite','direction',"query"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $direction = DB::table('departements')->where('actif',1)->get();
        
        return view('paos.activite_ajout',compact('direction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         
        $activite = Activite::create(['libelle'=>$request->libelle, 'indicateur'=>$request->indicateur, 'statut'=>$request->statut, 'niveau'=>$request->niveau,'date_prevue'=>$request->date_prevue,'date_revue'=>$request->date_revue, 'date_debut'=>$request->date_debut, 'date_fin'=>$request->date_fin, 'resultat_attendu'=>$request->resultat_attendu, 'finan_prev'=>$request->finan_prev, 'etat_finan'=>$request->etat_finan, 'commentaire'=>$request->commentaire, 'id_direction'=>Auth::user()->departement_id,'budget'=>$request->budget]);
        // var_dump("expression");die();


         

     session()->flash('success','Activité ajoutée avec succès');

        

        return redirect()->route('activite');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activite = DB::table('activites')->where('id',$id)->get();
       //  $activite = DB::table('directions')
       // ->join('activites','nom', "=",'activites.direction')
       // ->select('activites.*', 'nom')
       // ->where('activites.id',$id)->get();

        return view('paos.activite_details',compact('activite'));
    }

    public function search(Request $request)
    {
        $activite = DB::table('activites')->where('id',$id)->get();
       //  $activite = DB::table('directions')
       // ->join('activites','nom', "=",'activites.direction')
       // ->select('activites.*', 'nom')
       // ->where('activites.id',$id)->get();

        return view('paos.activite_details',compact('activite'));
    }


    public function activite(Request $request)
    {   

       $annee=anneEnCours();
             $debut1=date($annee.'-01-01');
           $fin1=date($annee.'-12-31');

        if (isset($request->date_debut)) {
           $requete="select * from activites where supprimer=0";
        }else{
          $requete="select * from activites where supprimer=0 and date_debut>='$debut1'";
        }
        $exist_dir=$request->direction;
        $exist_statut=$request->statut;
        $exist_debut=$request->date_debut;
        $exist_fin=$request->date_fin;


        if (isset($request->direction) and ($request->direction!=-1)) {
            $requete.=" and direction=".$request->direction;
        }

        if (isset($request->statut) and ($request->statut!=-1)) {
           $requete.=" and statut=".$request->statut;
        }

        if (isset($request->date_debut)) {
           $debut=date($request->date_debut);
           $requete.=" and date_debut>='$debut'";
        }

        if (isset($request->date_fin)) {
           $fin=date($request->date_fin);
           $requete.=" and date_fin<='$fin'";
        }


          $requete.=" order BY id DESC";

         $activite=DB::SELECT($requete);

        $direction = DB::table('departements')->where('actif',1)->get();
        $activite = DB::table('departements')
       ->join('activites','departements.id', "=",'activites.id_direction')
       ->select('activites.*', 'departements.sigle')
       ->get();
        
        if ($request->page==1) {
           return view('paos.index',compact('activite','direction','exist_dir','exist_statut','exist_debut','exist_fin'));
        }else{
            return view('paos.activite',compact('activite','direction','exist_dir','exist_statut','exist_debut','exist_fin'));
        }

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $activite = DB::table('activites')->where('id',$id)->get();


       $direction = DB::table('departements')->where('actif',1)->get();



        return view('paos.activite_edit',compact('activite','direction'));
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
        if(isset(Auth::user()->id))
        {
           // dd($request->direction);
           
          $activite1 = Activite::where('id','=',$id);
           
          
            $activite1->update(['libelle'=>$request->libelle, 'indicateur'=>$request->indicateur, 'statut'=>$request->statut, 'niveau'=>$request->niveau,'date_prevue'=>$request->date_prevue, 'date_revue'=>$request->date_revue, 'date_debut'=>$request->date_debut, 'date_fin'=>$request->date_fin, 'resultat_attendu'=>$request->resultat_attendu, 'finan_prev'=>$request->finan_prev, 'etat_finan'=>$request->etat_finan, 'commentaire'=>$request->commentaire,'budget'=>$request->budget]);

           session()->flash('success','modification effectuée avec succées');

         return redirect()->back();
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

  public function export_activite(Request $request)
  {
    $data = $this->getActivitesWithQuery($request);
    $activite = $data['activite'];
    $direction = $data['direction'];

    if($request->format == "excel")
    {
      return Excel::download(new ActiviteExport($data), "activites.xls");
    } else{
      $pdf = PDF::loadView('exports.activite', 
                            compact("data")
                          )->setPaper('a4', 'landscape');
      return $pdf->stream('activites.pdf');
    }

    
  }

  public function getActivitesWithQuery(Request $request)
  {
      $direction = DB::table('departements')->where('actif',1)->get();

      if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==3)||(Auth::user()->user_role==8)||(Auth::user()->user_role==4))
        {
            $activite = DB::table('activites')->where('supprimer',0)->orderBY('id','DESC')->get();

            $activite = DB::table('departements')
           ->join('activites','departements.id', "=",'activites.id_direction')
           ->select('activites.*', 'departements.sigle');
        }

        elseif (Auth::user()->user_role==5) 
        {
          $activite = DB::table('departements')
         ->join('activites','departements.id', "=",'activites.id_direction')
         ->where([['activites.supprimer',0],['activites.id_direction',Auth::user()->departement_id]])
         ->select('activites.*', 'departements.sigle');
       }
       elseif (Auth::user()->user_role==6) 
       {
          $activite = DB::table('departements')
                 ->join('activites','departements.id', "=",'activites.id_direction')
                 ->where([['activites.supprimer',0],['activites.id_direction',Auth::user()->departement_id]])
                 ->select('activites.*', 'departements.sigle');
       }

       // dd($request->direction && $request->direction != "");

      if($request->direction && $request->direction != null)
      {
        $activite = $activite->where("id_direction", $request->direction);
      }

      if($request->statut && $request->statut != null)
      {
        $activite = $activite->where("statut", $request->statut);
      }

      if($request->date_debut && $request->date_debut != null)
      {
        $activite = $activite->whereDate("date_debut",">=", $request->date_debut);
      }

      if($request->date_fin && $request->date_fin != null)
      {
        $activite = $activite->whereDate("date_fin","<=", $request->date_fin);
      }

      return [
        "direction" => $direction,
        "activite" => $activite->get()
      ];
    }

}
