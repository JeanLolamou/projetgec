    
@extends('pages.Default')
@section('content')
    <div class="card bd-primary mg-t-20">
          <div class="card-header bg-primary tx-white">Modifier une Couleur</div>
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
              
              <div class="row mg-b-25">
                <div class="col-lg-4">
                  <div class="form-group">
                    <form  method="POST" class="pt-3" action="{{route('couleurupdate')}}">
                                      {{ csrf_field() }}
                                {{ method_field('PUT') }}

             <input class="form-control" type="hidden" name="id" value="{{$editcouleurs->id}}">
                    <label class="form-control-label">Nom de la Couleur <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="couleur_name" value="{{$editcouleurs->couleur_name}}">

                       <label class="form-control-label">Code de la Couleur <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="code_couleur" value="{{$editcouleurs->code_couleur}}">
                     </div>
                   <div class="form-layout-footer">
                <button class="btn btn-success mg-r-5" type="submit">Enregistrer</button>
                <button class="btn btn-secondary" type="reset">Annuler</button>
              </div><!-- form-layout-footer -->

               </form>

                  </div>
                
              </div><!-- col-4 -->
               
              
                
                
                
              </div><!-- row -->

              
            </div><!-- form-layout -->
          </div><!-- card-body -->
        </div><!-- card -->
        @endsection