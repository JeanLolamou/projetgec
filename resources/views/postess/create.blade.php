@extends('pages.Default')
@section('content')
      

<div class="main-panel">
        <div class="content-wrapper p-0">
             @if(session()->has('success'))
                      <div class="alert alert-success alert-dismissible" style="width: 100%;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Succés!</strong> {{session()->get('success')}}
</div>                       
@endif<h6 style="text-transform: uppercase;font-weight: bolder;text-align: center;">Enregistrer un nouveau Poste1:</h6>
      <div class="content-wrapper user-pages d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-12 d-flex align-items-center justify-content-center" >
            <div class="auth-form-transparent text-left p-3">
              <div class="card" style="background: #dee2e6;">
                <div class="card-body">
                  <h4 class="card-title">
            </h4>
              <!-- <h6 class="font-weight-light">Join us today! It takes only few steps</h6> -->
              <form id="form_validation" method="POST" class="pt-3" action="ajoutposte">
                                      {{ csrf_field() }}
                                

              


                <div class="form-group">

                        <label for="nom">Poste</label>
                         <div class="input-group" style="background: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                        <input id="nom" class="form-control" name="nom" type="text" placeholder="Poste" required="required" >
                      </div>

               
                

                                  
                                
                                
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Enregistrer</button>
                                
                                 </form>
            </div>
          </div>
          </div>
          </div>
         
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->

@stop
