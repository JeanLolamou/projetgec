@extends('templates/page/default')
         @section('contenu')
      

<div class="main-panel">
        <div class="content-wrapper p-0">
             @if(session()->has('success'))
                      <div class="alert alert-success alert-dismissible" style="width: 100%;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Succés!</strong> {{session()->get('success')}}
</div>                       
@endif
 <div class="card">
                        <div class="card-body">


              <form id="form_validation" method="POST" class="pt-3" action="{{ route('present_rendez_vous_update') }}">
                                      {{ csrf_field() }}
                                {{ method_field('PUT') }}

     @foreach($editvisiteur as $key =>$visiteur) 
     <h1> Détail Rendez-vous <b style="color: blue">{{$visiteur->numerovisite}}</b></h1>
              
           <input type="hidden" name="id" value="{{$visiteur->id}}">

                <div class="form-group">
  <div class="row">
  <div class="col-md-6">
     <div class="form-group">
                        <label for="titre">Titre *</label>
                         <div class="input-group" style="background: white;">
                   
                        <input id="titre" class="form-control" name="titre" type="text" required="required"  style="background: white;" value="{{$visiteur->titre}}" disabled>
                      </div>
                         </div>
                          <div class="form-group">
                        <label for="motif">Motif</label>
                        <input name="motif" id="motif" type="" class="form-control"  required="required"  style="background: white;" value="{{$visiteur->motif}}" disabled>
                        
                      </div>

                    <label for="date_rendez_vous">Date Rendez-vous</label>

                             <div class="input-group" style="background: white;">
               
                        <input id="date_rendez_vous" class="form-control" name="date_rendez_vous" type="datetime-local" id="meeting-time" value="{{$visiteur->date_rendez_vous}}" required="required"  disabled>
                      </div>
                       <label for="lieu">Lieu du rendez-vous</label>

                             <div class="input-group" style="background: white;">
               
                        <input id="lieu" class="form-control" name="lieu" type="text" id="meeting-time" value="{{$visiteur->lieuRendez_vous}}" required="required" disabled >
                      </div>
   </div> 
   <div class="col-md-6">
     <div class="form-group">
                        <label for="titre">Nom Visiteur</label>
                         <div class="input-group" style="background: white;">
                 
                        <input id="titre" class="form-control" name="titre" type="text" required="required"  style="background: white;" value="{{$visiteur->nomvisiteur}}" disabled>
                      </div>
                         </div>
                          <div class="form-group">
                        <label for="motif">Organisme</label>
                        <input type="" name="motif" id="motif" class="form-control"  required="required" value="{{$visiteur->entreprisevisiteur}}" style="background: white;" disabled>
                        
                      </div>

                    <label for="date_rendez_vous">Téléphone</label>

                             <div class="input-group" style="background: white;">
               
                        <input id="date_rendez_vous" class="form-control" name="date_rendez_vous" type="" id="meeting-time" value="{{$visiteur->telephonevisiteur}}"  required="required" disabled >
                      </div>
                       <label for="lieu">Email</label>

                             <div class="input-group" style="background: white;">
               
                        <input id="lieu" class="form-control" name="lieu" type="text" id="meeting-time" placeholder="Lieu du rendez-vous" required="required" value="{{$visiteur->emailvisiteur}}" disabled>
                      </div>
   </div> 
                      
</div>
                
                

                                  
                                <br>
                                @if($visiteur->statut=="Attente")
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Valider</button>
                                    @endif
      @endforeach

                                
                                 </form>
            </div>
          </div>
          </div>
          </div>
         
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->

@stop
