

 <div class="sh-logopanel">
      <a style="text-decoration:none" href="" class="sh-logo-text"><b style="font-size: 20pt"></b> </a>
      <div class="media align-items-center"> <span> <img class="text-logo" src="{{asset('images/log.png')}}" style="height: 100px;"> </span></div>
     
      <a id="navicon" href="" class="sh-navicon d-none d-xl-block"><i class="icon ion-navicon"></i></a>
      <a id="naviconMobile" href="" class="sh-navicon d-xl-none"><i class="icon ion-navicon"></i></a>
    </div><!-- sh-logopanel -->
@if(isset(Auth::user()->id)AND(Auth::user()->user_statut==1))

    <div class="sh-sideleft-menu">
      <label class="sh-sidebar-label"></label>
      <ul class="nav">
        <li class="nav-item">
          <a href="/dashboard" class="nav-link active">
            <i class="icon ion-ios-home-outline"></i>
            <span>Tableau de bord</span>
          </a>
        </li><!-- nav-item -->
        
        
         @if(getCurrentApp()=='gec')
              @include('pages/_menu_gec')
            @elseif(getCurrentApp()=='pao')
               @include('templates/partials/_menu_pao')
            @elseif(getCurrentApp()=='besoin')
              @include('templates/partials/_menu_manifbesoin')
            @endif
       
       
        <li class="nav-item">
          <a href="" class="nav-link with-sub">
            <img src="{{asset('images/mai.png')}}"  title="Nouveau PAO" style="height: 35px;">
          <!--   <i class="icon ion-ios-email-outline"></i> -->
            <span>Courriers</span>
          </a>
          
          <ul class="nav-sub">

            @if(Auth::user()->user_role==3)
           <!--  <li class="nav-item"><a href="/listeCourrierDepart" class="nav-link">Départ</a></li>
              <li class="nav-item"><a href="/listeCourrierArrive" class="nav-link">Arrivée</a></li> -->
              <li class="nav-item"><a href="/listeCourrierDepart" class="nav-link">Départ<div class="pull-right box "> {{nbrcourrierDepartdepartement()}}</div>  </a></li>
               <li class="nav-item"><a href="/listeCourrierAttenteCollaborateur" class="nav-link">Envoyé aux collaborateurs</a></li> 

           <li class="nav-item"><a href="/listeCourrierAffecter" class="nav-link">En Attente de Traitement</a></li>
            <li class="nav-item"><a href="/listeCourrierTraite" class="nav-link">Traité</a></li>
             @endif
             
            @if((Auth::user()->user_role==2)||(Auth::user()->user_role==4)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8))

            <li class="nav-item"><a href="/listeCourrierDepart" class="nav-link">Départ<div class="pull-right box "> {{nbrcourrierDepart()}}</div>  </a></li>
             @endif
  @if((Auth::user()->user_role==5)||(Auth::user()->user_role==7))

            <li class="nav-item"><a href="/listeCourrierDepart" class="nav-link">Départ<div class="pull-right box "> {{nbrcourrierDepartdepartement()}}</div>  </a></li>
             @endif

            @if((Auth::user()->user_role==2)||(Auth::user()->user_role==4)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8))

            <li class="nav-item"><a href="/listeCourrierArrive" class="nav-link">Arrivée<div class="pull-right box "> {{nbrcourrierArrive()}}</div> </a></li> 
            <li class="nav-item"><a href="/listeCourrierAttente" class="nav-link">En Attente d'annotation<div class="pull-right box "> {{nbrcourrierAttente()}}</div> </a></li>
             <li class="nav-item"><a href="/listeCourrierAffecter" class="nav-link">En Attente de Traitement <div class="pull-right box "> {{nbrcourrierAffecte()}}</div></a></li>
            <li class="nav-item"><a href="/listeCourrierTraite" class="nav-link">Traité<div class="pull-right box "> {{nbrcourrierTraite()}}</div> </a></li>

             @endif
             
            @if((Auth::user()->user_role==5)||(Auth::user()->user_role==7))
            <li class="nav-item"><a href="/listeCourrierAttenteCollaborateur" class="nav-link">Envoyé aux collaborateurs</a></li>
            <li class="nav-item"><a href="/listeCourrierAffecter" class="nav-link">En Attente de Traitement <div class="pull-right box "> {{nbrcourrierAffecteManager()}}</div></a></li>
            <li class="nav-item"><a href="/listeCourrierTraite" class="nav-link">Traité<div class="pull-right box "> {{nbrcourrierTraitedepartement()}}</div> </a></li>
             @endif 

              @if((Auth::user()->user_role==6)||(Auth::user()->user_role==9))
            <li class="nav-item"><a href="/listeCourrierAffecter" class="nav-link">En Attente de Traitement <div class="pull-right box "> {{nbrcourrierAffecteUser()}}</div></a></li>
            <li class="nav-item"><a href="/listeCourrierTraite" class="nav-link">Traité<div class="pull-right box "> {{nbrcourrierTraiteuser()}}</div> </a></li>
             @endif 
            
            

            @if((Auth::user()->user_role==2)||(Auth::user()->user_role==8)||(Auth::user()->user_role==1))
             <li class="nav-item"><a href="/Statistiquecourriers" class="nav-link">Statistique Courrier</a></li>
             @endif
             @if((Auth::user()->user_role==8)||(Auth::user()->user_role==1))
              <li class="nav-item"><a href="relancecourrier" class="nav-link">Relance</a></li>
              @endif 

             @if(Auth::user()->groupe_id>0)

            <li class="nav-item"><a href="/listeCourrierAffecterAugroupe" class="nav-link">Du groupe En Attente de <br>Traitement </a></li>
            <li class="nav-item"><a href="/listeCourrierTraiteAuGroupe" class="nav-link">Du groupe Traité</a></li>

             @endif
             
          </ul>
        </li><!-- nav-item --> 
         <!-- @if(getCurrentApp()=='gec')@endif -->

       

 @if((Auth::user()->user_role==2)||(Auth::user()->user_role==5)||(Auth::user()->user_role==6)||(Auth::user()->user_role==1)||(Auth::user()->user_role==3)||(Auth::user()->user_role==4)||(Auth::user()->user_role==8)||(Auth::user()->user_role==9)) 
         <li class="nav-item">
          <a href="" class="nav-link with-sub">
             <img src="{{asset('images/pao.png')}}"  title="" style="height: 40px;">
           
            <span>PAO</span>
          </a>
          <ul class="nav-sub">
            

            <li class="nav-item"><a href="Liste-activités" class="nav-link">Accueil PAO</a></li>
             
            <li class="nav-item"><a href="/Liste-reunions" class="nav-link">Compte Rendu-Direction</a></li>
            @if((Auth::user()->user_role==5)||(Auth::user()->user_role==6)||(Auth::user()->user_role==1)) 

