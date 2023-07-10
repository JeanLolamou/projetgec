<!-- partial -->

    <div class="container-fluid page-body-wrapper" style="padding-left: 0px;padding-right: 0px; ">

      

      <nav class="sidebar sidebar-offcanvas" id="sidebar">

        

        <ul class="nav" style="position: fixed;">

          <li class="nav-item">

         

            <a class="nav-link" href="/tableauBord">

              <i class="mdi mdi-cards-variant menu-icon"></i>

              <span class="menu-title" style="color: white;

    font-weight: bolder;">Tableau de Bord</span>

            </a>

          </li>

          <li class="nav-item">

            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">

              <i class="mdi mdi-email menu-icon"></i>

              <span class="menu-title" style="color: white;

    font-weight: bolder;">Courriers</span>

              <i class="menu-arrow" style="color: white;"></i>

            </a>

            <div class="collapse" id="ui-basic">

              <ul class="nav flex-column sub-menu">

                @if((Auth::user()->user_role==2)||(Auth::user()->user_role==8)||(Auth::user()->user_role==1)||(Auth::user()->user_role==9))

                <li class="nav-item"> <a class="nav-link" href="/listeCourrierDepart" style="color: white;

    font-weight: bolder;">Départ </a></li>

                @endif

                @if((Auth::user()->user_role==2)||(Auth::user()->user_role==8)||(Auth::user()->user_role==1)||(Auth::user()->user_role==9))

                 <li class="nav-item"> <a class="nav-link" href="/listeCourrierArrive" style="color: white;

    font-weight: bolder;">Arrivée</a></li>



              <!--   <li class="nav-item"> <a class="nav-link" href="/addCourrier" style="color: white;

    font-weight: bolder;">Ajout Courrier</a></li> -->

               

                <li class="nav-item"> <a class="nav-link" href="/listeCourrierAttente" style="color: white;

    font-weight: bolder;">En Attente <br> d'annotation <span class="badge badge-pill badge-outline-success" style="color: white; background: orange">{{count($courrierAttentes)}}</span></a></li>

                

               

                @endif



               

                 

                

                @if((Auth::user()->user_role==5)||(Auth::user()->user_role==7))

                <li class="nav-item"> <a class="nav-link" href="/listeCourrierAttenteCollaborateur" style="color: white;

    font-weight: bolder;">Envoyé aux<br> collaborateurs </a></li>

                

               

                @endif



              

                <li class="nav-item"> <a class="nav-link" href="/listeCourrierAffecter" style="color: white;

    font-weight: bolder;">En Attente de <br>Traitement <span class="badge badge-pill badge-outline-success" style="color: white; background: green">{{count($courrierEnAttenteTraites)}}</span></a></li>

                <li class="nav-item"> <a class="nav-link" href="/listeCourrierTraite" style="color: white;

    font-weight: bolder;">Traité </a></li>

  @if(Auth::user()->groupe_id>=1)

             <li class="nav-item"> <a class="nav-link" href="/listeCourrierAffecterAugroupe" style="color: white;

    font-weight: bolder;">Du groupe En Attente de <br>Traitement  <span class="badge badge-pill badge-outline-success" style="color: white; background: green"></span></a></li>



     <li class="nav-item"> <a class="nav-link" href="/listeCourrierTraiteAuGroupe" style="color: white;

    font-weight: bolder;">Du groupe <br>Traité  <span class="badge badge-pill badge-outline-success" style="color: white; background: green"></span></a></li>

    

         @endif

                

              </ul>

            </div>

          </li>

 @if((Auth::user()->user_role==1)||(Auth::user()->user_role==2)||(Auth::user()->user_role>10))
          <li class="nav-item">

            <a class="nav-link" data-toggle="collapse" href="#ui-advanced0" aria-expanded="false" aria-controls="ui-advanced0"style="color: white;

    font-weight: bolder;">
              <i class="mdi mdi-human-male-female menu-icon"></i>
            

              <span class="menu-title" style="color: white;

    font-weight: bolder;">Prise de rendez-vous</span>

              <i class="menu-arrow"></i>

            </a>

            <div class="collapse" id="ui-advanced0">

              <ul class="nav flex-column sub-menu">
                @if((Auth::user()->user_role==1)||(Auth::user()->user_role==2))
 <li class="nav-item"> <a class="nav-link" href="/addRendez_vous" style="color: white;

    font-weight: bolder;">Enregistrer un Rendez-vous</a></li>
    @endif
               
   @if((Auth::user()->user_role==1)||(Auth::user()->user_role==2)||(Auth::user()->user_role>10))
                <li class="nav-item"> <a class="nav-link" href="/listeRendez_vous" style="color: white;

    font-weight: bolder;">Liste Rendez-vous</a></li>
                <li class="nav-item"> <a class="nav-link" href="/presentRendez_vous" style="color: white;

    font-weight: bolder;">Present au Rendez-vous</a></li>
    @endif
                


              </ul>

            </div>

          </li>
          @endif 

             @if((Auth::user()->user_role==1)||(Auth::user()->user_role==2)||(Auth::user()->user_role==8)||(Auth::user()->user_role==9))

          <li class="nav-item" style="color: white;

   ">

            <a class="nav-link" data-toggle="collapse" href="#ui-advance" aria-expanded="false" aria-controls="ui-advance" style="color: white;

    ">

              <i class="mdi mdi-folder-outline menu-icon"></i>

              <span class="menu-title"  style="color: white;

    font-weight: bolder;">Annotation Type</span>

              <i class="menu-arrow"></i>

            </a>

            <div class="collapse" id="ui-advance">

              <ul class="nav flex-column sub-menu">

               <li class="nav-item"> <a class="nav-link" href="/addannotation" style="color: white;

    font-weight: bolder;">Ajouter une Annotation</a></li>

                <li class="nav-item"> <a class="nav-link" href="/annotation" style="color: white;

    font-weight: bolder;">liste des Annotations</a></li>

              </ul>

            </div>

          </li>

          @endif

     @if(Auth::user()->user_role==1)

     <li class="nav-item">

            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">

              <i class="mdi mdi-home menu-icon"></i>

              <span class="menu-title" style="color: white;

    font-weight: bolder;">Directions</span>

              <i class="menu-arrow"></i>

            </a>

            <div class="collapse" id="tables">

              <ul class="nav flex-column sub-menu">

                <li class="nav-item"> <a class="nav-link" href="/adddepartement" style="color: white;

    font-weight: bolder;">Ajout d'une Direction</a></li>

                <li class="nav-item"> <a class="nav-link" href="/departement" style="color: white;

    font-weight: bolder;">Liste Directions</a></li>

              

              </ul>

            </div>

          </li>

          <li class="nav-item">

            <a class="nav-link" data-toggle="collapse" href="#table" aria-expanded="false" aria-controls="table">

              <i class="mdi mdi-grid menu-icon"></i>

              <span class="menu-title"  style="color: white;

    font-weight: bolder;">Services</span>

              <i class="menu-arrow"></i>

            </a>

            <div class="collapse" id="table">

              <ul class="nav flex-column sub-menu">

                <li class="nav-item"> <a class="nav-link" href="addservice"  style="color: white;

    font-weight: bolder;">Ajout d'un Services</a></li>

                <li class="nav-item"> <a class="nav-link" href="/service"  style="color: white;

    font-weight: bolder;">Liste Services</a></li>

              

              </ul>

            </div>

          </li>

 <li class="nav-item">

            <a class="nav-link" data-toggle="collapse" href="#groupe" aria-expanded="false" aria-controls="tables">

              <i class="mdi mdi-account-box menu-icon"></i>

              <span class="menu-title" style="color: white;

    font-weight: bolder;">Groupe</span>

              <i class="menu-arrow"></i>

            </a>

            <div class="collapse" id="groupe">

              <ul class="nav flex-column sub-menu">

                <li class="nav-item"> <a class="nav-link" href="/addgroupe" style="color: white;

    font-weight: bolder;">Créer un Groupe</a></li>

                <li class="nav-item"> <a class="nav-link" href="/groupe" style="color: white;

    font-weight: bolder;">Liste Groupe</a></li>

       <li class="nav-item"> <a class="nav-link" href="/element_groupe" style="color: white;

    font-weight: bolder;">Choisir Elèment Groupe</a></li>

              

              </ul>

            </div>

          </li>

          <li class="nav-item">

            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="tables">

              <i class="mdi mdi-home-map-marker menu-icon"></i>

              <span class="menu-title" style="color: white;

    font-weight: bolder;">Poste</span>

              <i class="menu-arrow"></i>

            </a>

            <div class="collapse" id="charts">

              <ul class="nav flex-column sub-menu">

                <li class="nav-item"> <a class="nav-link" href="/addposte" style="color: white;

    font-weight: bolder;">Ajout d'un Poste</a></li>

                <li class="nav-item"> <a class="nav-link" href="/poste" style="color: white;

    font-weight: bolder;">Liste Poste</a></li>

              

              </ul>

            </div>

          </li>

          <li class="nav-item">

            <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="tables">

              <i class="mdi mdi-account-box menu-icon"></i>

              <span class="menu-title" style="color: white;

    font-weight: bolder;">Collaborateur</span>

              <i class="menu-arrow"></i>

            </a>

            <div class="collapse" id="ui-advanced">

              <ul class="nav flex-column sub-menu">

                <li class="nav-item"> <a class="nav-link" href="/addutilisateur" style="color: white;

    font-weight: bolder;">Ajout Collaborateur</a></li>

                <li class="nav-item"> <a class="nav-link" href="/utilisateur" style="color: white;

    font-weight: bolder;">Liste Collaborateur</a></li>

              

              </ul>

            </div>

          </li>

         @endif



           

          

        </ul>

      <!--   <div class="designer-info" style="">

            Designed by: <a href="" target="_blank">APIP</a>

             <span class=" text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date("Y") ?>.<br> All rights reserved.</span>

             



        </div> -->

       

      </nav>

