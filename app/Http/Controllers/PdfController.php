<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use PDF;
use DateTime;

class PdfController extends Controller
{
     public function pdfactivite($direction,$statut,$debut,$fin)
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_pdfactivite_to_html($direction,$statut,$debut,$fin))->setPaper('a4', 'landscape');
     return $pdf->stream();
    }

    public function convert_pdfactivite_to_html($direction,$statut,$debut,$fin)
    {   
       $requete="select * from activites where supprimer=1";

        if ($direction!=-1) {
            $requete.=" and direction=".$direction;
        }

        if ($statut!=-1) {
           $requete.=" and statut=".$statut;
        }

        if ($debut!=-1) {
           $debut=date($debut);
           $requete.=" and date_debut>='$debut'";
        }

        if ($fin!=-1) {
           $fin=date($fin);
           $requete.=" and date_fin<='$fin'";
        }


         $activite=DB::SELECT($requete);

         $activite = DB::table('departements')
       ->join('activites','departements.id', "=",'activites.id_direction')
       ->select('activites.*', 'sigle')
       ->get();

        $output='<p><h3 style="margin-left:10px;">République de Guinée</h3></p>
        <p><img src="images/armoirie.png" style="position: absolute;left: 5px;top: 30px;width:150px;height:120px;"/></p>
        <br><br><br><br><br><br>
<p style="margin-top:10x;margin-left:20px;"><h5><span style="color:red;">Travail</span><span style="color:yellow;"> Justice</span><span style="color:green;"> Solidarité</span></h5></p>
<p style="text-align:center;"><b><h3><u>Liste PAO</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:200px;height:180px;"/>
       
        <table width="100%" style="border-collapse: collapse; border:0px;">
        <thead>
           <tr style="">
            <th style="border:1px solid grey;paddind:12px;text-align: center;" >Directions</th>
          <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités</th>
          <th style="border:1px solid grey;paddind:12px;text-align: center;">Indicateurs</th>
          <th style="border:1px solid grey;paddind:12px;text-align: center;">Statuts</th>
          <th style="border:1px solid grey;paddind:12px;text-align: center;">Date</th>
          <th style="border:1px solid grey;paddind:12px;text-align: center;">Financement</th>
          <th style="border:1px solid grey;paddind:12px;text-align: center;">Résultat attendu</th>
          <th style="border:1px solid grey;paddind:12px;text-align: center;">Commentaires</th>
                </tr>
        </thead>
         <tbody>';
         foreach ($activite as $activites) {
            $statut="";
            if ($activites->statut==0) {
              $statut="Non démarré";
            }elseif ($activites->statut==2) {
              $statut="Terminé";
            }else{
              $statut="En Cours";
            }

            $niveau=0;
      if ($activites->niveau==100) {
      $niveau=100;
      }else{
      $niveau=$activites->niveau;
      }

           $output.='<tr>
                  <td style="font-weight: bold; color: blue;border:1px solid grey;paddind:12px;text-align: center;">
                    '.$activites->sigle.'
                    </td>
                  <td style="border:1px solid grey;paddind:12px;text-align: center;">'.$activites->libelle.'</td>   
                  <td style="border:1px solid grey;paddind:12px;text-align: center;">'.$activites->indicateur.'</td>
                  <td style="border:1px solid grey;paddind:12px;text-align: center;">'.$statut.'<br>'.$niveau.'% </td>
                  <td style="border:1px solid grey;paddind:12px;text-align: center;"><p>
                        <u style="font-style: italic;">Debut:</u>
                      </p>
                      <p style="color: #78b2e4;">'.(new DateTime($activites->date_debut))->format("d-M-Y").'</p>
                      <p>
                        <u style="font-style: italic;">Fin:</u>
                      </p>
                      <p style="color: #78b2e4;">'.(new DateTime($activites->date_fin))->format("d-M-Y").'</p></td>  
                  <td style="border:1px solid grey;paddind:12px;text-align: center;"><p>
                        <u style="font-style: italic;">Finacement prevu:</u>
                      </p>
                      <p style="color: #78b2e4;">'.$activites->finan_prev.'</p>
                      <p>
                        <u style="font-style: italic;">Etat Finacement:</u>
                      </p>
                      <p style="color: #78b2e4;">'.$activites->etat_finan.'</p></td>
                      <td style="border:1px solid grey;paddind:12px;text-align: center;">'.$activites->resultat_attendu.'</td>   
                  <td style="border:1px solid grey;paddind:12px;text-align: center;">'.$activites->commentaire.'</td>        
                </tr>
                ';
         }
           
        

        $output.='</tbody>
                 </table>';

    return $output;
    }



    public function pdfreunion($id)
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_pdfreunion_to_html($id));
     return $pdf->stream();
    }

    public function convert_pdfreunion_to_html($id)
    {   
       $reunion = DB::table('reunions')->where('id',$id)->get();

       foreach ($reunion as $reunions) {
         $date=$reunions->date;
         $ordre=$reunions->ordre;
         $debut=$reunions->debut_seance;
         $leve=$reunions->leve_seance;
       }

       $participant = DB::table('participants')->where([['id_reunion',$id],['supprimer',0]])->get();
       $expose = DB::table('exposes')->where([['id_reunion',$id],['supprimer',0]])->get();
       $action = DB::table('actions')->where([['id_reunion',$id],['supprimer',0]])->get();

       $recommandation = DB::table('recommandations')->where([['id_reunion',$id],['supprimer',0]])->get();

        $output='
        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>
<p style="text-align:center;"><b><h3><u>REUNION DE DIRECTION</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/></p>

<p><center>'.(new DateTime($date))->format("d M Y").'</center></p>
<p><center><u>Début séance<u></center></p>
<p><center>'.$debut.'</center></p>
<p><b><u>Ordre du Jour de la réunion</u></b></p>
<p>'.$ordre.'</p>
<p><b><u>Participants :</u></b></p>
<ol>
';

foreach ($participant as $participants) {
  $output.='<li>'.$participants->nom.'</li>';
}

$output.='</ol>
<p><center><b><u>L’exposé de la Directrice Générale et des Chefs de Départements</u></b></center></p><br>
 <table width="100%" style="border-collapse: collapse; border:0px;">
        <thead>
         <tr style="">
          <th style="border:1px solid grey;paddind:12px;text-align: center;">Directions</th>
          <th style="border:1px solid grey;paddind:12px;text-align: center;">Interventions</th>
                </tr>
        </thead>
         <tbody>';

         foreach ($expose as $exposes) {
   $output.='<tr>
                  <td style="font-weight: bold; color: blue;border:1px solid grey;paddind:12px;text-align: center;padding:10px;">
                    '.$exposes->exposant.'
                    </td>
                  <td style="border:1px solid grey;paddind:12px;text-align: center;padding:10px;">'.$exposes->details.'</td>   
                       
                </tr>
                ';
}

 $output.='</tbody>
                 </table>';

  $output.='
<p><b><u>Au titre des recommandations la Directrice Générale a instruit ce qui suit :</u></b></p>
<ul>
';

foreach ($recommandation as $recommandations) {
  $output.='<li>'.$recommandations->details.'</li>';
}



         $output.='</ol>
<p><center><b><u>Action à Mener</u></b></center></p><br>
 <table width="100%" style="border-collapse: collapse; border:0px;">
        <thead>
         <tr style="">
          <th style="border:1px solid grey;paddind:12px;text-align: center;">Actions</th>
          <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
          <th style="border:1px solid grey;paddind:12px;text-align: center;">Deadline</th>
                
                <th style="border:1px solid grey;paddind:12px;text-align: center;">Observations</th>
                </tr>
        </thead>
         <tbody>';

         foreach ($action as $actions) {
   $output.='<tr>
                  <td style="font-weight: ; color: black;border:1px solid grey;paddind:12px;text-align: center;padding:10px;">
                    '.$actions->actions.'
                    </td>
                    <td style="font-weight: bold; color: black;border:1px solid grey;paddind:12px;text-align: center;padding:10px;">
                    '.$actions->responsable.'
                    </td>
                    <td style="font-weight: bold; color: black;border:1px solid grey;paddind:12px;text-align: center;padding:10px;">
                    '.$actions->deadline.'
                    </td>
                  <td style="border:1px solid grey;paddind:12px;text-align: center;padding:10px;">'.$actions->observations.'</td>   
                       
                </tr>
                ';
}
$output.='</tbody>
                 </table>';


$output.='
<ul>
<p>La séance a été levée à '.$leve.'.</p
';

          

    return $output;
    }



    public function pdfreuniondepartement($id)
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_pdfreuniondepartement_to_html($id));
     return $pdf->stream();
    }

    public function convert_pdfreuniondepartement_to_html($id)
    {   
      $direction = DB::table('departements')->where('actif',1)->get();
       $reuniondepartement = DB::table('reuniondepartements')
       ->join('departements','departements.id', "=",'reuniondepartements.id_direction')
       ->where([['reuniondepartements.supprimer',0],['reuniondepartements.id_direction',Auth::user()->departement_id]])
        // ->join('activites','activites.id', "=",'rapports.id_activite')
       ->select('reuniondepartements.*', 'departements.sigle')
       ->get();

       foreach ($reuniondepartement as $reuniondepartements) {
         $date=$reuniondepartements->date;
         $ordre=$reuniondepartements->ordre;
         $debut=$reuniondepartements->debut_seance;
         $leve=$reuniondepartements->leve_seance;
         $departement=$reuniondepartements->sigle;
       }

       $participantdepartement = DB::table('participantdepartements')->where([['id_reuniondepartement',$id],['supprimer',0]])->get();
       $exposedepartement = DB::table('exposedepartements')->where([['id_reuniondepartement',$id],['supprimer',0]])->get();

       $recommandationdepartement = DB::table('recommandationdepartements')->where([['id_reuniondepartement',$id],['supprimer',0]])->get();

        $output='
       <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>
<p style="text-align:center;"><b><h3><u>REUNION DU DEPARTEMENT '.$departement.' </u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/></p>

<p><center>'.(new DateTime($date))->format("d M Y").'</center></p>
<p><center><u>Début séance<u></center></p>
<p><center>'.$debut.'</center></p>
<p><b><u>Ordre du Jour de la réunion</u></b></p>
<p>'.$ordre.'</p>
<p><b><u>Participants :</u></b></p>
<ol>
';

foreach ($participantdepartement as $participantdepartements) {
  $output.='<li>'.$participantdepartements->nom.'</li>';
}

$output.='</ol>
<p><center><b><u>L’exposé du Chef de Département et des Collaborateurs</u></b></center></p><br>
 <table width="100%" style="border-collapse: collapse; border:0px;">
        <thead>
         <tr style="">
          <th style="border:1px solid grey;paddind:12px;text-align: center;">Intervenants</th>
          <th style="border:1px solid grey;paddind:12px;text-align: center;">Interventions</th>
                </tr>
        </thead>
         <tbody>';

         foreach ($exposedepartement as $exposedepartements) {
   $output.='<tr>
                  <td style="font-weight: bold; color: blue;border:1px solid grey;paddind:12px;text-align: center;padding:10px;">
                    '.$exposedepartements->exposant.'
                    </td>
                  <td style="border:1px solid grey;paddind:12px;text-align: center;padding:10px;">'.$exposedepartements->details.'</td>   
                       
                </tr>
                ';
}

 $output.='</tbody>
                 </table>';

  $output.='
<p><b><u>Au titre des recommandations, le Chef du Département a instruit ce qui suit :</u></b></p>
<ul>
';

foreach ($recommandationdepartement as $recommandationdepartements) {
  $output.='<li>'.$recommandationdepartements->details.'</li>';
}

$output.='
<ul>
<p>La séance a été levée à '.$leve.'.</p
';

          

    return $output;
    }













    public function pdfrapport($direction,$debut,$fin)
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_pdfrapport_to_html($direction,$debut,$fin));
     return $pdf->stream();
    }

    public function convert_pdfrapport_to_html($direction,$debut,$fin)
    {   
       $requete="select * from rapports where supprimer=0";

        if ($direction!=-1) {
            $requete.=" and id_direction=".$direction;
        }

        if ($debut!=-1) {
           $debut=date($debut);
           $requete.=" and date>='$debut'";
        }

        if ($fin!=-1) {
           $fin=date($fin);
           $requete.=" and date<='$fin'";
        }

        if (Auth::user()->poste!="Administrateur") {
              $requete.=' and id_direction='.Auth::user()->id_direction.'';
           }


         $rapport=DB::SELECT($requete);

         $rapport = DB::table('departements')
       ->join('rapports','departements.id', "=",'rapports.id_direction')
       ->select('rapports.*', 'nom')
       ->get();

         

        $output='<p><h3 style="margin-left:10px;">République de Guinée</h3></p>
        <p><img src="images/armoirie.png" style="position: absolute;left: 5px;top: 30px;width:150px;height:120px;"/></p>
        <br><br><br><br><br><br>
<p style="margin-top:10x;margin-left:20px;"><h5><span style="color:red;">Travail</span><span style="color:yellow;"> Justice</span><span style="color:green;"> Solidarité</span></h5></p>
<p style="text-align:center;"><b><h3><u>Liste Rapport</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:200px;height:180px;"/>
       
        <table width="100%" style="border-collapse: collapse; border:0px;">
        <thead>
           <tr style="">
            <th style="border:1px solid grey;paddind:12px;text-align: center;">Date</th>
          <th style="border:1px solid grey;paddind:12px;text-align: center;">Directions</th>
          <th style="border:1px solid grey;paddind:12px;text-align: center;">Rapport</th>
                </tr>
        </thead>
         <tbody>';
           foreach ($rapport as $rapports) {
         
           $output.='<tr>
                   <td style="border:1px solid grey;paddind:12px;text-align: center;">'.(new DateTime($rapports->date))->format("d/m/Y").'</td> 
                  <td style="font-weight: bold; color: blue;border:1px solid grey;paddind:12px;text-align: center;">
                    '.$rapports->nom.'
                    </td>
                  <td style="border:1px solid grey;paddind:12px;text-align: center;">'.$rapports->rapport.'</td>        
                </tr>
                ';
         }
           
        

        $output.='</tbody>
                 </table>';

    return $output;
    }


    public function pdfrapportunique($id)
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_pdfrapportunique_to_html($id));
     return $pdf->stream();
    }

    public function convert_pdfrapportunique_to_html($id)
    {   
       $requete="select rapports.*, departements.sigle from rapports, departements where rapports.id_direction=departements.id and rapports.id=".$id;

      
          $rapport=DB::SELECT($requete);

        

         foreach ($rapport as $rapports) {

        $output='
       <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>
<p style="text-align:center;"> Date: '.(new DateTime($rapports->date))->format("d/m/Y"). 
' <br>   Direction : <b> '.$rapports->sigle.'</b> </p>
<p style="text-align:center;"><b><h3><u>Rapport Hebdomadaire de la '.$rapports->semaine.' du Mois de '.$rapports->mois.'</u></h3></b>



<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
           
$output.='<table cellspacing="0" style="border-collapse:collapse; width:720px">
  <tbody>
    <tr>
      <td colspan="3" style="background-color:#beeaf8; border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid black; border-top:1px solid #bfbfbf; height:53px; text-align:justify; vertical-align:middle; width:500px">
      <p style="text-align:center;"><strong>'.$rapports->activite_pao.'</strong></p>
      </td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; height:169px; vertical-align:middle; width:160px">
      <p style="text-align:center;"><strong>Principales activit&eacute;s&nbsp; r&eacute;alis&eacute;es cette semaine</strong></p>
      </td>
      <td colspan="2" style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; vertical-align:top; width:818px">
      '.$rapports->rapport.'
      </td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; height:188px; vertical-align:middle; width:160px">
      <p style="text-align:center;"><strong>Principales activit&eacute;s pr&eacute;vues la semaine prochaine</strong></p>
      </td>
      <td colspan="2" style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; vertical-align:top; width:818px">
      '.$rapports->rapportplan.'
      </td>
    </tr>
    <tr>
      <td colspan="2" style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; height:79px; vertical-align:top; width:500px">
      <p><strong>Principaux d&eacute;fis/risque</strong><strong>s</strong></p>

      '.$rapports->defis.'
      </td>
      <td style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; vertical-align:top; width:400px">
      <p><strong>D&eacute;marche de mitigation</strong></p>

      '.$rapports->demarche.'
      </td>
    </tr>
    <tr>
      <td colspan="3" style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; height:65px; vertical-align:top; width:971px">
      <p><strong>D&eacute;cisions cl&eacute;s requises</strong></p>

     '.$rapports->decision.'
      </td>
    </tr>
     </tbody>
</table>
 '
;
$output.=' </tbody>
</table> ';




          
         }
           
        
        $output.=' ';

    return $output;
    }




     public function pdfrapportmensunique($id)
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_pdfrapportmensunique_to_html($id));
     return $pdf->stream();
    }

    public function convert_pdfrapportmensunique_to_html($id)
    {   
       $requete="select rapportmens.*, departements.sigle from rapportmens, departements where rapportmens.id_direction=departements.id and rapportmens.id=".$id;

      
          $rapportmen=DB::SELECT($requete);

        

         foreach ($rapportmen as $rapportmens) {
$output='
        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;">Date: '.(new DateTime($rapportmens->date))->format("d/m/Y").
' <br>  Direction : <b> '.$rapportmens->sigle.'</b> </p>
<p style="text-align:center;"><b><h3><u>Rapport Mensuel de '.$rapportmens->mois.' </u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';


$output.='<table cellspacing="0" style="border-collapse:collapse; width:720px">
  <tbody>
    <tr>
      <td colspan="3" style="background-color:#beeaf8; border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid black; border-top:1px solid #bfbfbf; height:53px; text-align:justify; vertical-align:middle; width:500px">
      <p style="text-align:center;" ><strong>'.$rapportmens->activite_pao.'</strong></p>
      </td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; height:169px; vertical-align:middle; width:154px">
      <p style="text-align:center;"><strong>Activités Mensuelles Realisées</strong></p>
      </td>
      <td colspan="2" style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; vertical-align:top; width:818px">
      '.$rapportmens->rapport.'
      </td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; height:188px; vertical-align:middle; width:154px">
      <p style="text-align:center;"><strong>Priorités pour le mois prochain</strong></p>
      </td>
      <td colspan="2" style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; vertical-align:top; width:818px">
      '.$rapportmens->rapportplan.'
      </td>
    </tr>
   <tr>
      <td style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; height:188px; vertical-align:middle; width:154px">
      <p style="text-align:center;"><strong>Qu est-ce qui va bien? </strong></p>
      </td>
      <td colspan="2" style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; vertical-align:top; width:818px">
      '.$rapportmens->positif.'
      </td>
    </tr>
     <tr>
      <td style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; height:188px; vertical-align:middle; width:154px">
      <p style="text-align:center;"><strong>Quels sont les Principaux défis? </strong></p>
      </td>
      <td colspan="2" style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; vertical-align:top; width:818px">
      '.$rapportmens->defis.'
      </td>
    </tr>
     <tr>
      <td style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; height:188px; vertical-align:middle; width:154px">
      <p style="text-align:center;"><strong>Que faire pour relever ces défis? </strong></p>
      </td>
      <td colspan="2" style="border-bottom:1px solid #bfbfbf; border-left:1px solid #bfbfbf; border-right:1px solid #bfbfbf; border-top:1px solid #bfbfbf; vertical-align:top; width:818px">
      '.$rapportmens->solution.'
      </td>
    </tr>
    
     </tbody>
</table>
 '
;
         }
           
        

        $output.=' ';

    return $output;
    }

