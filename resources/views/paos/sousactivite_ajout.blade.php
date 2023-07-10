@extends('pages.Default')
@section('content')

        @if(session()->has('message'))
      <div class="row">
     <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Succès!</strong> {{session()->get('message')}}.
              </div>
              </div>
              @endif 
<div class="sh-pagebody">
               <div class="card-header bg-primary tx-white">Ajouter Sous-Activité</div>  

 <div class="row">
        <div class="col-lg-12">
         
          <ol class="breadcrumb">
            <div class="col-sm-6 col-md-3">
              
                <a style="text-decoration:none" href="Liste-activités"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->

               <div class="col-sm-6 col-md-3">
              
                <a style="text-decoration:none" href="/Liste-activités"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-table"></i> Activités</button></a>
                
              </div><!-- col-sm -->
                      
          </ol>
        </div>
      </div>


                 

<!--  <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-plus"></i> Ajout Sous-Activité</h3>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{route('home')}}">Accueil</a></li>
            <li><i class="fa fa-building-o"></i><a href="#">Sous-Activités</a></li>   
            <li><i class="fa fa-plus"></i>Ajout</li>              
          </ol>
        </div>
      </div> -->



        

      <div class="row">
        
        
        <div class="col-md-8" style="">
        
                    <div class="panel panel-default">                               
                        <div class="panel-heading">
                            <h2><i class="fa fa-edit red"></i><strong>Ajout Sous-Activité</strong></h2>
                        </div>
                        <div class="panel-body">
                          <form method="POST" action="{{ route ('Sousactivite.store')}}" enctype="multipart/form-data">
                        @csrf

                         <div class="form-group">
                             <label for="direction-w1">Activités</label>
                          <select class="form-control" name="activite">
                            @foreach ($activites as $activites)
                            <option value="{{$activites->id}}" >{{$activites->libelle}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="form-group">
                             <label for="direction-w1">Libelle Sous-activité</label>
                          <input name="libelle" type="text" class="form-control" id="daterange" value="" required>
                        </div>  

                         

                         

                         <div class="form-group"> 
                          <div class="row">
                          
                            <div class="col-md-8"> 
                            <label for="direction-w1">Statut</label> 
                          <select class="form-control" name="statut">
                            <option value="0" >Non démarré</option>
                            <option value="1" >En Cours</option>
                            <option value="2" >Terminé</option>
                            <option value="3" >Retardé</option>
                            <option value="4" >Annulé</option>


                          </select>
                            </div>
                            <div class="col-md-4">
                              <label for="direction-w1">Niveau avancement en %</label>
                                <input name="niveau" type="number" class="form-control" placeholder="Niveau avancement" required="" value="0">
                            </div>
                        </div>
                        </div>

                          <div class="form-group">
                           <div class="row">
                            <div class="col-md-8"> 
                            <label for="direction-w1">Début</label>
                          <input name="date_debut" type="date" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="direction-w1">Fin</label>
                          <input name="date_fin" type="date" class="form-control">
                            </div>
                        </div>
                        </div>

                        

                          
                     
    
                              
                              
                       
                              <div class="form-group pull-right">

                                <br>
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                    <a class="btn btn-warning" title="Revenir sur l'activite" href="{{ route ('editActivite', $activites->id)}}">Retour</a>
                                </div>          
                                
                                        
                            </form>
                        </div>
                    </div>
          
        </div><!--/.col-->


       <!--   <div class="col-md-4">
        
                    <div class="panel panel-default">                               
                        <div class="panel-heading">
                            <h2><i class="fa fa-edit red"></i><strong>Import Activité</strong></h2>
                        </div>
                        <div class="panel-body">
                          
                        </div>
                    </div>
          
        </div>
       -->
      </div><!--/.row profile-->  


   
         @stop