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
               <div class="card-header bg-primary tx-white">Details Activité</div>   
          
          <ol class="breadcrumb">
            

               <div class="col-sm-6 col-md-3">
              
                <a style="text-decoration:none" href="/Liste-activités"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->

               <div class="col-sm-6 col-md-3">
              
                <a style="text-decoration:none" href="/Liste-activités"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-table"></i> Activités</button></a>
                
              </div><!-- col-sm -->
             
                        
          </ol>
        </div>
      



        

      <div class="row">
        
        
        <div class="col-md-10" style="margin-left: 10%;">
        
                    <div class="panel panel-default">                               
                        <div class="panel-heading">
                            <h2  style="font-size:20pt;"><i class="fa fa-edit"></i><strong>Details Activité</strong></h2>
                        </div>
                        <div class="panel-body">
                          @foreach ($activite as $activites)
                          <form action="{{ route ('Activite.update', $activites->id)}}" method="post" enctype="multipart/form-data" class="form-vertical hover-stripped" role="form">
                       {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input disabled type="hidden" name="modif" value="1">

                        

                        <div class="form-group">
                             <label for="direction-w1"> <b> Libelle</b> </label>
                          <input disabled name="libelle" type="text" class="form-control" id="daterange" value="{{$activites->libelle}}" required>
                        </div>  

                          <div class="form-group">
                             <label for="direction-w1"><b> Indicateur</b></label>
                          <input disabled name="indicateur" type="text" value="{{$activites->indicateur}}" class="form-control">
                        </div> 

                         

                        <div class="form-group">
                          
                            <div class="col-md-8"> 
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
                            <div class="col-md-4">
                              <label for="direction-w1"><b>Niveau avancement en %</b></label>
                                <input disabled name="niveau" type="number" class="form-control" placeholder="Niveau avancement" value="{{$activites->niveau}}">
                            </div>
                        </div>

                        <!-- <div class="row">
                          
                            <div class="col-md-8"> 
                            <label for="direction-w1">Date Prévue</label>
                          <input disabled name="date_prevue" type="date" class="form-control" value="{{$activites->date_prevue}}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="direction-w1">Date Révue</label>
                          <input disabled name="date_revue" type="date" value="{{$activites->date_revue}}" class="form-control">
                            </div>
                        </div> -->

                          <div class="row">
                          
                            <div class="col-md-6"> 
                            <label for="direction-w1"><b>Début</b></label>
                          <input disabled name="date_debut" type="date" class="form-control" value="{{$activites->date_debut}}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="direction-w1"><b>Fin</b></label>
                          <input disabled name="date_fin" type="date" value="{{$activites->date_fin}}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                           <?php $reportings=getAllReportings($activites->id) ?> 
                         @if($reportings->count()>0)
                         <div class="form-group">
                          <br>
                         <p><b>Historique des dates reportées</b></p>
                         <table class="table table-striped table-bordered">
                          <thead>
                  <tr style="background: #ff5454;color: white;">
                    <th>N°</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Actions</th>
                  </tr>
                </thead>   
                <tbody>
                  <?php $n=0; ?> 
                 @foreach ($reportings as $reporting)
                 <?php $n++; ?>            
                <tr>
                  <td>{{$n}} </td>
                  <td>{{(new DateTime($reporting->date_debut))->format("d/m/Y")}}</td>
                  <td>{{(new DateTime($reporting->date_fin))->format("d/m/Y")}}</td>
                    <td>
                   @if((Auth::user()->user_role==5)||(Auth::user()->user_role==1)||(Auth::user()->user_role==2)||(Auth::user()->user_role==8))
                   
                    <a class="btn btn-info" href="{{ route ('Reporting.edit', $reporting->id)}}" title="Modifier" data-rel="tooltip">
                      <i class="fa fa-edit "></i>                                            
                    </a>
                  
                   
                    @endif
                    
                  </td>
                </tr>
                @endforeach
                
                </tbody>
              </table> 
            </div>
                         @endif
                        </div>

                         <div class="row">
                          
                            <div class="col-md-4"> 
                            <label for="direction-w1"><b>Finacement prevu</b></label>
                        <input disabled name="finan_prev" type="text" class="form-control" value="{{$activites->finan_prev}}">
                            </div>
                            <div class="col-md-4">
                                <label for="direction-w1"><b>Etat du financement</b></label>
                          <input disabled name="etat_finan" type="text" class="form-control" value="{{$activites->etat_finan}}">
                            </div>
                             <div class="col-md-4">
                                <label for="direction-w1"><b>Budget</b></label>
                          <input disabled name="budget" type="text" class="form-control" value="{{$activites->budget}}">
                            </div>
                            <br><br>
                        </div>

                      <?php $sousactivites=getAllSousActivites($activites->id) ?> 
                         @if($sousactivites->count()>0)
                         <div class="form-group">
                          <br>
                         <p><b>Liste des sous-activités</b></p>
                         <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                  <tr style="background: #0b0e69;color: white;">
                    <th>Activités</th>
                    <th>Statuts</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Actions</th>
                  </tr>
                </thead>   
                <tbody>
                 @foreach ($sousactivites as $sousactivite)            
                <tr>
                 
                  <td>{{$sousactivite->libelle}}</td>
                  <td>
                    @if($sousactivite->statut==0)
                    <span class="label label-default">Non démarré</span>
                    @elseif($sousactivite->statut==2) 
                    <span class="label label-primary">Terminé</span>
                    @elseif($sousactivite->statut==3) 
                    <span class="label label-warning">Retardé</span>
                    @elseif($sousactivite->statut==4) 
                    <span class="label label-danger">Annulé</span>
                    @else
                    <span class="label label-success">En Cours</span>
                    @endif

                    @if($sousactivite->niveau==0)
                       <div class="progress" title="0%" data-rel="tooltip">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                          0%
                        </div>
                      </div>
                    @elseif($sousactivite->niveau==100) 
                     <div class="progress" title="100%" data-rel="tooltip">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                          100%
                        </div>
                      </div>
                    @else
                     <div class="progress" title="{{$sousactivite->niveau}}%" data-rel="tooltip">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$sousactivite->niveau}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$sousactivite->niveau}}%;">
                          {{$sousactivite->niveau}}%
                        </div>
                      </div>
                    @endif
                 
                  </td>
                  <td>{{(new DateTime($sousactivite->date_debut))->format("d/m/Y")}}</td>
                  <td>{{(new DateTime($sousactivite->date_fin))->format("d/m/Y")}}</td>
                
                 
                  <td>
                   @if((Auth::user()->user_role==5)||(Auth::user()->user_role==1)||(Auth::user()->user_role==2)||(Auth::user()->user_role==8))
                   
                    <a class="btn btn-info" href="{{ route ('Sousactivite.edit', $sousactivite->id)}}" title="Modifier" data-rel="tooltip">
                      <i class="fa fa-edit "></i>                                            
                    </a>
                  
                   
                    @endif
                    
                  </td>
                </tr>
                @endforeach
                
                </tbody>
              </table> 
            </div>
                         @endif


                           

                <div class="form-group">
                  <label class="control-label" for="textarea2"><b>Commentaire</b></label>
                  <div class="controls">
                  <textarea disabled name="commentaire"  class="form-control" rows="6" style="width:100%">
                  {{$activites->commentaire}}
                  </textarea>
                  </div>
                </div>

                 <div class="form-group">
                  <label class="control-label" for="textarea2"><b>Resultat Attendu</b></label>
                  <div class="controls">
                  <textarea disabled name="resultat_attendu"  class="form-control" rows="6" style="width:100%">
                  {{$activites->resultat_attendu}}
                  </textarea>
                  </div>
                </div>
                              
                              
                       
                              <div class="form-group pull-left">
                                    <a href="/Liste-activités" class="btn btn-primary">Retour</a>
                                </div>  

                                 @if((Auth::user()->user_role==5)||(Auth::user()->user_role==1)||(Auth::user()->user_role==2)||(Auth::user()->user_role==8))
                                <div class="form-group pull-right">
                                    <a href="{{ route ('editActivite', $activites->id)}}" class="btn btn-warning">Modifier</a>
                                </div>  
                                @endif      
                                
                                        
                            </form>
                            @endforeach
                        </div>
                    </div>
          
        </div><!--/.col-->
      
      </div><!--/.row profile--> 
      </div> 


   
         @stop