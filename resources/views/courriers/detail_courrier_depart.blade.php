@extends('pages.Default')
@section('content')
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
               <div class="sh-pagebody">
               <div class="card-header bg-primary tx-white">Détail courrier Départ</div>
               <div class="main-panel">
        <div class="content-wrapper">
          
       
               <div class="row grid-margin">
            <div class="col-lg-12 col-md-12">
              <div class="card" style="background: #FFFFFF;">
                <div class="card-body">
                  <h4 class="card-title"></h4>
                  
                    <fieldset>
                            <form class="forms-sample" method="POST" action="/anotationdirection" enctype='multipart/form-data' >
                        {{ csrf_field() }}


                                
                                
<div class="row"> 
  

                       @foreach($courriers as $key =>$courrier) 
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
                        <label for="reference" class="col-sm-3 col-form-label">Reférence</label>
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
                            <a target="_blank" href="{{asset('documents/Depart/'.$courrier->file_path) }}"  class="form-control" ><i class="mdi mdi-folder-download"></i>Ouvrir le Courrier</a>
                      
                      </div>
                    </div>

                    <div class="form-group row">
                        <label for="synthese" class="col-sm-3 col-form-label">Synthèse</label>
                          <div class="col-sm-9">
                        <input id="synthese" class="form-control" name="synthese" type="text" required="required" value="{{$courrier->synthese}}"disabled >
                      </div>
                      </div>

                      <div class="form-group row">
                        <label for="date_arrivee" class="col-sm-3 col-form-label">Date Enregistrement</label>
                          <div class="col-sm-9">
                        <input id="date_arrivee" class="form-control" name="date_arrivee" type="text" required="required" value="{{$courrier->date_arrivee}}"disabled >
                      </div>
                      </div>
</div>
                      @endforeach
                      </div>
                      <hr>
@if($courrier->courrier_etat=="expedié")
  @if(Auth::user()->user_role==4)

                                                <a href="{{route('dechargeCourrier',$courrier->id)}}" class="btn  btn-primary waves-effect"><i class="mdi mdi-share-variant"></i>

                                    <span>Enregistrer la decharge</span> 
                                  </a>
                                   @endif
                                    @endif
@if(($courrier->courrier_etat=="decharge"))
<fieldset>
        <legend>Décharge Courrier</legend>

                 <div class="form-group row">
                        <label for="objet" class="col-sm-3 col-form-label">Commentaire décharge</label>
                          <div class="col-sm-9">
                        <input id="objet" class="form-control" name="objet" type="text" required="required" value="{{$courrier->objet}}"disabled >
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="file_path" class="col-sm-3 col-form-label">Courrier décharge</label>
                          <div class="col-sm-9">
                            <a target="_blank" href="{{asset('documents/decharges/'.$courrier->fichierDecharge) }}"  class="form-control" ><i class="mdi mdi-folder-download"></i>Ouvrir le Courrier </a>
                      
                      </div>
                    </div>    

 </fieldset>

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
