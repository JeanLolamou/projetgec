

<div class="sh-headpanel">
      <div class="sh-headpanel-left">

        <!-- START: HIDDEN IN MOBILE -->
        @if((Auth::user()->user_role==4)||(Auth::user()->user_role==1)||(Auth::user()->user_role==2))
        <a style="text-decoration:none" href="/addCourrier/1" class="sh-icon-link">
          <div>
 <img src="{{asset('images/newmail.png')}}"  title=" Nouveau Courrier" style="height: 50px;">
            <!-- <i class="fa fa-envelope" style="font-size: 25px;"></i> -->
          <!--   <span>Nouveau Courrier</span> -->
          </div>
        </a>
          @endif
          @if((Auth::user()->user_role==0))
        <a href="/addCourrier/2" class="sh-icon-link">
          <div>
            <i class="fa fa-envelope" style="font-size: 25px;"></i>
            <span>Nouveau Courrier Confidence</span>
          </div>
        </a>
         @endif

          <!-- <i class="fa fa-folder" style="font-size: 25px;"></i> -->
            <!-- <span>Nouveau PAO</span> -->

           @if((Auth::user()->user_role==5)||(Auth::user()->user_role==7)||(Auth::user()->user_role==2)||(Auth::user()->user_role==3)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8))
        <a style="text-decoration:none" href="/addactivite" class="sh-icon-link">
          <div>
             <img src="{{asset('images/new_folder1.png')}}"  title="Nouveau PAO" style="height: 50px;">
             
           
          </div>
        </a>
         @endif 
        <!-- END: HIDDEN IN MOBILE -->

        <a style="text-decoration:none" href="/dashboard" class="sh-icon-link">
          <div>
             <img src="{{asset('images/homea.png')}}"  title="Accueil" style="height: 50px;">
         <!--    <i class="icon ion-ios-home" style="font-size: 25px;"></i> -->
            
            <!-- <span>Accueil GECPAO</span> -->
          </div>
        </a>
        <!-- END: HIDDEN IN MOBILE -->

        <!-- START: DISPLAYED IN MOBILE ONLY -->
        
          
        <!-- END: DISPLAYED IN MOBILE ONLY -->

      </div><!-- sh-headpanel-left -->

      <div class="sh-headpanel-right">
         @if((Auth::user()->user_role==5)||(Auth::user()->user_role==6)||(Auth::user()->user_role==3)||(Auth::user()->user_role==2)||(Auth::user()->user_role==8)||(Auth::user()->user_role==1))
         <div>
<a href="/listeCourrierAffecterUrge"  class="dropdown-link dropdown-link-notification">
            <i title="Liste des Courriers Urgents" class=" icon ion-ios-bell-outline tx-24"></i>
            <span class="square-8"></span>
          </a>
          </div>
          @endif

         <div class="media-body">
                <h6 class="tx-inverse tx-15 mg-b-5" style="color: white;font-weight: bolder;">{{Auth::user()->name}}</h6>
                
              </div><!-- media-body -->
        <div class="dropdown mg-r-10">
          <div class="dropdown dropdown-profile">
          <a href="" data-toggle="dropdown" class="dropdown-link">
            <img src=" {{asset('assets/img/img11.jpg')}} " class="wd-60 rounded-circle" alt="">
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="media align-items-center">
              <img src="{{asset('assets/img/img11.jpg')}} " class="wd-60 ht-60 rounded-circle bd pd-5" alt="">
              <div class="media-body">
                <h6 class="tx-inverse tx-15 mg-b-5">{{Auth::user()->name}}</h6>
                <p class="mg-b-0 tx-12 ">{{Auth::user()->email}}</p>
              </div><!-- media-body -->
            </div><!-- media -->
            <hr>
            <ul class="dropdown-profile-nav">
               <li><a href="{{route('profil')}}"><i class="icon ion-ios-person"></i>  Profil</a></li>
              <!-- <li><a href=""><i class="icon ion-ios-gear"></i> Settings</a></li>  -->
         
             
              <li>
                <a  class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();

                                                     document.getElementById('logout-form').submit();" ><i class="icon ion-power"></i>Deconnexion</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                      @csrf

                    </form>
                   
            </ul>
          </div><!-- dropdown-menu -->
        </div>
        </div>

          
          <div class="dropdown-menu dropdown-menu-right">
            
             
        <div  class="dropdown dropdown-notification">


             <div class=" dropdown-menu-header">
               @if((Auth::user()->user_role==5)||(Auth::user()->user_role==6)||(Auth::user()->user_role==3)||(Auth::user()->user_role==2)||(Auth::user()->user_role==1))
              <label><i class="fa fa-envelope"></i> Courriers</label>
      
        
            </div><!-- d-flex -->
           

           <div class="media-list">
              <!-- loop starts here -->
             
              <!-- loop ends here -->
              
              
              <a href="" class="media-list-link read">
                <div class="media pd-x-20 pd-y-15">
                  <img src="{{asset('images/urge.png')}} " style="height: 30px;" class="wd-40 rounded-circle" alt="">
                  <div class="media-body">
                     <a href="/listeCourrierAffecterUrge"><strong class="tx-medium">Liste des Courriers Urgents</strong> </a>
                   
                  </div>
                </div><!-- media -->
              </a>
       @endif
              <div class="media-list-footer">
                <a href="" class="tx-12"><i class="fa fa-angle-down mg-r-5"></i> Show All Notifications</a>
              </div>
            </div><!-- media-list -->
          </div><!-- dropdown-menu -->
        </div>
        
      </div><!-- sh-headpanel-right -->
    </div><!-- sh-headpanel -->
  