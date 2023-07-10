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
               <div class="card-header bg-primary tx-white">Repondre à un courrier:</div>

     
            <div class="row grid-margin">
            <div class="col-lg-12 col-md-12">
              <div class="card" style="background: white;">
                <div class="card-body">
                  <h4 class="card-title"></h4>
                  <fieldset>
                           

@foreach($courriers as $key =>$courrier) 
  <form class="forms-sample" method="POST" action="/reponseAuCourrier" enctype='multipart/form-data' >
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $courrier->id}}"> 
                        
                        
                       

                  <div class="col-lg-12" id="annotatio">
                    <div class="card" id="annoter" style="">
                <div class="card-body">
                  <h4 class="card-title">reponse </h4>
              
                  <div class="form-group">
                        <label for="file_path">Joindre un fichier</label>
                        <input id="file_path" class="form-control" name="file_path" type="file" >
                      </div>
                      <div class="form-group">
                        <label for="file_path">Commentaire</label> 
                  <textarea cols="40" id="" name="reponse" rows="5" ></textarea>
              </div>
                    <button type='submit'  id='submit' class='btn btn-success' data-type='success'>Envoyer </button>
             
            
          </div>
          </div>
          </div>
        </form>
       
                                
<hr>                                
<div class="row"> 
  

                       
 
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
                            <a target="_blank" href="{{asset('documents/Arrives/'.$courrier->file_path) }}"  class="form-control"><i class="mdi mdi-folder-download"></i>Ouvrir le Courrier </a>
                      
                      </div>
                    </div>
</div>
</div>

                      @endforeach
                      </div>
                     
                  

           

                      
                      
                  


                    </fieldset>
                  
                </div>
              </div>
            </div>
          </div>
          </div>
         
          </div>

          @stop
