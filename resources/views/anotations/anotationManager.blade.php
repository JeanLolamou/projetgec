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
          @if(count($courrierAttentes)>0)
            
           <div class="sh-pagebody">
               <div class="card-header bg-primary tx-white">Annotation du courrier:</div>
        <!--  <h6 style="text-transform: uppercase;font-weight: bolder;">Annotation du courrier</h6> -->
               <div class="row grid-margin">
            <div class="col-lg-12 col-md-12">
              <div class="card" style="background: white;">
                <div class="card-body">
                  <h4 class="card-title"></h4>
                  
                    <fieldset>
                            <form class="forms-sample" method="POST" action="/affectionManager" enctype='multipart/form-data' >
                        {{ csrf_field() }}


                                
                                
<div class="row"> 
  

                       @foreach($courriers as $key =>$courrier) 
 <input type="hidden" name="id" value="{{ $courrier->id}}">
 <input type="hidden" name="courrier_id" value="{{ $courrier->courrier_id}}">
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
</div>
<div class="col-md-6">

                      <div class="form-group row">
                        <label for="telephone" class="col-sm-3 col-form-label">Téléphone</label>
                        <div class="col-sm-9">
                        <input id="telephone" class="form-control" name="telephone" type="text" required="required"  value="{{$courrier->telephone}}" disabled >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="reference" class="col-sm-3 col-form-label">Référence</label>
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
                            <a target="_blank" href="{{asset('documents/Arrives/'.$courrier->file_path) }}"  class="form-control"><i class="mdi mdi-folder-download"></i>Ouvrir le Courrier </a>
                      
                      </div>
                    </div>
</div>
                      @endforeach
                      </div>
                      <hr>

                      <div class="row">
                        <div class="col-lg-12" id="annotatio">
              <div class="card" id="annoter" style="">
                <div class="card-body">
                  <h4 class="card-title">Commentaire</h4>
                  <textarea cols="40"  name="commentaire" rows="5" style=""></textarea>
                </div>
              </div>

             
            </div>

                        
<!--                         <div class="form-group" id="affectemploye">
<label class="control-label" for="employe">Choisir un responsable</label>
<select name="employe" id="employe" class="browser-default custom-select" data-validate="required" required>


</select>
</div> -->
                        </div>
                         
                      

                      <div class="row" >
            <div class="col-md-6" id="selectdirection">
                        <div class="form-group" id="affectdirection"> 
                          <label class="control-label" for="employe">Affecter à un collaborateur</label>
<select name="employe" id="employe" class="form-control" data-validate="required" required>
  <option>-- Selectionnez</option>
                            @foreach($utilisateurs as $utilisateur)
                            @if($utilisateur->id!=Auth::user()->id)
                                <option value="{{$utilisateur->id}}">{{$utilisateur->name}}</option>
                            @endif
                            @endforeach 
</select>
</div>
                        </div>
                          <div class="col-md-6" id="selectdirection">
                        <div class="form-group" id="affectdirection"> 
                          <label class="control-label" for="service">Affecter à un Service</label>
<select name="service" id="service" class="form-control" data-validate="required" required>
  <option>-- Selectionnez</option>
                            @foreach($directions as $departement)
                            
                                <option value="{{$departement->id}}">{{$departement->nom }}</option>
                                
                            @endforeach 
</select>
</div>
                        </div>
                        <div class="col-md-6" id="selectemploye">
                         <p></p>
                          <br>
            <button type='submit'  id='submit' class='btn btn-success' data-type='success'>Envoyer </button>
          </div>
        </div>

                      
                      
                     </form>
                        


                    </fieldset>
                  
                </div>
              </div>
            </div>
          </div>
          </div>
          @endif
            @if(count($courrierAttentes)==0 )
            <div class="card" style="background: white;">
                <div class="card-body">
                  <h4 class="card-title">Annotation du courrier</h4>
                  <p>Aucun courrier à annoter</p>
                  </div>
                    
                  </div>
            @endif
          </div>

          @stop
