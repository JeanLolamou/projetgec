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
               <div class="card-header bg-primary tx-white"><i class="fa fa-search-plus"></i> Details Du Rapport Hebdomadaire</div>

 
          <ol class="breadcrumb">
            <div class="col-sm-6 col-md-3">
              
                <a style="text-decoration:none" href="/dashboard"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->
           <div class="col-sm-6 col-md-3 ">
              
                <a style="text-decoration:none" href="/Liste-rapports"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Rapports</button></a>
                
              </div><!-- col-sm -->  
            <!-- <li><i class="fa fa-search-plus"></i>Details</li> -->              
          </ol>
        </div>
      



        

      <div class="row">
        
        
        <div class="col-md-10" style="margin-left: 10%;">
        
                    <div class="panel panel-default">                               
                        <div class="panel-heading">
                            <h2 style="font-size:20pt;"><i class="fa fa-edit"></i> <strong>Details</strong></h2>
                        </div>
                        <div class="panel-body">
                          @foreach ($rapport as $rapports)
                          <form action="{{ route ('rapportupdate', $rapports->id)}}" method="post" enctype="multipart/form-data" class="form-vertical hover-stripped" role="form">
                       {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input disabled type="hidden" name="modif" value="1">

                         <div class="form-group">
                        <div class="row">

                           <div class="col-lg-6">
                         
                            <label for="textarea-input"><strong> Titre du Rapport Hebdomadaire</strong> </label>
                            <input type="text" name="activite_pao" class="form-control" value="{{$rapports->activite_pao}}" disabled>
                        </div>

                         <div class="col-lg-3">
                         
                            <label for="textarea-input"><strong> Mois</strong> </label>
                            <input type="text" name="mois" class="form-control" value="{{$rapports->mois}}" disabled>
                        </div>

                         <div class="col-lg-3">
                         
                            <label for="textarea-input"><strong> Semaine</strong> </label>
                            <input type="text" name="semaine" class="form-control" value="{{$rapports->semaine}}" disabled>
                        </div>

                         </div> 
                        </div> 

                        <div class="row">

                           <div class="col-lg-6">
                          <div class="form-group">
                            <label for="textarea-input"><strong> Responsable</strong> </label>
                            <input type="text" name="responsable" class="form-control" value="{{$rapports->responsable}}" disabled>
                        </div> </div> 

                           <div class="col-lg-6">
                          <div class="form-group">
                            <label for="direction-w1"><strong> Date de Réalisation</strong></label>
                          <input disabled name="date" type="date" class="form-control" value="{{$rapports->date}}" required>
                          
                        </div></div> 
                        </div> 


                 <!-- <div class="form-group">
                            <label for="direction-w1">Delai</label>
                          <input name="delai" type="date" class="form-control" value="{{$rapports->delai}}" disabled>
                          
                        </div>    -->
                        
                           

                <div class="form-group">
                  <label class="control-label" for="textarea2"><strong><u>Principales Activités réalisées cette semaine</u></strong></label>
                  <p>
                    <blockquote>{!!$rapports->rapport!!}</blockquote>
                  </p>
                </div>
                <br><br>

                <div class="form-group">
                  <label class="control-label" for="textarea2"><strong><u>Principales Activités prévues la semaine prochaine</u></strong> </label>
                  <p>
                    <blockquote>{!!$rapports->rapportplan!!}</blockquote>
                  </p>
                </div>
                  <br>
<div class="row">

                           <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label" for="textarea2"><strong><u>Principaux défis/risques</u></strong> </label>
                  <p>
                    <blockquote>{!!$rapports->defis!!}</blockquote>
                  </p>
                </div></div>

                  <div class="col-lg-6">
                  <div class="form-group">
                  <label class="control-label" for="textarea2"><strong><u>Démarche de mitigation</u></strong> </label>
                  <p>
                    <blockquote>{!!$rapports->demarche!!}</blockquote>
                  </p>
                </div></div>
                </div>
                <br>


                 <div class="form-group">
                  <label class="control-label" for="textarea2"><strong><u>Décisions clés requises</u></strong> </label>
                  <p>
                    <blockquote>{!!$rapports->decision!!}</blockquote>
                  </p>
                </div>
                <br>

               <!--  <div class="form-group">
                          
                            <div class="col-md-8"> 
                            <label class="control-label" for="select">Lien</label>
                              <input disabled name="lien" type="text" class="form-control" value="{{$rapports->lien}}">
                            
                      
                            </div>
                            <div class="col-md-4">
                              <label for="direction-w1">Taux de réalisation en %</label>
                                <input disabled name="niveau" type="number" class="form-control" placeholder="" required="" value="{{$rapports->niveau}}">
                            </div>
                        </div>

                   <div class="form-group">
                  <label class="control-label" for="textarea2">Activité PAO 20</label>
                  <p>
                    <blockquote>{!!$rapports->activite_pao!!}</blockquote>
                  </p>
                </div> -->
                
                

                              
                              
                       
                              <div class="form-group pull-left">
                                    <a href="{{route('rapport')}}" class="btn btn-primary">Retour</a>
                                </div>  
                                <div class="form-group pull-right">
                                    <a href="{{ route ('editRapport', $rapports->id)}}" class="btn btn-warning">Modifier</a>
                                </div>        
                                
                                        
                            </form>
                            @endforeach
                        </div>
                    </div>
          
        </div><!--/.col-->
      
      </div><!--/.row profile-->  


   
         @stop