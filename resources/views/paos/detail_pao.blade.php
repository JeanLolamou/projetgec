@extends('pages.Default')
@section('content')
         @if(session()->has('success'))
                      <div class="alert alert-success alert-dismissible"  style="width: 100%;background: green">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Succés!</strong> {{session()->get('success')}}
</div>                       
               @endif
               <div class="sh-pagebody">
               <div class="card-header bg-primary tx-white">Détail courrier:</div>
               <div class="main-panel">
        <div class="content-wrapper">
         
               <div class="row grid-margin">
            <div class="col-lg-12 col-md-12">
              <div class="card" style="background: beige;">
                <div class="card-body">
                  <h4 class="card-title"></h4>
                  
                    <fieldset>
                            <form class="forms-sample" method="POST" action="/anotationdirection" enctype='multipart/form-data' >
                        {{ csrf_field() }}


                                
                                

  

                       @foreach($courriers as $key =>$courrier) 
                       <div class="row"> 
                        <div class="col-md-12 card card-body ">
                          <div class="form-group row {{$courrier->couleur_name}}" >
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
                        <label for="telephone" class="col-sm-3 col-form-label">Téléphone Origine</label>
                        <div class="col-sm-9">
                        <input id="telephone" class="form-control" name="telephone" type="text" required="required"  value="{{$courrier->telephone}}" disabled >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Sécretaire en charge</label>
                          <div class="col-sm-9">
                        <input id="name" class="form-control" name="name" type="text" required="required" value="{{$courrier->name}}"disabled >
                      </div>
                      </div>
</div>
<div class="col-md-6">

                      
                      <div class="form-group row">
                        <label for="reference" class="col-sm-3 col-form-label">Réference</label>
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
                        <label for="synthese" class="col-sm-3 col-form-label">Synthèse</label>
                          <div class="col-sm-9">
                        <input id="synthese" class="form-control" name="synthese" type="text" required="required" value="{{$courrier->synthese}}"disabled >
                      </div>
                      </div>

                    

                        <div class="form-group row">
                        <label for="date_arrivee" class="col-sm-3 col-form-label">Date de Reception</label>
                          <div class="col-sm-9">
                        <input id="date_arrivee" class="form-control" name="date_arrivee" type="text" required="required" value="{{$courrier->date_arrivee}}"disabled >
                      </div>
                      </div>

                      <div class="form-group row">
                        <label for="date_arrivee" class="col-sm-3 col-form-label">Date d'Affectation</label>
                          <div class="col-sm-9">
                        <input id="date_affectation" class="form-control" name="date_affectation" type="text" required="required" value="{{$courrier->date_affectation}}"disabled>
                      </div>
                      </div>


</div>
                      @endforeach
                      </div>
                      <hr>
@if(($courrier->courrier_etat=="attente")&&(Auth::user()->user_role==2)||(Auth::user()->user_role==8))

                      <div class="row">
                        <div class="col-md-4"> <button class="btn btn-primary btn-lg" type="submit" id="affecter"><i class="mdi mdi-share-variant"></i> Annoter le courrier</button> </div>
                        
                         <a href="{{route('RepondreCourrier',$courrier->id)}} "class="btn btn-success waves-effect"><i class="mdi mdi-eye"></i>

   <span>Repondre</span> </a>
                      </div>
                      @endif

                     </form>
                     
                    </fieldset>
                  
                </div>
              </div>
            </div>
          </div>
          </div>
          </div>
</div><!-- sh-pagebody -->
          @stop
