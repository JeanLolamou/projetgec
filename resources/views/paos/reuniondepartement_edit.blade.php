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
               <div class="card-header bg-primary tx-white"> <i class="fa fa-edit"></i> Modification Reunion</div>

          <ol class="breadcrumb">
            <div class="col-sm-6 col-md-3">
              
                <a style="text-decoration:none" href="/Liste-activités"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->
              <div class="col-sm-6 col-md-3">
              
                <a style="text-decoration:none" href="/Liste-reuniondepartements"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="icon ion-clipboard"></i> Reunion</button></a>
                
              </div><!-- col-sm -->
           
           <!--  <li><i class="fa fa-edit"></i>Modification</li>     -->          
          </ol>
        



        

      <div class="row">
        
        
        <div class="col-md-10" style="margin-left: 10%;">
        
                    <div class="panel panel-default">                               
                        <div class="panel-heading">
                            <h2><i class="fa fa-edit"></i><strong>Modification Reunion</strong></h2>
                        </div>
                        <div class="panel-body">
                          @foreach ($reuniondepartement as $reuniondepartements)
                          <form action="{{ route ('reuniondepartementupdate', $reuniondepartements->id)}}" method="post" enctype="multipart/form-data" class="form-vertical hover-stripped" role="form">
                       {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="modif" value="1">

                      
                        <div class="form-group">
                             <label for="direction-w1">Libelle</label>
                          <input name="libelle" type="text" class="form-control" id="daterange" value="{{$reuniondepartements->libelle}}" required>
                        </div>  

                        <div class="form-group">
                         <label for="direction-w1">Date</label>
                                  <input name="date" type="date" class="form-control" value="{{$reuniondepartements->date}}" required>
                        </div>

                          <div class="form-group">
                            <label for="textarea-input">Debut séance</label>
                            <div class="">
                               <input type="time" name="debut_seance" class="form-control" value="{{$reuniondepartements->debut_seance}}" required>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="textarea-input">Levée séance</label>
                            <div class="">
                               <input type="time" name="leve_seance" class="form-control" value="{{$reuniondepartements->leve_seance}}" required>
                            </div>
                        </div>
                              
                              
                       
                              <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </div>          
                                
                                        
                            </form>
                            @endforeach
                        </div>
                    </div>
          
        </div><!--/.col-->
      
      </div><!--/.row profile-->  
</div>

   
         @stop