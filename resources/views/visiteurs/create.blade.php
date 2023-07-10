@extends('templates/page/default')
         @section('contenu')
      

<div class="main-panel">
        <div class="content-wrapper">
             @if(session()->has('success'))
                      <div class="alert alert-success alert-dismissible" style="width: 100%;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Succés!</strong> {{session()->get('success')}}
</div>                       
@endif

  <div class="">
                        <div class="">
                            <h6 class="card-title">Nouveau Rendez-vous</h6>
                            <ul class="nav nav-pills mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                       role="tab" aria-controls="pills-home" aria-selected="true">Rendez-vous</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                       role="tab" aria-controls="pills-profile" aria-selected="false"><i class="mdi mdi-account-plus"></i> Visiteur</a>
                                </li>
                               
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                     aria-labelledby="pills-home-tab"> 

 <form id="form_validation" method="POST" class="pt-3" action="storeRendez_vous">
                                      {{ csrf_field() }}
                                


                <div class="form-group">
                <div class="row">
                        <div class="col-md-6">
                      <!--     <div class="row">
                        <div class="col-md-6"> -->
                        <div class="form-group">
  <label for="demo_overview">Selectionnez un visiteur</label>
    <select  class="form-control" data-role="select-dropdown" name="id_visiteur">
   <option>Selectionnez</option>
   @foreach($visiteurs as $key =>$visiteur) 
      <option value="{{ $visiteur->id }}">{{ $visiteur->nomvisiteur}}</option>
   @endforeach
 
  </select>
</div>
              <div class="form-group">
                        <label for="titre">Titre *</label>
                         <div class="input-group" style="background: white;">
                    <!-- <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div> -->
                        <input id="titre" class="form-control" name="titre" type="text" required="required"  style="background: white;" placeholder="Titre Rendez-vous">
                      </div>
                         </div>
                          <div class="form-group">
                        <label for="motif">Motif</label>
                        <textarea name="motif" id="motif" class="form-control"  required="required"  style="background: white;"></textarea>
                        
                      </div>
                       </div>
     <div class="col-md-6">
                    <label for="date_rendez_vous">Date Rendez-vous</label>

                             <div class="input-group" style="background: white;">
               
                        <input id="date_rendez_vous" class="form-control" name="date_rendez_vous" type="datetime-local" id="meeting-time" placeholder="Date Rendez-vous" required="required" >
                      </div>
                       <label for="lieu">Lieu du rendez-vous</label>

                             <div class="input-group" style="background: white;">
               
                        <input id="lieu" class="form-control" name="lieu" type="text" id="meeting-time" placeholder="Lieu du rendez-vous" required="required" >
                      </div>


                           <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                        <label for="motif">Type de Rendez-vous</label>
                       <select  class="form-control" name="type_rendez_vous">
                         <option>Selectionnez</option>
                       <option>1</option>
                       </select>
                         </div>
                      </div>
                        <div class="col-md-6">
                           <label for="motif">Priorité</label>
                       <select  class="form-control" name="priorite">
                         <option>Selectionnez</option>
                       <option>1</option>
                       </select>
                        </div>
                      </div>
          </div>
        </div>

               
                 </div>

                                  
                                
                                
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Enregistrer</button>
                                
                                 </form>


                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                     aria-labelledby="pills-profile-tab"> 
 <form id="form_validation" method="POST" class="pt-3" action="storeVisiteur">
                                      {{ csrf_field() }}
                                     <div class="form-group">
                        <label for="nomvisiteur">Nom Visiteur *</label>
                         <div class="input-group" style="background: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                        <input id="nomvisiteur" class="form-control" name="nomvisiteur" type="text" required="required"  style="background: white;" placeholder="Nom du visiteur">
                      </div>
                         </div>
                        <label for="telephonevisiteur">Téléphone *</label>
                         <div class="input-group" style="background: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-phone  text-primary"></i>
                       
                      </span>
                    </div>
                        <input id="telephonevisiteur" class="form-control" name="telephonevisiteur" type="text" placeholder="Téléphone" required="required" >
                      </div>
                           <label for="emailvisiteur">Email *</label>
                         <div class="input-group" style="background: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-email text-primary"></i>
                      </span>
                    </div>
                        <input id="emailvisiteur" class="form-control" name="emailvisiteur" type="email" placeholder="Email" required="required" >
                      </div>
         
                     <label for="entreprisevisiteur">Entreprise</label>
                         <div class="input-group" style="background: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                        <input id="entreprisevisiteur" class="form-control" name="entreprisevisiteur" type="text" placeholder="Entreprise" required="required" >
                      </div>

                      
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Enregistrer</button>
                                
                                 </form>
                                </div>
                             
                            </div>

                        </div>
                    </div>

<!-- 
<h1 style="margin-left: 23%;"> Enregistrer un nouveau Visiteur</h1>
      <div class="content-wrapper user-pages d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-12 d-flex align-items-center justify-content-center" >
            <div class="auth-form-transparent text-left p-3">
              <div class="card" style="background: #dee2e6;">
                <div class="card-body">
                  <h4 class="card-title">
            </h4> -->
              <!-- <h6 class="font-weight-light">Join us today! It takes only few steps</h6> -->
             <!--  <form id="form_validation" method="POST" class="pt-3" action="storeRendez_vous">
                                      {{ csrf_field() }}
                                

              


                <div class="form-group">
                <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                        <label for="nomvisiteur">Nom Visiteur *</label>
                         <div class="input-group" style="background: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                        <input id="nomvisiteur" class="form-control" name="nomvisiteur" type="text" required="required"  style="background: white;" placeholder="Nom du visiteur">
                      </div>
                         </div>
                        <label for="telephonevisiteur">Téléphone *</label>
                         <div class="input-group" style="background: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-phone  text-primary"></i>
                       
                      </span>
                    </div>
                        <input id="telephonevisiteur" class="form-control" name="telephonevisiteur" type="text" placeholder="Téléphone" required="required" >
                      </div>
                           <label for="emailvisiteur">Email *</label>
                         <div class="input-group" style="background: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-email text-primary"></i>
                      </span>
                    </div>
                        <input id="emailvisiteur" class="form-control" name="emailvisiteur" type="email" placeholder="Email" required="required" >
                      </div>
         
                     <label for="entreprisevisiteur">Entreprise</label>
                         <div class="input-group" style="background: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                        <input id="entreprisevisiteur" class="form-control" name="entreprisevisiteur" type="text" placeholder="Entreprise" required="required" >
                      </div>
                          <div class="form-group">
                        <label for="motif">Motif</label>
                        <textarea name="motif" id="motif" class="form-control"  required="required"  style="background: white;"></textarea>
                        
                      </div>

                        <label for="date_rendez_vous">Date Rendez-vous</label>
                         <div class="input-group" style="background: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                      <i class="mdi mdi-calendar text-primary"></i>
                      </span>
                    </div>
                        <input id="date_rendez_vous" class="form-control" name="date_rendez_vous" type="datetime" placeholder="Date Rendez-vous" required="required" >
                      </div>
          </div>
        </div>

               
                 </div>

                                  
                                
                                
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Enregistrer</button>
                                
                                 </form>
            </div>
          </div>
          </div>
          </div>
          -->
      <!--   </div>
      </div> -->
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->

@stop
