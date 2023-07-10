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
               <div class="card-header bg-primary tx-white"><i class="fa fa-edit"></i> Modification Activité</div>   
          
          <ol class="breadcrumb">
            <div class="col-sm-6 col-md-3">
              
                <a style="text-decoration:none" href="/Liste-activités"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->
            <div class="col-sm-6 col-md-3">
              
                <a style="text-decoration:none" href="/Liste-activités"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-table"></i> Activités</button></a>
                
              </div><!-- col-sm -->
            <!-- <li><i class="fa fa-edit"></i>Modification</li>   --> 
                        
          </ol>
        </div>




        

      <div class="row">
        
        
        <div class="col-md-10" style="margin-left: 10%;">
        
                    <div class="panel panel-default">                               
                        <div class="panel-heading">
                            <h2 style="font-size:20pt;"><i class="fa fa-edit"></i> <strong>Modification Activité</strong></h2>
                        </div>
                        <div class="panel-body">
                          @foreach ($activite as $activites)
                          <form action="{{ route ('activiteupdate', $activites->id)}}" method="post" enctype="multipart/form-data" class="form-vertical hover-stripped" role="form">
                       {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="modif" value="1">

                         

                        <div class="form-group">
                             <label for="direction-w1"><b>Libelle</b></label>
                          <input name="libelle" type="text" class="form-control" id="daterange" value="{{$activites->libelle}}" required>
                        </div>  

                          <div class="form-group">
                             <label for="direction-w1"><b>Indicateur</b></label>
                          <input name="indicateur" type="text" value="{{$activites->indicateur}}" class="form-control">
                        </div> 

                         

                        <div class="row">
                          
                            <div class="col-md-6"> 
                            <label for="direction-w1"><b>Statut</b></label> 
                          <select class="form-control" name="statut">
                            <option value="{{$activites->statut}}">
                              @if($activites->statut==0)
                               Non démarré
                              @elseif($activites->statut==2) 
                              Terminé
                              @elseif($activites->statut==3) 
                              Retardé
                              @elseif($activites->statut==4) 
                              Annulé
                              @else
                             En Cours
                              @endif
                            </option>
                            <option value="0" >Non démarré</option>
                            <option value="1" >En Cours</option>
                            <option value="2" >Terminé</option>
                            <option value="3" >Retardé</option>
                            <option value="4" >Annulé</option>
                          </select>
                            </div>
                            <div class="col-md-6">
                              <label for="direction-w1"><b>Niveau avancement en %</b></label>
                                @if($activites->sousactivite==1)
                                <input class="form-control" placeholder="Niveau avancement" value="{{getNiveauActivite($activites->id)}}" disabled>
                                <p style="font-size: 10px;color: red;">Modification possible qu'avec les sous-activités!</p>
                                <input type="hidden" name="niveau" value="{{getNiveauActivite($activites->id)}}">
                                @else
                                <input name="niveau" type="number" class="form-control" placeholder="Niveau avancement" value="{{$activites->niveau}}">
                                @endif
                            </div>
                        </div>

                       <!--   <div class="row">
                          
                            <div class="col-md-8"> 
                            <label for="direction-w1">Date Prévue</label>
                          <input name="date_prevue" type="date" class="form-control" value="{{$activites->date_prevue}}">
                            </div>
                            <div class="col-md-4">
                                <label for="direction-w1">Date Révue</label>
                          <input name="date_revue" type="date" value="{{$activites->date_revue}}" class="form-control">
                            </div>
                        </div> -->

                        <div class="row">
                          
                            <div class="col-md-6"> 
                            <label for="direction-w1"><b>Début</b></label>
                          <input name="date_debut" type="date" class="form-control" value="{{$activites->date_debut}}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="direction-w1"><b>Fin</b></label>
                          <input name="date_fin" type="date" value="{{$activites->date_fin}}" class="form-control">
                            </div>
                        </div>

                         


                           <div class="row">
                          
                            <div class="col-md-4"> 
                            <label for="direction-w1"><b>Finacement prevu</b></label>
                        <input name="finan_prev" type="text" class="form-control" value="{{$activites->finan_prev}}">
                            </div>
                            <div class="col-md-4">
                                <label for="direction-w1"><b>Etat du financement</b></label>
                          <input name="etat_finan" type="text" class="form-control" value="{{$activites->etat_finan}}">
                            </div>
                              <div class="col-md-4">
                                <label for="direction-w1"><b>Budget</b></label>
                          <input name="budget" type="text" class="form-control" value="{{$activites->budget}}">
                            </div>
                        </div>

                          
                           <div class="form-group">
                  <label class="control-label" for="textarea2"><b>Résultat attendu</b></label>
                  <div class="controls">
                  <textarea name="resultat_attendu"  class="form-control" rows="6" style="width:100%">
                  {{$activites->resultat_attendu}}
                  </textarea>
                  </div>
                </div> 

                <div class="form-group">
                  <label class="control-label" for="textarea2"><b>Commentaire</b></label>
                  <div class="controls">
                  <textarea name="commentaire"  class="form-control" rows="6" style="width:100%">
                  {{$activites->commentaire}}
                  </textarea>
                  </div>
                </div>
                              
                              
                       
                              <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                      <a class="btn btn-warning" href="{{ route ('ajoutSousActivite', $activites->id)}}" title="Sous Activite" data-rel="tooltip">
                                        <i class="fa fa-code-fork"></i>Ajout 
                                      Sous-Activité</a>
                                     <a style="color: white;" class="btn btn-danger" data-toggle="modal"  data-target="#myModal">
                                      <i class="fa fa-calendar"></i> 
                                      Reporter
                                      </a>
                                </div>          
                                
                                        
                            </form>

                            <div class="modal fade" id="myModal">
    <div class="modal-dialog">
       <form method="POST" action="{{ route ('Reporting.store')}}" enctype="multipart/form-data">
                        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Report de l'Activité [<span style="color: red;">{{$activites->libelle}}</span>]</h4>
        </div>
        <div class="modal-body">
            
            <input type="hidden" name="activite" value="{{$activites->id}}">

                <div class="row">
                          
                            <div class="col-md-6"> 
                            <label for="direction-w1">Date Début</label>
                          <input name="date_debut" type="date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="direction-w1">Date Fin</label>
                          <input name="date_fin" type="date" class="form-control">
                            </div>
                        </div>
        </div>
        <div class="modal-footer">
         
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button  class="btn btn-primary" type=" button submit"><i class="fa fa-calendar"></i> Reporter</button>
          
          
        </div>
      </div><!-- /.modal-content -->
      </form>
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
                            <!-- fin modal -->       
                            @endforeach
                        </div>
                    </div>
          
        </div><!--/.col-->
      
      </div><!--/.row profile-->  

</div>
   
         @stop