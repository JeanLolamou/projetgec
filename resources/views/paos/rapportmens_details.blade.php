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
               <div class="card-header bg-primary tx-white"><i class="fa fa-search-plus"></i> Details Rapport Mensuel</div>

 
          <ol class="breadcrumb">
            <div class="col-sm-6 col-md-3">
              
                <a style="text-decoration:none" href="/dashboard"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->
           <div class="col-sm-6 col-md-3 ">
              
                <a style="text-decoration:none" href="/Liste-rapportmens"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Rapports Mensuels</button></a>
                
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
                          @foreach ($rapportmen as $rapportmens)
                          <form action="{{ route ('rapportupdatemen', $rapportmens->id)}}" method="post" enctype="multipart/form-data" class="form-vertical hover-stripped" role="form">
                       {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input disabled type="hidden" name="modif" value="1">

                        <div class="row">

                           <div class="col-lg-6">
                          <div class="form-group">
                            <label for="textarea-input"><strong> Titre du Rapport Mensuel</strong> </label>
                            <input type="text" name="activite_pao" class="form-control" value="{{$rapportmens->activite_pao}}" disabled>
                        </div> </div> 

                         <div class="col-lg-6">
                          <div class="form-group">
                            <label for="textarea-input"><strong> Mois</strong> </label>
                            <input type="text" name="mois" class="form-control" value="{{$rapportmens->mois}}" disabled>
                        </div> </div> 
                        </div> 

                        <div class="row">

                           <div class="col-lg-6">
                          <div class="form-group">
                            <label for="textarea-input"><strong> Responsable</strong> </label>
                            <input type="text" name="responsable" class="form-control" value="{{$rapportmens->responsable}}" disabled>
                        </div> </div> 

                           <div class="col-lg-6">
                          <div class="form-group">
                            <label for="direction-w1"><strong> Date de Réalisation</strong></label>
                          <input disabled name="date" type="date" class="form-control" value="{{$rapportmens->date}}" required>
                          
                        </div></div> 
                        </div> 


                
                        
                           

                <div class="form-group">
                  <label class="control-label" for="textarea2"><strong><u> Activités Mensuelles Réalisées</u></strong></label>
                  <p>
                    <blockquote>{!!$rapportmens->rapport!!}</blockquote>
                  </p>
                </div>
                <br>

                <div class="form-group">
                  <label class="control-label" for="textarea2"><strong><u>Priorités pour le mois prochain</u></strong> </label>
                  <p>
                    <blockquote>{!!$rapportmens->rapportplan!!}</blockquote>
                  </p>
                </div>
                <br>

                <div class="form-group">
                  <label class="control-label" for="textarea2"><strong><u>Qu'est-ce qui va bien?</u></strong> </label>
                  <p>
                    <blockquote>{!!$rapportmens->positif!!}</blockquote>
                  </p>
                </div>
                <br>
<div class="row">

                           <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label" for="textarea2"><strong><u>Quels sont les principaux défis?</u></strong> </label>
                  <p>
                    <blockquote>{!!$rapportmens->defis!!}</blockquote>
                  </p>
                </div> </div>

<div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label" for="textarea2"><strong><u>Que faire pour relever ces défis?</u></strong> </label>
                  <p>
                    <blockquote>{!!$rapportmens->solution!!}</blockquote>
                  </p>
                </div></div></div>
<br>
              
                
                

                              
                              
                       
                              <div class="form-group pull-left">
                                    <a href="/Liste-rapportmens" class="btn btn-primary">Retour</a>
                                </div>  
                                 @if((Auth::user()->user_role==5)||(Auth::user()->user_role==6)||(Auth::user()->user_role==3))
                                <div class="form-group pull-right">
                                    <a href="{{ route ('editRapportmen', $rapportmens->id)}}" class="btn btn-warning">Modifier</a>
                                </div>  
                                @endif      
                                
                                        
                            </form>
                            @endforeach
                        </div>
                    </div>
          
        </div><!--/.col-->
      
      </div><!--/.row profile-->  


   
         @stop