@extends('pages.Default')
@section('content')
      

<div class="main-panel">
        <div class="content-wrapper p-0">
             @if(session()->has('success'))
                      <div class="alert alert-success alert-dismissible" style="width: 100%;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Succés!</strong> {{session()->get('success')}}
</div>                       
@endif

<div class="card bd-primary mg-t-20">
          <div class="card-header bg-primary tx-white">Ajouter un groupe:</div>
            <div class="card-body pd-sm-30">
            <div class="form-layout">


 
     
              <!-- <h6 class="font-weight-light">Join us today! It takes only few steps</h6> -->
              <form id="form_validation" method="POST" class="pt-3" action="ajoutgroupe">
                                      {{ csrf_field() }}
                                

               <div class="row mg-b-25">


                <div class="col-lg-4">
                    
                   <label class="form-control-label">Nom du Groupe <span class="tx-danger">*</span></label>
                    <input id="nom" class="form-control" type="text" name="nom" placeholder="Saisir le Nom du Groupe" required="required">
                  </div>
             <!-- col-4 -->
                
                <div class="col-lg-4">
                  <div class="form-group">
                   <label class="form-control-label">Sigle <span class="tx-danger">*</span></label>
                   <input class="form-control" type="text" name="sigle" placeholder="Saisir le sigle">
                    
                     
                    
                  </div>
                </div><!-- col-4 -->
               </div><!-- row -->
              


                <div class="form-layout-footer">
                <button class="btn btn-success mg-r-5" type="submit">Enregistrer </button>
                <button class="btn btn-secondary">Cancel</button>
              </div><!-- form-layout-footer -->
                                 </form>
            </div>
          </div>
          </div>
         

@stop
