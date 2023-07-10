@extends('pages.Default')
@section('content')
      

<div class="main-panel">
        <div class="content-wrapper p-0">
           @if(session()->has('success'))
        <div class="alert alert-fill-primary" role="alert" style="background: green">
           <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color: white">&times;</a>
                    <i class="mdi mdi-alert-circle"></i>
                    <strong>Succés!</strong> {{session()->get('success')}}
                  </div>

                 <!--    #082c10   -->   
               @endif
               <div class="sh-pagebody">
               <div class="card-header bg-primary tx-white">Enregistrer un nouveau Collaborateur:</div>
   

      <div class="content-wrapper user-pages d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-12 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
             <div class="card" style="background: #dee2e6;">
                <div class="card-body">
                  <h4 class="card-title">
            </h4>
              <!-- <h6 class="font-weight-light">Join us today! It takes only few steps</h6> -->
              <form id="form_validation" method="POST" class="pt-3" action="ajoutuser">
                                      {{ csrf_field() }}
                                

                  <div class="form-group">
                  <label>Prénom et Nom</label>
                  <div class="input-group" style="background: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0" placeholder="Prenom et Nom" name="name" required>
                  </div>
                </div>
                 <div class="form-group">
                  <label>Télèphone</label>
                  <div class="input-group" style="background: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-phone text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0" placeholder="Telephone" name="telephone" >
                  </div>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <div class="input-group" style="background: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-email-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="email" class="form-control form-control-lg border-left-0" placeholder="Email" name="email">
                  </div>
                </div>

                                  
                                <div class="form-line">
                                    <label class="form-label">Choisir une Direction</label>
                                    <select class="form-control form-control-lg" id="example-fontawesome" autocomplete="off" name="direction">
                                        <option value="">-- Direction--</option>
                                        @foreach($departements as $key =>$departement) 
                                        <option value="{{ $departement->id }}">{{ $departement->nom}}</option>
                                         @endforeach
                                    </select>
                                </div>
                                 <div class="form-line">
                                    <label class="form-label">Choisir un Service</label>
                                    <select class="form-control form-control-lg" id="example-fontawesome" autocomplete="off" name="service">
                                        <option value="">-- service--</option>
                                        @foreach($services as $key =>$Service) 
                                        <option value="{{ $Service->id }}">{{ $Service->nom_service}}</option>
                                         @endforeach
                                    </select>
                                </div>


                                  <div class="form-group form-float">
                                        <label class="form-label">Poste</label>
                                    <div class="form-line" style="background: white;">
                                        <select class="form-control form-control-lg" id="example-fontawesome" autocomplete="off" name="poste">
                                        <option value="">-- Poste --</option>
                                        @foreach($postes as $key =>$poste) 
                                        <option value="{{ $poste->id }}">{{ $poste->User_poste}}</option>
                                         @endforeach
                                       
                                       
                                           
                                    </select>

                                        
                                    </div>
                                </div>

                                <div class="form-group">
                  <label>Mot de passe</label>
                  <div class="input-group" style="background: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Mot de passe" name="password" required>                        
                  </div>
                </div>
                                
                                
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Enregistrer</button>
                                
                                 </form>
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

</div><!-- sh-pagebody -->
@stop
