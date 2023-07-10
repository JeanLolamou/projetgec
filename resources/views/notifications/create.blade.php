    
          @extends('pages.Default')
@section('content')

<div class="card bd-primary mg-t-20">
          <div class="card-header bg-primary tx-white">Ajouter Notification </div>
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
                    <form action="ajoutnotification" method="post">
                  {!! csrf_field() !!}

              <div class="row mg-b-25">


                <div class="col-lg-4">
                    
                   <label class="form-control-label">Personne A Notifier <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="notifier" placeholder="Saisir la Personne à Notifier" required="required">
                  </div>
             <!-- col-4 -->
                
                <div class="col-lg-4">
                  <label class="form-control-label"> Personne Annotée  <span class="tx-danger"></span></label>
                    <input class="form-control" type="text" name="annoter" placeholder="Saisir la personne Annotée" required="required">
                </div><!-- col-4 -->
               </div><!-- row -->

               <div class="col-lg-4">
                  <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Collaborateur <span class="tx-danger">*</span></label>
                    <select class="form-control select2" name="id_users" data-placeholder="Choisir un Collaborateur" required="required">
                    <option label="Selectionner"></option>
                      @foreach($users as $user)
          
                      <option value="{{$user->id}} "> {{$user->name}} </option>

                      @endforeach
                      
                     
                    </select>
                  </div>
              

              <div class="form-layout-footer">
                <button class="btn btn-success mg-r-5" type="submit">Enregistrer </button>
                <button class="btn btn-secondary">Cancel</button>
              </div><!-- form-layout-footer -->
            </form>
            </div><!-- form-layout -->
          </div><!-- card-body -->
        </div><!-- card -->
        @endsection