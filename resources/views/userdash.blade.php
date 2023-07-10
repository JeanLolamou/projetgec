@extends('pages.Default')
@section('content')


     

    
      <div class="sh-breadcrumb" style="background-image: url('images/armoirie.png');">
        <nav class="breadcrumb">
          <a class="breadcrumb-item" href="#">GECPAO</a>
          <span class="breadcrumb-item active">Tableau de bord</span>
        </nav>
      </div><!-- sh-breadcrumb -->
      <div class="sh-pagetitle">
        <div class="input-group">
          
        </div><!-- input-group -->
        <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="icon ion-ios-home"></i></div>
          <div class="sh-pagetitle-title">
            <span>Tableau de bord</span>
            <h2>Cliquez sur l'application de votre choix!</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->

      <div style="min-height:300px" class="sh-pagebody">
        <div class="row row-sm">
          <div class="col-lg-12">
            <div class="row row-xs">
              <div class="col-8 col-sm-6 col-md">
                @if((Auth::user()->user_role==2)||(Auth::user()->user_role==1)||(Auth::user()->user_role==8))
                <a style="text-decoration:none" href="/listeCourrierAttente" class="shortcut-icon">
                    @endif
 @if((Auth::user()->user_role==4))
                      <a style="text-decoration:none" href="/listeCourrierArrive" class="shortcut-icon">
                         @endif
                     @if((Auth::user()->user_role==6)||(Auth::user()->user_role==9))
                  <a style="text-decoration:none" href="/listeCourrierAffecter" class="shortcut-icon">
                    @endif
 @if((Auth::user()->user_role==5))
                    <a style="text-decoration:none" href="/listeCourrierAttenteCollaborateur" class="shortcut-icon">
                      @endif

                       @if(Auth::user()->user_role==3)
                <a style="text-decoration:none" href="/listeCourrierArrive" class="shortcut-icon">
                    @endif
                  <div>
                    <img src="{{asset('images/mail.png')}}" style="height: 110px;">
                    <span><b>GESTIONNAIRE COURRIER</b></span>
                  </div>
                </a>
              </div><!-- col -->
              <div class="col-8 col-sm-6 col-md">
                <a style="text-decoration:none" href="/Liste-activités" class="shortcut-icon">
                  <div>
                     <img src="{{asset('images/Doc.png')}}" style="height: 120px;">
                    <span><b>PAO</b></span>
                  </div>
                </a>
              </div><!-- col -->
              <div class="col-8 col-sm-6 col-md mg-t-10 mg-sm-t-0">
                <a style="text-decoration:none" href="{{route('dashboard')}}" class="shortcut-icon">
                  <div>
                     <img src="{{asset('images/besoin.png')}}" style="height: 110px;">
                    <span><b>MANIFESTATION BESOIN</b></span> 
                  </div>
                </a>
              </div><!-- col -->
              
            </div><!-- row -->

           
<!-- href="{{url('http://www.pao.apipguinee.com/')}}" -->

           

            
          </div><!-- col-4 -->
        </div><!-- row -->
     </div>
     
     @stop

