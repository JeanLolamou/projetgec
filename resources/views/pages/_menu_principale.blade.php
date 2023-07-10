 <div class="sh-logopanel">
      <a href="" class="sh-logo-text">GECPAO</a>
      <a id="navicon" href="" class="sh-navicon d-none d-xl-block"><i class="icon ion-navicon"></i></a>
      <a id="naviconMobile" href="" class="sh-navicon d-xl-none"><i class="icon ion-navicon"></i></a>
    </div><!-- sh-logopanel -->

    <div class="sh-sideleft-menu">
      <label class="sh-sidebar-label">Navigation</label>
      <ul class="nav">
        <li class="nav-item">
          <a href="{{route('home')}}" class="nav-link {{active_route('home')}}">
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
          <a href="" class="nav-link with-sub ">
            <i class="icon ion-ios-people-outline"></i>
            <span>Utilisateurs</span>
          </a>
          <ul class="nav-sub">
            
            
          </ul>
        </li><!-- nav-item -->
       
      </ul>
    </div><!-- sh-sideleft-menu -->

    <div class="sh-headpanel">
      <div class="sh-headpanel-left">
         @if(getCurrentApp()=='gec')
            <a href="{{route('Courrier.create')}} " class="sh-icon-link">
               <div>
                <i class="fa fa-plus" style="font-size: 16px;"></i>
                <span>Nouveau Courrier</span>
              </div>
            </a>
            @elseif(getCurrentApp()=='pao')
              
            @elseif(getCurrentApp()=='besoin')
              
            @endif
        <!-- START: HIDDEN IN MOBILE -->
        
       
        <!-- END: HIDDEN IN MOBILE -->

        <!-- START: DISPLAYED IN MOBILE ONLY -->
       
        <!-- END: DISPLAYED IN MOBILE ONLY -->

      </div><!-- sh-headpanel-left -->