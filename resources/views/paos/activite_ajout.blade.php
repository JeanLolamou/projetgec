@extends('pages.Default')
@section('content')

        @if(session()->has('message'))
      <div class="row">
     <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Succés!</strong> {{session()->get('message')}}.
              </div>
              </div>
              @endif 
              <div class="sh-pagebody">
               <div class="card-header bg-primary tx-white">Ajouter PAO</div>  

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



        

      <div class="row">
        
        
        <div class="col-md-12" style="">
        
                    <div class="panel panel-default">                               
                        <div class="panel-heading">

                        
                            <h2 style="font-size:20pt;"><i class="fa fa-edit red"></i><strong>Ajout Activité</strong></h2>
                        </div>
                        <div class="panel-body">
                          <form method="POST" action="ajoutactivite" enctype="multipart/form-data">
                        @csrf

                         <!-- <div class="form-group">
                             <label for="direction-w1">Direction</label>
                          <select class="form-control" name="direction">
                            @foreach ($direction as $directions)
                           
                            <option value="{{$directions->nom}}" >{{$directions->nom}}</option>
                           
                            @endforeach
                          </select>
                        </div> -->
<div class="card"><div class="card-body">  <div class="form-group">
                        <div class="row">

                            <div class="col-lg-6">
                             <label for="direction-w1"><b> Libelle </b></label>
                          <input name="libelle" type="text" class="form-control" id="daterange" value="" required>
                        </div>  

                          <div class="col-lg-6">
                             <label for="direction-w1"><b> Indicateur </b></label>
                          <input name="indicateur" type="text" class="form-control">
                        </div>  </div>  </div> 

                         
<div class="form-group">
                         <div class="row">
                          
                            <div class="col-md-3"> 
                            <label for="direction-w1"><b> Statut </b></label> 
                          <select class="form-control" name="statut">
                            <option value="0" >Non démarré</option>
                            <option value="1" >En Cours</option>
                            <option value="2" >Terminé</option>
                            <option value="3" >Retardé</option>
                            <option value="4" >Annulé</option>


                          </select>
                            </div>
                            <div class="col-md-3">
                              <label for="direction-w1"><b> Niveau avancement en % </b></label>
                                <input name="niveau" type="number" class="form-control" placeholder="Niveau avancement" required="" value="0">
                            </div>
                            <div class="col-md-3"> 
                            <label for="direction-w1"><b>Début </b></label>
                          <input name="date_debut" type="date" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="direction-w1"><b>Fin</b></label>
                          <input name="date_fin" type="date" class="form-control">
                            </div>
                        </div> </div>

                          <div class="form-group">
                          <div class="row">
                            <div class="col-md-4"> 
                            <label for="direction-w1"><b>Financement prevu</b></label>
                        <input name="finan_prev" type="text" class="form-control" >
                            </div>
                            <div class="col-md-4">
                                <label for="direction-w1"><b>Etat du financement</b></label>
                          <input name="etat_finan" type="text" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="direction-w1"><b>Budget</b></label>
                          <input name="budget" type="text" class="form-control">
                            </div>
                        </div>
                        </div>

                          
                   <div class="form-group">
                         <div class="row">
                          
                            <div class="col-md-6"> 
                  <label class="control-label" for="textarea2"><b>Résultat attendu</b></label>
                  <div class="controls">
                  <textarea name="resultat_attendu"  class="form-control" rows="4" style="width:100%" placeholder=""></textarea>
                  </div>
                </div>      

                <div class="col-md-6"> 
                  <label class="control-label" for="textarea2"><b>Commentaire</b></label>
                  <div class="controls">
                  <textarea name="commentaire" class="form-control" rows="4" style="width:100%"></textarea>
                  </div>
                </div></div></div>
                              
                              
                       
                              <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </div>          
                                </div> </div>

                     
                                        
                            </form>
                             
                        </div>
                    </div>
          
        </div><!--/.col-->


        
      
      </div><!--/.row profile-->  
</div>


   
         @stop