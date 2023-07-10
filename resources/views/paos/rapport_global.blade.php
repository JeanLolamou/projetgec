@extends('pages.Default')
@section('content')


 <div class="sh-pagetitle">
        <div class="input-group">
        
        </div><!-- input-group -->
        <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="icon ion-ios-filing mg-t-3"></i></div>
          <div class="sh-pagetitle-title">
            <h2>Rapport Hebdomadaire Global</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->

        

     <div class="sh-pagebody">

       <div class="row">
        <div class="col-lg-12">
          <ol class="breadcrumb">
             <div class="col-sm-6 col-md-3">
                <a style="text-decoration:none" href="/Liste-rapports"><button  class="btn btn-outline-primary btn-block">
            <span class="title"></span><i class="fa fa-table"></i>Liste Rapport Hebdomadaire</button></a>    
              </div><!-- col-sm -->

              <div class="col-sm-6 col-md-2">
              
                <a style="text-decoration:none" href="/dashboard"><button  class="btn btn-outline-primary btn-block">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->

             
           
</div>
                        
          </ol>
         </div> 


        <div class="card bd-primary mg-t-20">
          <div class="card-header bg-primary tx-white">Rapport Hebdomadaire</div>
          <div class="card-body pd-sm-30">
            <p class="mg-b-20 mg-sm-b-30"> Cliquez sur le mois des rapports hebdomadaires de votre choix!</p>

            <div class="row">
              <div class="col-sm-6 col-md-3">
                <div class="btn-demo">
                  <a target="_blank" class="btn btn-outline-primary btn-block mg-b-10" href="/dynamic_pdf/pdf-janglobalrapport-unique">Janvier</a>
                  
                  <a target="_blank" class="btn btn-outline-primary active btn-block mg-b-10" href="/dynamic_pdf/pdf-maiglobalrapport-unique">Mai</a>
                  <a target="_blank" class="btn btn-outline-primary btn-block mg-b-10" href="/dynamic_pdf/pdf-septglobalrapport-unique">Septembre</a>
                </div><!-- btn-demo -->
              </div><!-- col-sm-3 -->

              <div class="col-sm-6 col-md-3 mg-t-20 mg-sm-t-0">
                <div class="btn-demo">
                  <a target="_blank" class="btn btn-outline-secondary btn-block mg-b-10" href="/dynamic_pdf/pdf-fevglobalrapport-unique">Février</a>
                  <a target="_blank" class="btn btn-outline-secondary active btn-block mg-b-10" href="/dynamic_pdf/pdf-juinglobalrapport-unique">Juin</a>
                  <a target="_blank" class="btn btn-outline-secondary btn-block mg-b-10" href="/dynamic_pdf/pdf-octglobalrapport-unique">Octobre</a>
                </div><!-- btn-demo -->
              </div><!-- col-sm-3 -->

              <div class="col-sm-6 col-md-3 mg-t-20 mg-md-t-0">
                <div class="btn-demo">
                  <a target="_blank" class="btn btn-outline-success btn-block mg-b-10" href="/dynamic_pdf/pdf-marglobalrapport-unique">Mars</a>
                  <a target="_blank" class="btn btn-outline-success active btn-block mg-b-10" href="/dynamic_pdf/pdf-juilglobalrapport-unique">Juillet</a>
                  <a target="_blank" class="btn btn-outline-success btn-block mg-b-10" href="/dynamic_pdf/pdf-novglobalrapport-unique">Novembre</a>
                </div><!-- btn-demo -->
              </div><!-- col-sm-3 -->

              <div class="col-sm-6 col-md-3 mg-t-20 mg-md-t-0">
                <div class="btn-demo">
                  <a target="_blank" class="btn btn-outline-warning btn-block mg-b-10" href="/dynamic_pdf/pdf-avrglobalrapport-unique">Avril</a>
                  <a target="_blank" class="btn btn-outline-warning active btn-block mg-b-10" href="/dynamic_pdf/pdf-aoutglobalrapport-unique">Août</a>
                  <a target="_blank" class="btn btn-outline-warning btn-block mg-b-10" href="/dynamic_pdf/pdf-decglobalrapport-unique">Décembre</a>
                </div><!-- btn-demo -->
              </div><!-- col-sm-3 -->
            </div><!-- row -->
           <!--  <p class="mg-t-20 mg-b-0">Available in all colors same with the button above.</p> -->
          </div><!-- card-body -->
        </div><!-- card -->

        

        

       

      </div><!-- sh-pagebody -->
       </div><!-- sh-mainpanel -->

       <script src="../lib/jquery/jquery.js"></script>
    <script src="../lib/popper.js/popper.js"></script>
    <script src="../lib/bootstrap/bootstrap.js"></script>
    <script src="../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>

    <script src="../js/shamcey.js"></script>
   
         @stop