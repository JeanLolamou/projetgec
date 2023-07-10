  @extends('pages.Default')
@section('content')

<div class="card bd-primary mg-t-20">
          <div class="card-header bg-primary tx-white">Ajouter Un Sous Département </div>
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
                    <form action="{{ url('addSousdepartement') }}" method="post">
                  {!! csrf_field() !!}

              <div class="row mg-b-25">


                <div class="col-lg-4">
                    
                    <label class="form-control-label">Sous Département <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="sousdepartement_name"  placeholder="Saisir le sous departement" required="required">
                  </div>
                  <div class="col-lg-4">
                    
                    <label class="form-control-label">Sigle <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="sigle"  placeholder="Saisir le sigle">
                  </div>
             <!-- col-4 -->
                
                <div class="col-lg-4">
                  <div class="form-group">
                   <label class="form-control-label">Departement: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" name="id_departement" data-placeholder="Choisir un Departement" required="required">

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