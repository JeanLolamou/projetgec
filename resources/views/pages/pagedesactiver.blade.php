@extends('pages.Default')
@section('content')
         @if(session()->has('success'))
                      <div class="alert alert-success alert-dismissible" style="width: 100%; background: green">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Succés!</strong> {{session()->get('success')}}
</div>                       
               @endif
               <div class="main-panel">
        <div class="content-wrapper">

          <div class="sh-pagebody">
               <div class="card-header bg-primary tx-white"> <img  src="{{asset('images/attention.jpg')}}" style="height: 40px;">  <strong>Compte Desactivé</strong> </div>
       
        <!-- <div style="text-align:center"> -->
            <div class="row grid-margin">
            <div class="col-lg-12 col-md-12">
              <div class="card" style="background: white;">
                <div class="card-body">
                  <h4 class="card-title"></h4>
                  Votre compte a été desactivé, Veuillez contacter votre administrateur!
                  
                </div>
              </div>
            </div>
          </div>
          </div>
         
         
          </div>

          @stop
