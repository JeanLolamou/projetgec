<!-- partial:partials/_navbar.html -->

    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row"  >

      



         <div class="navbar-brand-wrapper align-items-center" style="">

        <a class="navbar-brand brand-logo" href="/home"><img src="{{asset('images/logo_GEC.jpg')}}" alt="logo"/ style="width: 120px;height: 50px"></a>

        <a class="navbar-brand brand-logo-mini" href="/home"><img src="{{asset('images/logo_GEC.jpg')}}" alt="logo"/></a>

        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">

            <span class="mdi mdi-sort-variant"></span> 

          </button>

      </div>



        <!-- <a class="navbar-brand brand-logo" href="index.html"><img src="{{asset('images/armorie.png')}}" alt="logo"/></a> -->

        <!-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="https://www.bootstrapdash.com/demo/wagondash/template/images/logo-mini.svg" alt="logo"/></a> -->

        <!-- <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">

            <span class="mdi mdi-sort-variant"></span> 

          </button>

      </div> -->

    

      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" style="background:  #034a13;height: 58px;">

       

        <ul class="navbar-nav mr-lg-2">
 @if((Auth::user()->user_role==8))
          <li class="nav-item d-none d-sm-block dropdown arrow-none" >

              <a  href="/addCourrier/1" type="button" class="btn btn-success btn-icon-text "   >

                  <i class="mdi mdi-plus-circle btn-icon-prepend"></i>                                                    

                  Nouveau Courrier

              </a>

             

          </li>
          @endif
           @if((Auth::user()->user_role==9))
           <li class="nav-item d-none d-sm-block dropdown arrow-none" >

              <a  href="/addCourrier/2" type="button" class="btn btn-success btn-icon-text "   >

                  <i class="mdi mdi-plus-circle btn-icon-prepend"></i>                                                    

                  Nouveau Courrier Présidence

              </a>

             

          </li>
           <li class="nav-item d-none d-sm-block dropdown arrow-none" >

              <a  href="/addCourrier/3" type="button" class="btn btn-success btn-icon-text "   >

                  <i class="mdi mdi-plus-circle btn-icon-prepend"></i>                                                    

                  Nouveau Courrier Mines

              </a>

             

          </li>

              @endif

        </ul>

    

        <ul class="navbar-nav navbar-nav-right">

          

           

            @if((Auth::user()->user_role==2)||(Auth::user()->user_role==8)||(Auth::user()->user_role==1)||(Auth::user()->user_role==9))

            <?php if (count($courrierAttentes)>0) ?>

            <li class="nav-item count-indicator nav-profile dropdown" data-toggle="tooltip" data-placement="Bottom" title="Courrier en Attente d'annotation">

                 <span class="count  bg-warning">{{count($courrierAttentes)}}</span>

            <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="/listeCourrierAttente">

              <i class="mdi mdi-bell-outline mx-0" style="color: aliceblue;"></i>

            </a>

       

          </li>

          @endif

          <li class="nav-item dropdown count-indicator arrow-none" data-toggle="tooltip" data-placement="Bottom" title="Courrier en Attente de Traitement">

              <span class="count bg-success">{{count($courrierEnAttenteTraites)}}</span>

            <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="/listeCourrierAffecter" >

              <i class="mdi mdi-bell-ring mx-0" style="color: aliceblue;"></i>

            </a>

            

          </li>



        </ul>

        <span style="margin-right: 15px"></span>

        <div class="dropdown sidebar-profile-dropdown" style=" height: 47px;">

                  <a class="dropdown-toggle d-flex align-items-center justify-content-between" href="#" data-toggle="dropdown" id="profileDropdown1">

            

            <div>

              

                <div class="nav-profile-name" style="color: white">{{Auth::user()->name}} </div>

                

            

          </a>

          <div class="dropdown-menu navbar-dropdown dropdown-menu-left" aria-labelledby="profileDropdown1">

            <a class="dropdown-item" href="{{ route('motdepassoublier') }}">

              <i class="mdi mdi-account"></i>

              Changer Votre Mot de Passe

            </a>

            <a  class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();



                                                     document.getElementById('logout-form').submit();" > <i class="mdi mdi-logout"></i>Deconnexion</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">



                      @csrf



                    </form>

          </div>

        </div>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">

          <span class="mdi mdi-menu"></span>

        </button>

      </div>

    </nav>

  