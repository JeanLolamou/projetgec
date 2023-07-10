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
               <div class="card-header bg-primary tx-white">Detail Reponse courrier:</div>
       
      
            <div class="row grid-margin">
            <div class="col-lg-12 col-md-12">
              <div class="card" style="background: white;">
                <div class="card-body"><p style="text-transform: uppercase;"> Détails Courrier: </p>
                  <fieldset>
                           

@foreach($courriers as $key =>$courrier) 
                    
                               
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

                        <input id="email" class="form-control" name="email" type="text" required="required" value="{{$courrier->email}}" disabled >
                      </div>
                    </div>

                    <!--  <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Sécretaire en charge</label>
                          <div class="col-sm-9">
                        <input id="name" class="form-control" name="secre" type="text" required="required" value="{{$courrier->name}}"disabled >
                      </div>
                      </div> -->

                    <div class="form-group row">
                        <label for="date_arrivee" class="col-sm-3 col-form-label">Date Enregistrement</label>
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
                            <a target="_blank" href="{{asset('documents/Arrives/'.$courrier->file_path) }}"  class="form-control"><i class="mdi mdi-folder-download"></i>Ouvrir le Courrier </a>
                      
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
 
    
      <fieldset>
        <legend>Annotation</legend>
         @if($courrier->commentaireRelance!='')
<div class="card bd-primary">
              <div class="card-header bg-primary tx-white">Observation Du Ministre</div>
              <div class="card-body">
                {!! $courrier->commentaire !!}
              </div><!-- card-body -->
            </div><!-- card -->

                 <div class="form-group row"> 
                <div class="col-md-6" id="annotatio">
              <div class="card" id="annoter" style="">
                <div class="card-body">
                  <h4 class="card-title">Observation Du Ministre</h4>
                  <textarea cols="80"  rows="10" disabled>{!! $courrier->commentaire !!}</textarea>

                </div>
                </div>
              </div>
                  <div class="col-lg-6" id="annotatio">
                    <div class="card" id="annoter" style="">
                <div class="card-body">
                  <h4 class="card-title">Commentaire Relance</h4>
                  <textarea cols="80" rows="10" disabled>{!! $courrier->commentaireRelance !!}</textarea>
                  
                </div>
                </div>
                 </div>
                  </div>
                  <div class="form-group row">       
            <div class="col-md-6" id="annotatio">
              <div class="card" id="annoter" style="">
                <div class="card-body">
                  <h4 class="card-title">Observation Directeur Département</h4>
                  <textarea cols="80"  rows="10" disabled>{!! $courrier->commentaire_manager !!}</textarea>

                </div>
                </div>
              </div>
               </div>
                @endif
                     @if($courrier->commentaireRelance=='')
                 <div class="form-group"> 
 <div class="card bd-primary">
              <div class="card-header bg-primary tx-white">Observation Directrice Générale</div>
              <div class="card-body">
                {!! $courrier->commentaire !!}
              </div><!-- card-body -->
            </div><!-- card -->
</div>

                <!-- <div class="col-md-6" id="annotatio">
              <div class="card" id="annoter" style="">
                <div class="card-body">
                  <h4 class="card-title">Observation Du Ministre</h4>
                  <textarea cols="40"  rows="5" disabled>{!! $courrier->commentaire !!}</textarea>

                </div>
                </div>
              </div> </div> -->


                        
<div class="card bd-primary">
              <div class="card-header bg-primary tx-white">Observation Directeur Departement <span style="float: right;">{!! $courrier->date_affectationManager !!}</span></div>
              <div class="card-body">
                {!! $courrier->commentaire_manager !!}
                <!-- <h4 class="card-title">Affecté à <b>{{$courrier->name}}</b> le: {!! $courrier->date_affectationManager !!}</h4> -->
              </div><!-- card-body -->
            </div><!-- card -->



            <!-- <div class="col-md-6" id="annotatio"> 
              <div class="card" id="annoter" style="">
                <div class="card-body">
                  <h4 class="card-title">Observation Directeur Departement</h4>
                  <textarea cols="40"  rows="5" disabled>{!! $courrier->commentaire_manager !!}</textarea>
                  <h4 class="card-title">Affecté à <b>{{$courrier->name}}</b> le: {!! $courrier->date_affectationManager !!}</h4>

                </div>
                </div>
              </div> -->
              
                @endif
        

            </fieldset>

              <fieldset>

        <legend>Traitement</legend>
        <div class="card bd-primary">
              <div class="card-header bg-primary tx-white">Observation De: <b>{{$courrier->name}}</b></div>
              <div class="card-body">
                {!! $courrier->commentaireReponse !!}
              </div><!-- card-body -->
            </div><!-- card -->
        
                 <div class="form-group row"> 
                <!-- <div class="col-md-6" id="annotatio">
              <div class="card" id="annoter" style="">
                <div class="card-body">
                  <h4 class="card-title">Observation De:<b>{{$courrier->name}}</b> </h4>
                  <textarea cols="40"  rows="5" disabled>{!! $courrier->commentaireReponse !!}</textarea>

                </div>
                </div>
              </div> -->
                        @if(!empty($courrier->document))
            <div class="col-md-6" id="annotatio">
              <label for="file_path" class="col-sm-3 col-form-label">Courrier Traité</label>
                          <div class="col-sm-9">
                            <a target="_blank" href="{{asset('documents/Traités/'.$courrier->document) }}"  class="form-control" ><i class="mdi mdi-folder-download"></i>Ouvrir le Courrier </a>
                      
                      </div>
              </div>
              @endif
               </div>
             
        

            </fieldset>
                      
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