//Rendu PDF rapport global mensuel par mois pour la directrice

    public function janglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_janglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_janglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_user',5],['rapportmens.mois','Janvier']])
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Janvier</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function fevglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_fevglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_fevglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_user',5],['rapportmens.mois','Février']])  
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Février</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function marglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_marglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_marglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_user',5],['rapportmens.mois','Mars']]) 
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Mars</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function avrglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_avrglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_avrglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_user',5],['rapportmens.mois','Avril']])   
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Avril</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function maiglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_maiglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_maiglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_user',5],['rapportmens.mois','Mai']])   
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Mai</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function juinglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_juinglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_juinglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_user',5],['rapportmens.mois','Juin']])   
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Juin</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function juilglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_juilglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_juilglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_user',5],['rapportmens.mois','Juillet']])   
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Juillet</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function aoutglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_aoutglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_aoutglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_user',5],['rapportmens.mois','Août']])   
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Août</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function septglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_septglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_septglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_user',5],['rapportmens.mois','Septembre']]) 
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Septembre</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function octglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_octglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_octglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_user',5],['rapportmens.mois','Octobre']])  
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Octobre</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function novglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_novglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_novglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_user',5],['rapportmens.mois','Novembre']])  
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Novembre</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function decglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_decglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_decglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_user',5],['rapportmens.mois','Décembre']])   
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Décembre</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }
//Rendu PDF rapport global mensuel par mois pour la directrice