<li class="nav-item"><a href="/Liste-reuniondepartements" class="nav-link">Compte Rendu-Départements</a></li>

         @endif 
             
            <li class="nav-item"><a href="/Liste-rapports" class="nav-link">Rapports Hebdomadaires</a></li> 
            <li class="nav-item"><a href="/Liste-rapportmens" class="nav-link">Rapports Mensuels</a></li> 
           <!-- @if((Auth::user()->user_role==5)||(Auth::user()->user_role==7))
            <li class="nav-item"><a href="/listeCourrierAttenteCollaborateur" class="nav-link">Directions</a></li>
             @endif-->
            <li class="nav-item"><a href="/Liste-directions" class="nav-link">Directions</a></li> 

              @if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)) 
            <li class="nav-item"><a href="/Statistiques" class="nav-link">Statistique Globale</a></li> 
             <li class="nav-item"><a href="/Statistiques-Globale" class="nav-link">Statistique par Département </a></li> 
              <li class="nav-item"><a href="{{route('Parametre.show',1)}}" class="nav-link">Paramètre </a></li> 
             @endif 


         <!--    <li class="nav-item"><a href="/listeCourrierTraite" class="nav-link">Traité</a></li>
             @if(Auth::user()->groupe_id>=1)

            <li class="nav-item"><a href="/listeCourrierAffecterAugroupe" class="nav-link">Du groupe En Attente de <br>Traitement </a></li>
            <li class="nav-item"><a href="/listeCourrierTraiteAuGroupe" class="nav-link">En Attente de Traitement</a></li>
             @endif -->
           </ul>
        </li> 
         @endif

         
       
