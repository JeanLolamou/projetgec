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
               <div class="card-header bg-primary tx-white"><i class="fa fa-edit"></i> Modification Rapport Hebdomadaire</div>


          <ol class="breadcrumb">
             <div class="col-sm-6 col-md-3">
              
                <a style="text-decoration:none" href="/dashboard"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->
             <div class="col-sm-6 col-md-3 ">
              
                <a style="text-decoration:none" href="/Liste-rapports"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Rapports</button></a>
                
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
                          @foreach ($rapport as $rapports)
                          <form action="{{ route ('rapportupdate', $rapports->id)}}" method="post" enctype="multipart/form-data" class="form-vertical hover-stripped" role="form">
                       {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input  type="hidden" name="modif" value="1">



                        <div class="row">
                         <!--  <div class="col-lg-6">

                        <div class="form-group">
                            <label for="textarea-input">Responsable</label>
                            <input type="text" name="responsable" class="form-control" value="{{$rapports->responsable}}">
                        </div> </div> -->
                        <div class="col-lg-6">
                            <label class="control-label" for="input-small"><b>Titre du Rapport Hebdomadaire</b></label>
                           <input type="text" id="input-small" name="activite_pao" class="form-control input-sm" value="{{$rapports->activite_pao}}">
                                
                            
                        </div>

                          <div class="col-lg-6">
                          
                            <label for="direction-w1"><b> Date de Réalisation</b> </label>
                          <input name="date" type="date" class="form-control" value="{{$rapports->date}}" required>
                          
                        </div>
                      </div>

                        
                           
<br>
                <div class="form-group">
                  <label class="control-label" for="textarea2"><b>Principales Activités réalisées cette semaine</b> </label>
                  <div class="controls">
                <textarea  name="rapport" id="summary-ckeditor" class="form-control" rows="6" style="width:100%">
                  {{$rapports->rapport}}
                  </textarea>
                  </div>
                </div>
<br>
                <div class="form-group">
                  <label class="control-label" for="textarea2"><b>Principales Activités prévues la semaine prochaine</b></label>
                  <div class="controls">
                <textarea  name="rapport" id="summary-ckeditor1" class="form-control" rows="6" style="width:100%">
                  {{$rapports->rapportplan}}
                  </textarea>
                  </div>
                </div>

<div class="row">

                           <div class="col-lg-6">
                 <div class="form-group">
                  <label class="control-label" for="textarea2"><b>Principaux défis/risques</b></label>
                  <div class="controls">
                <textarea  name="defis" id="summary-ckeditor2" class="form-control" rows="6" style="width:100%">
                  {{$rapports->defis}}
                  </textarea>
                  </div>
                </div></div>

<div class="col-lg-6">
                 <div class="form-group">
                  <label class="control-label" for="textarea2"><b>Démarche de mitigation</b></label>
                  <div class="controls">
                <textarea  name="demarche" id="summary-ckeditor3" class="form-control" rows="6" style="width:100%">
                  {{$rapports->demarche}}
                  </textarea>
                  </div>
                </div></div></div>

                 <div class="form-group">
                  <label class="control-label" for="textarea2"><b>Décisions clés requises</b></label>
                  <div class="controls">
                <textarea  name="decision" id="summary-ckeditor4" class="form-control" rows="6" style="width:100%">
                  {{$rapports->decision}}
                  </textarea>
                  </div>
                </div>

                <!--  <div class="form-group">
                            <label for="direction-w1">Delai</label>
                          <input name="delai" type="date" class="form-control" value="{{$rapports->delai}}">
                          
                        </div>

                        <div class="form-group">
                          
                            <div class="col-md-8"> 
                            <label class="control-label" for="select">Lien</label>
                            
                        <select id="select" name="lien" class="form-control" size="1">
                          <option value="{{$rapports->lien}}">{{$rapports->lien}}</option>
                          <option value="Non">Non</option>
                           <option value="Oui">Oui</option>
                        </select>
                            </div>
                            <div class="col-md-4">
                              <label for="direction-w1">Taux de réalisation en %</label>
                                <input name="niveau" type="number" class="form-control" placeholder="" required="" value="{{$rapports->niveau}}">
                            </div>
                        </div>

                          <div class="form-group">
                            <label class="control-label" for="input-small">Activité PAO 20</label>
                           <input type="text" id="input-small" name="activite_pao" class="form-control input-sm" value="{{$rapports->activite_pao}}">
                                
                            
                        </div> -->

                           
                              
                              
                       
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