//Rendu PDF rapport global mensuel par mois pour le Manager

    public function janmaglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_janmaglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_janmaglobalpdfrapportmensunique_to_html()
    {   

    $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_direction',Auth::user()->departement_id],['rapportmens.mois','Janvier']])
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Janvier </u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function fevmaglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_fevmaglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_fevmaglobalpdfrapportmensunique_to_html()
    {   

    $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_direction',Auth::user()->departement_id],['rapportmens.mois','Février']])
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Février</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function marmaglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_marmaglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_marmaglobalpdfrapportmensunique_to_html()
    {   

    $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_direction',Auth::user()->departement_id],['rapportmens.mois','Mars']])
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Mars</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function avrmaglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_avrmaglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_avrmaglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_direction',Auth::user()->departement_id],['rapportmens.mois','Avril']])
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Avril</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function maimaglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_maimaglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_maimaglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_direction',Auth::user()->departement_id],['rapportmens.mois','Mai']])
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Mai</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function juinmaglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_juinmaglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_juinmaglobalpdfrapportmensunique_to_html()
    {   

    $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_direction',Auth::user()->departement_id],['rapportmens.mois','Juin']])
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Juin</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function juilmaglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_juilmaglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_juilmaglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_direction',Auth::user()->departement_id],['rapportmens.mois','Juillet']])
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Juillet</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function aoutmaglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_aoutmaglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_aoutmaglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_direction',Auth::user()->departement_id],['rapportmens.mois','Août']])
       ->select('rapportmens.*', 'departements.sigle')
       ->get();


$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Août</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function septmaglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_septmaglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_septmaglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_direction',Auth::user()->departement_id],['rapportmens.mois','Septembre']])
       ->select('rapportmens.*', 'departements.sigle')
       ->get();


$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Septembre</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function octmaglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_octmaglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_octmaglobalpdfrapportmensunique_to_html()
    {   

    $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_direction',Auth::user()->departement_id],['rapportmens.mois','Octobre']])
       ->select('rapportmens.*', 'departements.sigle')
       ->get();


$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Octobre</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function novmaglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_novmaglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_novmaglobalpdfrapportmensunique_to_html()
    {   

     $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_direction',Auth::user()->departement_id],['rapportmens.mois','Novembre']])
       ->select('rapportmens.*', 'departements.sigle')
       ->get();


$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Novembre</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function decmaglobalpdfrapportmensunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_decmaglobalpdfrapportmensunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_decmaglobalpdfrapportmensunique_to_html()
    {   

      $rapportmen = DB::table('rapportmens')
       ->join('departements','departements.id', "=",'rapportmens.id_direction')
       ->where([['rapportmens.supprimer',0],['rapportmens.id_direction',Auth::user()->departement_id],['rapportmens.mois','Décembre']])
       ->select('rapportmens.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel de Décembre</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Mensuel</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Priorités pour le prochain mois</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Quest-ce qui va bien?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis?</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapportmen as $rapportmens) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapportmens->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapportmens->sigle.'</b></td>
                  <td>'.$rapportmens->responsable.'</td>
                  <td>'.$rapportmens->activite_pao.'</td>
                   <td>'.$rapportmens->rapport.'</td>   
                   <td>'.$rapportmens->rapportplan.'</td> 
                   <td>'.$rapportmens->positif.'</td>
                   <td>'.$rapportmens->defis.'</td> 
                   <td>'.$rapportmens->solution.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }
//Rendu PDF rapport global mensuel par mois pour le Manager







    //Rendu PDF rapport global Hebdomadaire par mois pour la directrice

    public function janglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_janglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_janglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_user',5],['rapports.mois','Janvier']])
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Janvier</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réealisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requisess</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function fevglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_fevglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_fevglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_user',5],['rapports.mois','Février']])  
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Février</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
               <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                 <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function marglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_marglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_marglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_user',5],['rapports.mois','Mars']]) 
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Mars</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>    '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function avrglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_avrglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_avrglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_user',5],['rapports.mois','Avril']])   
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Avril</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
               <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function maiglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_maiglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_maiglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_user',5],['rapports.mois','Mai']])   
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Mai</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                 <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                   
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                 <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function juinglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_juinglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_juinglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_user',5],['rapports.mois','Juin']])   
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Juin</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                 <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function juilglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_juilglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_juilglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_user',5],['rapports.mois','Juillet']])   
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Juillet</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                 <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
               <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function aoutglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_aoutglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_aoutglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_user',5],['rapports.mois','Août']])   
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Août</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                 <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                 <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>    '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function septglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_septglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_septglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_user',5],['rapports.mois','Septembre']]) 
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Septembre</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                 <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>    '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function octglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_octglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_octglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_user',5],['rapports.mois','Octobre']])  
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Octobre</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>    '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function novglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_novglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_novglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_user',5],['rapports.mois','Novembre']])  
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Novembre</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                 <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function decglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_decglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_decglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_user',5],['rapports.mois','Décembre']])   
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Décembre</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                 <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>    '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }
//Rendu PDF rapport global hebdomadaire par mois pour la directrice




