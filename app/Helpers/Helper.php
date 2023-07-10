<?php 

use App\Courrier;
use App\Affectation;
use App\Notification;
use App\Parametre;
use Illuminate\Support\Facades\DB;

if (! function_exists('active_route')) {
	function active_route($route){

		return Route::is($route) ? 'active' : '';


	}
}


if (! function_exists('langue')) {
	function langue(){
        
		$langue=Session::get('langue');
		if ($langue=="") {
			$langue="Fr";
		}
        return $langue;

	}
}

if (! function_exists('nomGroupe')) {
	function nomGroupe($id){

		$nom="";

		$groupes=DB::table('groupes')
        ->where('id',$id)
        ->get();



        foreach ($groupes as $groupe) {
        	$nom=$groupe->nom_groupe;
        }


		return $nom;


	}
}

if (! function_exists('nomUser')) {
	function nomUser($id){

		$nom="";

		$users=DB::table('users')
        ->where('id',$id)
        ->get();



        foreach ($users as $user) {
        	$nom=$user->name;
        }


		return $nom;


	}
}

if (! function_exists('nomDirection')) {
	function nomDirection($id){

		$nom="";

		$directions=DB::table('departements')
        ->where('id',$id)
        ->get();



        foreach ($directions as $direction) {
        	$nom=$direction->sigle;        }


		return $nom;


	}
}

if (! function_exists('priorite')) {
	function priorite($id){

		$nom="";

		$priorites=DB::table('priorites')
        ->where('id',$id)
        ->get();



        foreach ($priorites as $priorite) {
        	$nom=$priorite->priorite_name;
        }


		return $nom;


	}
}

if (! function_exists('nomProfil')) {
	function nomProfil($id){

		$nom="";

		$profils=DB::table('profils')
        ->where('id',$id)
        ->get();



        foreach ($profils as $profil) {
        	$nom=$profil->nom;
        }


		return $nom;


	}
}



if (! function_exists('nbrcourrierArrive')) {
	function nbrcourrierArrive(){

		$count = Courrier::where('type_courrier','=','Arrivée')->count();  

		return $count;

	}
}


if (! function_exists('nbrcourrierDepart')) {
	function nbrcourrierDepart(){

		$count = Courrier::where('type_courrier','=','Départ')->count();  

		return $count;

	}
}

if (! function_exists('nbrcourrierDepartdepartement')) {
    function nbrcourrierDepartdepartement(){

        $count = Courrier::where([['type_courrier', 'Départ'],['direction_suivie',Auth::user()->departement_id]])->count();  

        return $count;

    }
}


if (! function_exists('nbrcourrierTraite')) {
	function nbrcourrierTraite(){

		$count = Courrier::where('courrier_etat', 'Traité')->count();  
// $count = Courrier::where([['courrier_etat', 'Traité'],['courrier_etat', 'Traité']])->count();
		return $count;

	}
}

if (! function_exists('nbrcourrierTraitedepartement')) {
    function nbrcourrierTraitedepartement(){

        $count = Affectation::where([['statut_courrier', 'Traité'],['direction_affectation',Auth::user()->departement_id]])->count();  
// $count = Courrier::where([['courrier_etat', 'Traité'],['courrier_etat', 'Traité']])->count();
        return $count;

    }
}

if (! function_exists('nbrcourrierTraiteuser')) {
    function nbrcourrierTraiteuser(){

        $count = Affectation::where([['statut_courrier', 'Traité'],['user_affecter',Auth::user()->id]])->count();  
// $count = Courrier::where([['courrier_etat', 'Traité'],['courrier_etat', 'Traité']])->count();
        return $count;

    }
}


if (! function_exists('nbrcourrierAttente')) {
	function nbrcourrierAttente(){

		$count = Courrier::where('courrier_etat', 'attente')->count();  

		return $count;

	}
}

if (! function_exists('nbrcourrierAffecte')) {
	function nbrcourrierAffecte(){

		$count = Courrier::where('courrier_etat', 'Affecté')->count();  

		return $count;

	}
}


if (! function_exists('nbrcourrierAffecteManager')) {
	function nbrcourrierAffecteManager(){

$count = Affectation::where([['statut_courrier', 'Affecté'],['direction_affectation',Auth::user()->departement_id]])->count();
		 

		return $count;

	}
}


if (! function_exists('nbrcourrierAffecteUser')) {
    function nbrcourrierAffecteUser(){

$count = Affectation::where([['statut_courrier', 'Affecté'],['user_affecter',Auth::user()->id]])->count();
         

        return $count;

    }
}








