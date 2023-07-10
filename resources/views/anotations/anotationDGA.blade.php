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
          
        
               <div class="row grid-margin">
            <div class="col-lg-12 col-md-12">
              <div class="card" style="background: white;">
                <div class="card-body">
                  <h4 class="card-title"></h4>
                  
                    <fieldset>
                            <form class="forms-sample" method="POST" action="/affectiondirection" enctype='multipart/form-data' >
                        {{ csrf_field() }}

                               
                                
<div class="row"> 
  

                       @foreach($courriers as $key =>$courrier) 
 <input type="hidden" name="id" value="{{ $courrier->courrier_id}}">
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
                            <a target="_blank" href="{{asset('documents/Arrives/'.$courrier->file_path) }}"  class="form-control" ><i class="mdi mdi-folder-download"></i>Ouvrir le Courrier </a>
                      
                      </div>
                    </div>
</div>

                      @endforeach
                      </div>





                      <hr>
                      <div class="row">
      <div class="col-lg-6" id="">
<label class="control-label" for="typeannotation">Annotation type </label>
<select name="commentairAnnotation" id="typeannotation" class="browser-default custom-select" data-validate="required" required style="  overflow-y: scroll;scroll-behavior: auto;">
  <option>Choisir un type d'annotation</option>

@foreach($annotationtypes  as $key =>$annotationtype)
 <option value="{{$annotationtype->commentairAnnotation}}">{{$annotationtype->commentairAnnotation}}</option>
@endforeach
</select>
<!-- @foreach($annotationtypes  as $key =>$annotationtype)
<input type="button" class="btn btn-primary" onclick="myFunction();"  value="{{$annotationtype->commentairAnnotation}} " id="com{{$annotationtype->id}}" >  
@endforeach -->
</div>

<div class="col-lg-6">
                                        <label class="form-label">Priorité</label>
                                    <div class="form-line" style="background: white;">
                                        <select class="form-control" id="example-fontawesome" autocomplete="off" name="priorite" required="required">
                                        <option value="">-- Priorite --</option>
                                        @foreach($priorites as $key =>$priorite) 
                                        <option value="{{ $priorite->id }}">{{ $priorite->priorite_name}}</option>
                                         @endforeach      
                                    </select>   
                                    </div>
                                </div>
                                </div>

                      <div class="row">
                        <div class="col-lg-12" id="annotatio">
              <div class="card" id="annoter" style="">
                <div class="card-body">
                  <h4 class="card-title">Commentaire</h4>
                  <textarea cols="80" rows="5" name="commentaire" id="commentaire"  style=""></textarea>
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
            <div class="col-md-4" id="selectdirection">
                        <div class="form-group" id="affectdirection"> 
                          <label class="control-label" for="direction">Affecter à une Direction</label>
<select name="direction" id="direction" class="form-control" data-validate="required" required>
  <option>-- Selectionnez</option>
                            @foreach($directions as $direction)
                            @if($direction->id!=1)
                                <option value="{{$direction->id}}">{{$direction->nom}}</option>
                                @endif
                            @endforeach 
</select>
</div>
                        </div>

        


 <!-- <div class="col-md-4" id="selectdirection">
                        <div class="form-group" id="affectdirection"> 
                          <label class="control-label" for="service">Affecter à un Service</label>
<select name="service" id="service" class="form-control" data-validate="required" required>
  <option>-- Selectionnez</option>
                            @foreach($services as $service)
                            @if($service->id!=1)
                                <option value="{{$service->id}}">{{$service->nom_service  }}</option>
                                @endif
                            @endforeach 
</select>
</div>
                        </div> -->


    <div class="col-md-4" id="selectdirection">
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



                        <!--  <div class="col-md-4" id="selectdirectio1n">
                        <div class="form-group" id="affectdirect1ion"> 
                          <label class="control-label" for="user">Affecter à un Collaborateur</label>
<select name="collaborateur" id="user" class="form-control" data-validate="required" required>
  <option>-- Selectionnez</option>
                            @foreach($utilisateurs as $utilisateur)
                            @if($utilisateur->id!=Auth::user()->id)
                               <option value="{{$utilisateur->id}}">{{$utilisateur->name}}</option>
                                @endif
                            @endforeach 
</select>
</div>
                        </div> -->

                   <div class="col-md-4" id="selectdirection">
                        <div class="form-group" id="affectdirection"> 
                          <label class="control-label" for="groupe">Affecter à un Groupe</label>
                <select name="groupe" id="groupe" class="form-control" data-validate="required" required>
  <option>-- Selectionnez</option>
                            @foreach($groupes as $groupe)
                            @if($groupe->id!=1)
                                <option value="{{$groupe->id}}">{{$groupe->nom_groupe  }}</option>
                                @endif
                            @endforeach 
</select>
</div>
                        </div>
                        @if(Auth::user()->user_role==2)     
                        <div class="col-md-6" >             
                          <div id="visibleH"></div>                        
                          <br>                          
                         </div>                           
                         @endif
            
         
        </div>
                       
            
         
     
<div class="col-md-4" >
            <button type='submit'  id='submit' class='btn btn-success' data-type='success'>Envoyer </button> 
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
            <div class="card" style="background: beige;">
                <div class="card-body">
                  <h4 class="card-title">Affectation du courrier</h4>
                  <p>Aucun courrier à affecter</p>
                  </div>
                    
                  </div>
            @endif
          </div>

          @stop
