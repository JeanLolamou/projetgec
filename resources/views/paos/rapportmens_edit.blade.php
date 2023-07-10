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
               <div class="card-header bg-primary tx-white"><i class="fa fa-edit"></i> Modification Rapport Mensuel</div>


          <ol class="breadcrumb">
             <div class="col-sm-6 col-md-3">
              
                <a style="text-decoration:none" href="/dashboard"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->
             <div class="col-sm-6 col-md-3 ">
              
                <a style="text-decoration:none" href="/Liste-rapportmens"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Rapports Mensuels</button></a>
                
              </div><!-- col-sm -->
            <!-- <li><i class="fa fa-edit"></i>Modification</li>    -->           
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
                        <input  type="hidden" name="modif" value="1">



                        <div class="row">
                       
                        <div class="col-lg-6">
                            <label class="control-label" for="input-small"><b>Titre du Rapport Mensuel </b></label>
                           <input type="text" id="input-small" name="activite_pao" class="form-control input-sm" value="{{$rapportmens->activite_pao}}">
                                
                            
                        </div>

                          <div class="col-lg-6">
                          
                            <label for="direction-w1"><b> Date de Réalisation</b> </label>
                          <input name="date" type="date" class="form-control" value="{{$rapportmens->date}}" required>
                          
                        </div>
                      </div>

                        
                           
<br>
                <div class="form-group">
                  <label class="control-label" for="textarea2"><b>Activités Mensuelles réalisées</b> </label>
                  <div class="controls">
                <textarea  name="rapport" id="summary-ckeditor" class="form-control" rows="6" style="width:100%">
                  {{$rapportmens->rapport}}
                  </textarea>
                  </div>
                </div>
<br>
                <div class="form-group">
                  <label class="control-label" for="textarea2"><b> Priorités pour le mois prochain</b></label>
                  <div class="controls">
                <textarea  name="rapportplan" id="summary-ckeditor1" class="form-control" rows="6" style="width:100%">
                  {{$rapportmens->rapportplan}}
                  </textarea>
                  </div>
                </div>

                 <div class="form-group">
                  <label class="control-label" for="textarea2"><b> Qu'est-ce qui va bien?</b></label>
                  <div class="controls">
                <textarea  name="positif" id="summary-ckeditor2" class="form-control" rows="6" style="width:100%">
                  {{$rapportmens->positif}}
                  </textarea>
                  </div>
                </div>

<div class="row">

                           <div class="col-lg-6">
                 <div class="form-group">
                  <label class="control-label" for="textarea2"><b> Quels sont les principaux défis?</b></label>
                  <div class="controls">
                <textarea  name="defis" id="summary-ckeditor3" class="form-control" rows="6" style="width:100%">
                  {{$rapportmens->defis}}
                  </textarea>
                  </div>
                </div></div>

                  <div class="col-lg-6">
                 <div class="form-group">
                  <label class="control-label" for="textarea2"><b> Que faire pour relever ces défis?</b></label>
                  <div class="controls">
                <textarea  name="solution" id="summary-ckeditor4" class="form-control" rows="6" style="width:100%">
                  {{$rapportmens->solution}}
                  </textarea>
                  </div>
                </div></div></div>
                                                         
                       
                            <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </div>      
                                
                                        
                            </form>
                            @endforeach
                        </div>
                    </div>
          
        </div><!--/.col-->
      
      </div><!--/.row profile-->  

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace( 'summary-ckeditor' );
CKEDITOR.replace( 'summary-ckeditor1' );
CKEDITOR.replace( 'summary-ckeditor2' );
CKEDITOR.replace( 'summary-ckeditor3' );
CKEDITOR.replace( 'summary-ckeditor4' );
</script>
   
         @stop