if (! function_exists('active_profilMenu')) {
	function active_profilMenu($profil,$menu){

		$active="";

		$menuprofils=DB::table('menuprofils')
        ->where([['id_profil',$profil],['id_menu',$menu]])
        ->get();
          
          if ($menuprofils->count()>0) {
          	$active="checked";
          }


		return $active;


	}
}

if (! function_exists('photo')) {
	function photo($id){
		$photo="user.png";
		 $photo1 =DB::table('users')
        ->select('photo')        
        ->where('id','=', $id)
        ->get();
        foreach ($photo1 as $photo1) {
        	$photo=$photo1->photo;
        }

		return $photo;


	}
	}

 if (! function_exists('nom_activite')) {
    function nom_activite($id){
        $nom="";
         $activites =DB::table('activites')       
        ->where('id','=', $id)
        ->get();
        foreach ($activites as $activites) {
            $nom=$activites->libelle;
        }

        return $nom;


    }
    }




if (! function_exists('realise')) {
	function realise($direction,$debut,$fin){
		
     $requete="select * from activites where supprimer=0";
     if ($direction!=-1) {
            $requete.=" and direction=".$direction;
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
        $realise=0;
        foreach ($activite as $activites) {
        	 $realise+=$activites->niveau;
        }



		return $realise;


	}
	}






if (! function_exists('non_realise')) {
	function non_realise($direction,$debut,$fin){
		
     $requete="select * from activites where supprimer=0";
     if ($direction!=-1) {
            $requete.=" and direction=".$direction;
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
        $realise=0;$non_realise=0;
        $nb=count($activite);
        foreach ($activite as $activites) {
        	 $realise+=$activites->niveau;
        }

        $non_realise+=($nb*100)-$realise;

		return $non_realise;


	}
	}


if (! function_exists('traite')) {
    function traite(){
        
     $requete="select * from courriers where courrier_etat='Traité'";

        $count=DB::SELECT($requete);
     
        $traite=0;

        $traite= count($count);


        return $traite;

    }
    }

if (! function_exists('traitedesi')) {
    function traitedesi(){
        
     $requetedesi="select * from affectations where direction_affectation=2 and  statut_courrier='Traité'";
        $countdesi=DB::SELECT($requetedesi);
        $traitedesi=0;
        $traitedesi= count($countdesi);

        return $traitedesi;

    }
    }

if (! function_exists('traitedesiaff')) {
    function traitedesiaff(){
        
     $requetedesiaff="select * from affectations where direction_affectation=2 and  statut_courrier='Affecté'";
        $countdesiaff=DB::SELECT($requetedesiaff);
        $traitedesiaff=0;
        $traitedesiaff= count($countdesiaff);

        return $traitedesiaff;

    }
    }


    if (! function_exists('traitedae')) {
    function traitedae(){
        
     $requetedae="select * from affectations where direction_affectation=4 and  statut_courrier='Traité'";
        $countdae=DB::SELECT($requetedae);
        $traitedae=0;
        $traitedae= count($countdae);

        return $traitedae;

    }
    }

    if (! function_exists('traitedaeaff')) {
    function traitedaeaff(){
        
     $requetedaeaff="select * from affectations where direction_affectation=4 and  statut_courrier='Affecté'";
        $countdaeaff=DB::SELECT($requetedaeaff);
        $traitedaeaff=0;
        $traitedaeaff= count($countdaeaff);

        return $traitedaeaff;

    }
    }

    if (! function_exists('traitedpi')) {
    function traitedpi(){
        
     $requetedpi="select * from affectations where direction_affectation=1 and  statut_courrier='Traité'";
        $countdpi=DB::SELECT($requetedpi);
        $traitedpi=0;
        $traitedpi= count($countdpi);

        return $traitedpi;

    }
    }

     if (! function_exists('traitedpiaff')) {
    function traitedpiaff(){
        
     $requetedpiaff="select * from affectations where direction_affectation=1 and  statut_courrier='Affecté'";
        $countdpiaff=DB::SELECT($requetedpiaff);
        $traitedpiaff=0;
        $traitedpiaff= count($countdpiaff);

        return $traitedpiaff;

    }
    }

    if (! function_exists('traitegu')) {
    function traitegu(){
        
     $requetegu="select * from affectations where direction_affectation=6 and  statut_courrier='Traité'";
        $countgu=DB::SELECT($requetegu);
        $traitegu=0;
        $traitegu= count($countgu);

        return $traitegu;

    }
    }

    if (! function_exists('traiteguaff')) {
    function traiteguaff(){
        
     $requeteguaff="select * from affectations where direction_affectation=6 and  statut_courrier='Affecté'";
        $countguaff=DB::SELECT($requeteguaff);
        $traiteguaff=0;
        $traiteguaff= count($countguaff);

        return $traiteguaff;

    }
    }

    if (! function_exists('traitesaf')) {
    function traitesaf(){
        
     $requetesaf="select * from affectations where direction_affectation=11 and  statut_courrier='Traité'";
        $countsaf=DB::SELECT($requetesaf);
        $traitesaf=0;
        $traitesaf= count($countsaf);

        return $traitesaf;

    }
    }

     if (! function_exists('traitesafaff')) {
    function traitesafaff(){
        
     $requetesafaff="select * from affectations where direction_affectation=11 and  statut_courrier='Affecté'";
        $countsafaff=DB::SELECT($requetesafaff);
        $traitesafaff=0;
        $traitesafaff= count($countsafaff);

        return $traitesafaff;

    }
    }

    if (! function_exists('traitedga')) {
    function traitedga(){
        
     $requetedga="select * from affectations where direction_affectation=5 and  statut_courrier='Traité'";
        $countdga=DB::SELECT($requetedga);
        $traitedga=0;
        $traitedga= count($countdga);

        return $traitedga;

    }
    }

    if (! function_exists('traitedgaaff')) {
    function traitedgaaff(){
        
     $requetedgaaff="select * from affectations where direction_affectation=5 and  statut_courrier='Affecté'";
        $countdgaaff=DB::SELECT($requetedgaaff);
        $traitedgaaff=0;
        $traitedgaaff= count($countdgaaff);

        return $traitedgaaff;

    }
    }



    if (! function_exists('non_traite')) {
    function non_traite(){
        
     $requeten="select * from courriers where courrier_etat='Affecte'";

        $countn=DB::SELECT($requeten);
     
        $non_traite=0;

        $non_traite= count($countn);

        return $non_traite;

    }
    }





	if (! function_exists('active_route')) {
	function active_route($route){

		return Route::is($route) ? 'active opened' : '';


	}
}

if (! function_exists('opened')) {
	function opened($route){

		return Route::is($route) ? 'opened' : '';


	}
}



 if (! function_exists('anneEnCours')) {
    function anneEnCours(){
        $annee=date('Y');
         $parametre=DB::table('parametres')
        ->select('annee')        
        ->where('id_user','=', Auth::user()->id)
        ->get();
        
        if ($parametre->count()<=0) {
            createUserParametre();
        }else{

            foreach ($parametre as $parametres) {
            $annee=$parametres->annee;

            }
        }

        return $annee;


    }
    }



if (! function_exists('createUserParametre')) {
    function createUserParametre(){
        
        $parametre=Parametre::create(['annee'=>date('Y'), 'id_user'=>Auth::user()->id]);


    }
    }


if (! function_exists('getAllSousActivites')) {
    function getAllSousActivites($id){


        return DB::table('sousactivites')       
        ->where('id_activite','=', $id)
        ->get();


    }
    }


    if (! function_exists('getNiveauActivite')) {
    function getNiveauActivite($id){

        $niveau=0;$asousactivite=0;$n=0;
        $activites=DB::table('activites')       
        ->where('id','=', $id)
        ->get();
        foreach ($activites as $activite) {
            $asousactivite=$activite->sousactivite;
            $niveau=$activite->niveau;
        }

        if ($asousactivite==1) {
           $sousactivites=DB::table('sousactivites')       
            ->where('id_activite','=', $id)
            ->get();
            foreach ($sousactivites as $sousactivite) {
                $n+=$sousactivite->niveau;
            }
            $niveau=$n;
        }



        return $niveau;


    }
    }



    if (! function_exists('getAllReportings')) {
    function getAllReportings($id){


        return DB::table('reportings')       
        ->where('id_activite','=', $id)
        ->get();


    }
    }


    if (! function_exists('getMyRapport')) {
    function getMyRapport($id){


        return DB::table('rapports')       
        ->where([['id_activite','=', $id],['id_user','=', Auth::user()->id]])
        ->get();


    }
    }


     if (! function_exists('getAllRapport')) {
    function getAllRapport($id){


        return DB::table('rapports')      
        ->where([['supprimer','=', 0],['id_activite','=', $id]])
        ->get();


    }
    }

    if (! function_exists('nom_direction')) {
	function nom_direction($id){
		$nom="";
		 $directions =DB::table('departements')
        ->select('nom')        
        ->where('id','=', $id)
        ->get();
        foreach ($directions as $directions) {
        	$nom=$directions->nom;
        }

		return $nom;


	}
	}



if (! function_exists('getCurrentApp')) {
	function getCurrentApp(){
        
		$getCurrentApp=Session::get('getCurrentApp');
		
        return $getCurrentApp;

	}
}
 ?>




 