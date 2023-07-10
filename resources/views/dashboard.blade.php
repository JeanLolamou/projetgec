@extends('pages.Default')
@section('content')


     

    <div class="sh-mainpanel">
      <div class="sh-breadcrumb">
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

      <div class="sh-pagebody">
        <div class="row row-sm">
          <div class="col-lg-12">
            <div class="row row-xs">
              <div class="col-8 col-sm-6 col-md">
                <a href="{{route('accueilGEC')}}" class="shortcut-icon">
                  <div>
                    <img src="{{asset('images/courrier.png')}}" style="height: 100px;">
                    <span><b>Gestionnaire Courrier</b></span>
                  </div>
                </a>
              </div><!-- col -->
              <div class="col-8 col-sm-6 col-md">
                <a href="{{route('accueilPAO')}}" class="shortcut-icon">
                  <div>
                     <img src="{{asset('images/pao.png')}}" style="height: 100px;">
                    <span><b>PAO</b></span>
                  </div>
                </a>
              </div><!-- col -->
              <div class="col-8 col-sm-6 col-md mg-t-10 mg-sm-t-0">
                <a href="{{route('accueilMANIFBESOIN')}}" class="shortcut-icon">
                  <div>
                     <img src="{{asset('images/besoin.png')}}" style="height: 100px;">
                    <span><b>Manifestation Besoin</b></span>
                  </div>
                </a>
              </div><!-- col -->
              
            </div><!-- row -->

           


           

            
          </div><!-- col-4 -->
        </div><!-- row -->
      </div><!-- sh-pagebody -->
     
     @stop