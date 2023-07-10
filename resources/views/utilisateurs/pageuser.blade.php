@extends('pages.Default')
@section('content')

<div class="card bd-primary mg-t-20">
          <div class="card-header bg-primary tx-white">Ajouter Utilisateur</div>
            <div class="card-body pd-sm-30">
            <div class="form-layout">

              @if (session('success'))
              <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="d-flex align-items-center justify-content-start">
                <i class="icon ion-ios-checkmark alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                <span>{{session('success') }}</span>
              </div><!-- d-flex -->
            </div><!-- alert -->                   
                    @endif
                    @foreach ($personnel as $personnels)
                    <form action="{{ route('User.update', $personnels->id) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input disabled type="hidden" name="modif" value="1">

              <div class="row mg-b-25">


                <div class="col-lg-4">
                    
                    <label class="form-control-label">Nom & Prénom  <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="name"  value="{{$personnels->name}}" required="required">
                  </div>
             <!-- col-4 -->
                
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Adress Email<span class="tx-danger">*</span></label>
                    <input class="form-control" type="email" name="email"  value="{{$personnels->email}}" required="required">
                  </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Numéro de Téléphone<span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="telephone"  value="{{$personnels->telephone}}">
                  </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                  <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Mot de Passe <span class="tx-danger">*</span></label>
                    <input class="form-control" type="password" name="password"  value="{{$personnels->password}}" required="required">
                  </div>
                </div><!-- col-8 -->
                <div class="col-lg-4">
                  <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Poste: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" name="poste" value="{{$personnels->User_poste}}" required="required">
                    <option label="Selectionner"></option>
                      @foreach($postes as $poste)
          
                      <option value="{{$poste->id}} "> {{$poste->User_poste}} </option>

                      @endforeach
                      
                     
                    </select>
                  </div>
                </div><!-- col-4 -->

 <div class="col-lg-4">
                  <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Departement: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" name="id_departement" value="{{$personnels->nom}}" required="required">
                    <option label="Selectionner"></option>
                      @foreach($departements as $departement)
          
                      <option value="{{$departement->id}} "> {{$departement->nom}} </option>

                      @endforeach
                      
                     
                    </select>
                  </div>
                </div><!-- col-4 -->

             


              </div><!-- row -->

              <div class="form-layout-footer">
                <button class="btn btn-success mg-r-5" type="submit">Enregistrer </button>
                <button class="btn btn-secondary">Cancel</button>
              </div><!-- form-layout-footer -->
            </form>
            </div><!-- form-layout -->
          </div><!-- card-body -->
        </div><!-- card -->
        @endsection