@if(Auth::user()->user_role==1)
         
<li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="icon ion-ios-list-outline"></i>
            <span>Annotation Type</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="/addannotation" class="nav-link">Ajouter une Annotation</a></li>
            <li class="nav-item"><a href="/annotation" class="nav-link">liste des Annotations</a></li>
          </ul>
        </li>

     

         
<li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="fa fa-cog"></i>
            <span>Menu</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="/addmenu" class="nav-link">Ajouter un Menu</a></li>
            <li class="nav-item"><a href="/listemenu" class="nav-link">Liste des menus</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="fa fa-cog"></i>
            <span>Sous Menu</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="createSousmenu" class="nav-link">Ajouter un Sous Menu</a></li>
            <li class="nav-item"><a href="showSousmenu" class="nav-link">Liste des sous menus</a></li>
          </ul>
        </li>

         <li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="icon ion-ios-list-outline"></i>
            <span>Poste</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="/addposte" class="nav-link">Ajouter un Poste</a></li>
            <li class="nav-item"><a href="/listeposte" class="nav-link">Liste des postes</a></li>
          </ul>
        </li>

<li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="icon ion-wand"></i>
            <span>Priorité</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="/addpriorite" class="nav-link">Ajouter une Priorité</a></li>
            <li class="nav-item"><a href="/listepriorite" class="nav-link">Liste des priorités</a></li>
          </ul>
        </li>

<li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="fa fa-briefcase"></i>
            <span>Couleur</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="/addcouleur" class="nav-link">Ajouter une Couleur</a></li>
            <li class="nav-item"><a href="/listecouleur" class="nav-link">Liste des couleurs</a></li>
          </ul>
        </li>


           <li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="icon ion-person-stalker"></i>
            <span>Utilisateur</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="/adduser" class="nav-link">Ajouter un Utilisateur</a></li>
            <li class="nav-item"><a href="utilisateur" class="nav-link">Liste des utilisateurs</a></li>
          </ul>
        </li>

         <li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="icon ion-person-stalker"></i>
            <span>Groupe</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="/addgroupe" class="nav-link">Ajouter un Groupe</a></li>
            <li class="nav-item"><a href="/groupe" class="nav-link">Liste des Groupes</a></li>
             <li class="nav-item"><a href="/element_groupe" class="nav-link">Ajout des élements</a></li>
          </ul>
        </li>


        <!--  <li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="icon ion-person"></i>
            <span>Personne A Notifier</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="/addnotification" class="nav-link">Ajouter une Personne à Notifier</a></li>
            <li class="nav-item"><a href="/listenotification" class="nav-link">Liste des Personnes à Notifier</a></li>
          </ul>
        </li>
 -->




        <li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="fa fa-bank"></i>
            <span>Departement</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="/adddepartement" class="nav-link">Ajouter un Departement</a></li>
            <li class="nav-item"><a href="/listedepartement" class="nav-link">Liste des departements</a></li>
          </ul>
        </li>

<li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="fa fa-bank"></i>
            <span>Sous Departement</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="createSousdepartement" class="nav-link">Ajouter un Sous Departement</a></li>
            <li class="nav-item"><a href="showSousdepartement" class="nav-link">Liste des sous departements</a></li>
          </ul>
        </li>
 @endif

<!-- <li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="fa fa-cog"></i>
            <span>Manifestation De Besoin</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="/addmenu" class="nav-link">Faire une demande</a></li>
            <li class="nav-item"><a href="/listemenu" class="nav-link">Mes demandes</a></li>
            <li class="nav-item"><a href="/listemenu" class="nav-link">Demande en attente de validation</a></li>
            <li class="nav-item"><a href="/listemenu" class="nav-link">Liste total des demandes</a></li>
          </ul>
        </li> -->


      </ul>
    </div><!-- sh-sideleft-menu -->
    @endif
    