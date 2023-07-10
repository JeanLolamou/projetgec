@extends('pages.Default')
@section('content')
      

<div class="main-panel">
        <div class="content-wrapper p-0">
             @if(session()->has('success'))
                      <div class="alert alert-success alert-dismissible" style="width: 100%; background: green">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 {{session()->get('success')}}
</div>                       
@endif
<div class="sh-pagebody">
 <div class="card-header bg-primary tx-white">Modifier les Informations d'un Collaborateur</div>
 

      <div class="content-wrapper user-pages d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-12 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
             <div class="card" style="background: #FFFFFF;">
                <div class="card-body">
                  <h4 class="card-title">
            </h4>
             @foreach($editusers as $key =>$edituser) 
              <!-- <h6 class="font-weight-light">Join us today! It takes only few steps</h6> -->
              <form id="form_validation" method="POST" class="pt-3" action="{{ route('modifieruser') }}">
                                      {{ csrf_field() }}
                                      {{ method_field('PUT') }}
                                
<input type="hidden" name="id" value="{{ $edituser->id }}">

 <div class="row mg-b-25">

<div class="col-lg-4">
                    
                    <label class="form-control-label">Nom & Prénom <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="name"  value="{{ $edituser->name }}">
                  </div>

                   <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Adress Email<span class="tx-danger">*</span></label>
                    <input class="form-control" type="email" name="email"  value="{{ $edituser->email }}">
                  </div>
                </div>

                 <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Numéro de Téléphone<span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="telephone"  value="{{ $edituser->telephone }}">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Mot de Passe<span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="password"  value="{{ $edituser->password }}">
                  </div>
                </div>

 <div class="col-lg-4">
                  <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Poste: <span class="tx-danger"></span></label>
                    <select class="form-control select2" name="poste" data-placeholder="" required="required">
                     <option value="" >-- Poste --</option>
                     @foreach($postes as $key =>$poste) 
                     @if($poste->id==$edituser->user_role)
          
                      <option value="{{ $poste->id }}"  checkded>{{ $poste->User_poste}}</option>
                                        @else
                                        <option value="{{ $poste->id }}">{{ $poste->User_poste}}</option>
                                        @endif
                                         @endforeach
                      
                     
                    </select>
                  </div>
                </div><!-- col-4 -->

                  

                                 <div class="col-lg-4">
                  <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Choisir une Direction: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" name="direction" required="required" >
                   <option value="">-- Direction--</option>
                     @foreach($departements as $key =>$departement) 
                                        @if($departement->id==$edituser->departement_id)
                                        <option value="{{ $departement->id }}" checkded>{{ $departement->nom}}</option>
                                        @else
                                        <option value="{{ $departement->id }}">{{ $departement->nom}}</option>
                                        @endif
                                         @endforeach
                      
                     
                    </select>
                  </div>
                </div>
                </div>

                                

                                

                  <!--               <div class="form-group">
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
                         -->      
                          <div class="form-layout-footer">
                <button class="btn btn-success mg-r-5" type="submit">Enregistrer </button>
                <button class="btn btn-secondary">Cancel</button>
              </div><!-- form-layout-footer -->  
                                
                                   <!--  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Valider</button> -->
                                
                                 </form>
                                 @endforeach
            </div>
          </div>
         
        </div>
      </div>
      <!-- content-wrapper ends -->
  
@stop



