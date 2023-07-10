@extends('pages.Default')
@section('content')
         @if(session()->has('success'))
                      <div class="alert alert-success alert-dismissible" style="width: 100%; background: green">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Succés!</strong> {{session()->get('success')}}
</div>                       
               @endif
               <div class="main-panel">
        <div class="content-wrapper">
<div class="sh-pagebody">
               <div class="card-header bg-primary tx-white">Detail du courrier Annoté:</div>

      <!-- <h6 style="text-transform: uppercase;font-weight: bolder;">Detail du courrier Annoté:</h6> -->
            <div class="row grid-margin">
            <div class="col-lg-12 col-md-12">
              <div class="card" style="background: white;">
                <div class="card-body">
                  <h4 class="card-title"></h4>
                  
                    <fieldset>
                            <form class="forms-sample" method="POST" action="/affectiondirection" enctype='multipart/form-data' >
                        {{ csrf_field() }}


                       @foreach($courriers as $key =>$courrier) 
    <div class="row"> 
                        <div class="blink col-md-12 card card-body ">
                          <div class="form-group row {{$courrier->couleur_name}}">
                        <label for="priorite" class="col-sm-3 col-form-label">{{$courrier->priorite_name}}</label>  
                      </div>
                      </div>
                       </div>
                           


                                
                                
<div class="row"> 


 <input type="hidden" name="id" value="{{ $courrier->id}}">
<div class="col-md-6">
  
                      <div class="form-group row">
                        <label for="numero" class="col-sm-3 col-form-label">Numéro</label>
                          <div class="col-sm-9">
                        <input id="numero" class="form-control" name="numero" type="" value="{{$courrier->numero}}" required="required" disabled >
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="type_courrier" class="col-sm-3 col-form-label">Type Courrier</label>
                          <div class="col-sm-9">
                            <input id="type_courrier" class="form-control" name="type_courrier" type="" value="{{$courrier->type_courrier}}" required="required" disabled >

                       
                </div>
                        
                      </div>
                      <div class="form-group row">
                        <label for="destinataire" class="col-sm-3 col-form-label">Origine</label>
                          <div class="col-sm-9">
                        <input id="destinataire" class="form-control" name="destinataire" type="text" required="required" value="{{$courrier->destinataire}}" disabled >
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email Origine</label>
                           <div class="col-sm-9">

                        <input id="email" class="form-control" name="email" type="text" required="required" value="{{$courrier->email}}" disabled  >
                      </div>
                    </div>

                    <div class="form-group row">
                        <label for="date_arrivee" class="col-sm-3 col-form-label">Date de Reception</label>
                          <div class="col-sm-9">
                        <input id="date_arrivee" class="form-control" name="date_arrivee" type="text" required="required" value="{{$courrier->date_arrivee}}"disabled >
                      </div>
                      </div>
</div>
<div class="col-md-6">

                      <div class="form-group row">
                        <label for="telephone" class="col-sm-3 col-form-label">Téléphone</label>
                        <div class="col-sm-9">
                        <input id="telephone" class="form-control" name="telephone" type="text" required="required"  value="{{$courrier->telephone}}" disabled >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="reference" class="col-sm-3 col-form-label">Reference</label>
                         <div class="col-sm-9">
                        <input id="reference" class="form-control" name="reference" type="text"  value="{{$courrier->reference}}" disabled >
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="objet" class="col-sm-3 col-form-label">Objet</label>
                          <div class="col-sm-9">
                        <input id="objet" class="form-control" name="objet" type="text" required="required" value="{{$courrier->objet}}"disabled >
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="file_path" class="col-sm-3 col-form-label">Courrier</label>
                          <div class="col-sm-9">
                            <a target="_blank" href="{{asset('documents/Arrives/'.$courrier->file_path) }}"  class="form-control" ><i class="mdi mdi-folder-download"></i>Ouvrir le Courrier </a>
                      
                      </div>
                    </div>

                    <div class="form-group row">
                        <label for="date_arrivee" class="col-sm-3 col-form-label">Date d'Affectation</label>
                          <div class="col-sm-9">
                        <input id="date_affectation" class="form-control" name="date_affectation" type="text" required="required" value="{{$courrier->date_affectation}}"disabled>
                      </div>
                      </div>
</div>
</div>
 <hr>
   <div class="row" >
    
      <fieldset>
        <legend>Annotation</legend>
    
                
            
                @if($courrier->commentaireRelance!='')
                 <div class="form-group row"> 
                <div class="col-md-6" id="annotatio">
              <div class="card" id="annoter" style="">
                <div class="card-body">
                  <h4 class="card-title">Observation Directeur Général</h4>
                   <div class="form-group">{{ $courrier->commentaire }}</div>

                </div>
                </div>
              </div>
                  <div class="col-lg-6" id="annotatio">
                    <div class="card" id="annoter" style="">
                <div class="card-body">
                  <h4 class="card-title">Commentaire Relance</h4>
                  <textarea cols="40" rows="5" disabled>{!! $courrier->commentaireRelance !!}</textarea>
                  
                </div>
                </div>
                 </div>
                  </div>
                  <div class="form-group row">       
            <div class="col-md-6" id="annotatio">
              <div class="card" id="annoter" style="">
                <div class="card-body">
                  <h4 class="card-title">Observation Directeur</h4>
                   <div class="form-group">{{ $courrier->commentaire_manager }} </div>

                </div>
                </div>
              </div>
               </div>
                @endif
</div>
                     @if($courrier->commentaireRelance=='')
                 
<div class="card bd-primary">
              <div class="card-header bg-primary tx-white">Observation de la Directrice Générale</div>
              <div class="card-body">
              {!! $courrier->commentaire !!}
              </div><!-- card-body -->
            </div><!-- card -->


               <!--  <div class="col-md-6" id="annotatio">
              <div class="card" id="annoter" style="">
                <div class="card-body">
                  <h5 class="card-title">Observation du MINISTRE</h5>
                   <div class="form-group">{!! $courrier->commentaire !!}</div>

                </div>
                </div>
              </div> -->
          @if($courrier->direction_affectation>0)           
<div class="card bd-primary">
              <div class="card-header bg-primary tx-white">Observation Directeur du Département </div>
              <div class="card-body">
              {!! $courrier->commentaire_manager !!}
              </div><!-- card-body -->
            </div><!-- card -->
            @endif

         
               </div>
                @endif
              

            
         
           
            </fieldset>
                      </div>
                      @if($courrier->direction_affectation>0)
                      @if(Auth::user()->user_role>=6)
                      
                      <a href="{{route('RepondreCourrier',$courrier->courrier_id)}} "class="btn btn-success waves-effect"><i class="mdi mdi-eye"></i>
                       Repondre au courrier
                       </a> 
                       @endif
                       @endif

                       @if($courrier->affecter_groupe>0)
                       @if(Auth::user()->groupe_id>=1)
                      
                      <a href="{{route('RepondreCourrier',$courrier->courrier_id)}} "class="btn btn-success waves-effect"><i class="mdi mdi-eye"></i>
                       Repondre au courrier
                       </a> 
                       @endif
                       @endif
                      @endforeach
                      </div>
                     

                  

           
<div class="row">


                         
                      </div>
                      
                      
                     </form>
                        


                    </fieldset>
                  
                </div>
              </div>
            </div>
          </div>
          </div>
          
          </div>

          @stop
