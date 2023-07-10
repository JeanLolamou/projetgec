@extends('templates/page/default')
         @section('contenu')
      

<div class="main-panel">
        <div class="content-wrapper p-0">
             @if(session()->has('success'))
                      <div class="alert alert-success alert-dismissible" style="width: 100%;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Succés!</strong> {{session()->get('success')}}
</div>                       
@endif
<h1> Enregistrer une nouvelle Direction</h1>
      <div class="content-wrapper user-pages d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-12 d-flex align-items-center justify-content-center" >
            <div class="auth-form-transparent text-left p-3">
              <div class="card" style="background: #dee2e6;">
                <div class="card-body">
                  <h4 class="card-title">
            </h4>
              <!-- <h6 class="font-weight-light">Join us today! It takes only few steps</h6> -->
              <form id="form_validation" method="POST" class="pt-3" action="ajoutdepartement">
                                      {{ csrf_field() }}
                                

              


                <div class="form-group">

                        <label for="nom">Nom Direction</label>
                         <div class="input-group" style="background: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                        <input id="nom" class="form-control" name="nom" type="text" placeholder="Nom Direction" required="required" >
                      </div>

                 <div class="form-group">
                  <label>Sigle</label>
                  <div class="input-group" style="background: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-adjust text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control " placeholder="Sigle" name="sigle" required>
                  </div>
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