//Rendu PDF rapport global hebdomadaire par mois pour le Manager

    public function janmaglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_janmaglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_janmaglobalpdfrapportunique_to_html()
    {   

    $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_direction',Auth::user()->departement_id],['rapports.mois','Janvier']])
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Janvier </u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                    <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                   <td><b> '.$rapports->responsable.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>  '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function fevmaglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_fevmaglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_fevmaglobalpdfrapportunique_to_html()
    {   

    $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_direction',Auth::user()->departement_id],['rapports.mois','Février']])
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Février</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                    <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                   <td><b> '.$rapports->responsable.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>  '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function marmaglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_marmaglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_marmaglobalpdfrapportunique_to_html()
    {   

    $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_direction',Auth::user()->departement_id],['rapports.mois','Mars']])
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Mars</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                 <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                   <td><b> '.$rapports->responsable.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>  '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function avrmaglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_avrmaglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_avrmaglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_direction',Auth::user()->departement_id],['rapports.mois','Avril']])
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Avril</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                 <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                   <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                   <td><b> '.$rapports->responsable.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function maimaglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_maimaglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_maimaglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_direction',Auth::user()->departement_id],['rapports.mois','Mai']])
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Mai</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                    <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                   <td><b> '.$rapports->responsable.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function juinmaglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_juinmaglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_juinmaglobalpdfrapportunique_to_html()
    {   

    $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_direction',Auth::user()->departement_id],['rapports.mois','Juin']])
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Juin</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                 <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                    <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                   <td><b> '.$rapports->responsable.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>  '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function juilmaglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_juilmaglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_juilmaglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_direction',Auth::user()->departement_id],['rapports.mois','Juillet']])
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Juillet</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                 <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                   <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                   <td><b> '.$rapports->responsable.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>  '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function aoutmaglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_aoutmaglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_aoutmaglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_direction',Auth::user()->departement_id],['rapports.mois','Août']])
       ->select('rapports.*', 'departements.sigle')
       ->get();


$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Août</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                 <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                   <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                   <td><b> '.$rapports->responsable.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>  '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function septmaglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_septmaglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_septmaglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_direction',Auth::user()->departement_id],['rapports.mois','Septembre']])
       ->select('rapports.*', 'departements.sigle')
       ->get();


$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Septembre</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                    <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                   <td><b> '.$rapports->responsable.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>  '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function octmaglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_octmaglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_octmaglobalpdfrapportunique_to_html()
    {   

    $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_direction',Auth::user()->departement_id],['rapports.mois','Octobre']])
       ->select('rapports.*', 'departements.sigle')
       ->get();


$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Octobre</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                 <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                    <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                   <td><b> '.$rapports->responsable.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>  '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function novmaglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_novmaglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_novmaglobalpdfrapportunique_to_html()
    {   

     $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_direction',Auth::user()->departement_id],['rapports.mois','Novembre']])
       ->select('rapports.*', 'departements.sigle')
       ->get();


$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapports Hebdomadaires de Novembre</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                   <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                   <td><b> '.$rapports->responsable.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }


    public function decmaglobalpdfrapportunique()
    {   
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_decmaglobalpdfrapportunique_to_html())->setPaper('a4', 'landscape');;
     return $pdf->stream();
    }

    public function convert_decmaglobalpdfrapportunique_to_html()
    {   

      $rapport = DB::table('rapports')
       ->join('departements','departements.id', "=",'rapports.id_direction')
       ->where([['rapports.supprimer',0],['rapports.id_direction',Auth::user()->departement_id],['rapports.mois','Décembre']])
       ->select('rapports.*', 'departements.sigle')
       ->get();

$output='


        <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Hebdomadaire de Décembre</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
       
        ';
$output.='<table width="100%" style="border-collapse: collapse; border:0px;">
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Date de Réalisation</th>                    
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Direction</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Responsable</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Titre du Rapport Hebdomadaire</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités réalisées</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Activités prévues la prochaine semaine</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Principaux défis/risques</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Démarche de mitigation</th>
                    <th style="border:1px solid grey;paddind:12px;text-align: center;">Décisions clés requises</th>             
                  </tr>
                </thead> 
<tbody> '; 
          
           foreach ($rapport as $rapports) {
          $output.='
                <tr>
                  <td>'.(new DateTime($rapports->date))->format("d/m/Y").
'</td>
                 
                  <td><b> '.$rapports->sigle.'</b></td>
                  <td><b> '.$rapports->responsable.'</b></td>
                  <td>'.$rapports->semaine.'</td>
                  <td>'.$rapports->activite_pao.'</td>
                   <td>'.$rapports->rapport.'</td>   
                   <td>'.$rapports->rapportplan.'</td> 
                   <td>'.$rapports->defis.'</td>
                   <td>'.$rapports->demarche.'</td> 
                   <td>'.$rapports->decision.'</td>  
                </tr>   '
;
         }

         $output.='</tbody>
                 </table>';       

        $output.=' ';

    return $output;
    }
//Rendu PDF rapport global hebdomadaire par mois pour le Manager

}
