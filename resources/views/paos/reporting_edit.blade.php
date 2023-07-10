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
               <div class="card-header bg-primary tx-white"><i class="fa fa-edit"></i> Modification Reporting</div>   
          
          <ol class="breadcrumb">
            <div class="col-sm-6 col-md-3">
              
                <a style="text-decoration:none" href="/Liste-activités"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i>Accueil</button></a>
                
              </div><!-- col-sm -->
            <div class="col-sm-6 col-md-3">
              
                <a style="text-decoration:none" href="/Liste-activités"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-table"></i> Activités</button></a>
                
              </div><!-- col-sm -->
            <!-- <li><i class="fa fa-edit"></i>Modification</li>   --> 
                        
          </ol>
        </div>



<!--  <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-plus"></i> Modification Reporting</h3>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{route('home')}}">Accueil</a></li>
            <li><i class="fa fa-table"></i><a href="{{route('Activite.index')}}">Activités</a></li>   
            <li><i class="fa fa-edit"></i>Modification</li>              
          </ol>
        </div>
      </div> -->



        

      <div class="row">
        
        
        <div class="col-md-10" style="margin-left: 10%;">
        
                    <div class="panel panel-default">                               
                        <div class="panel-heading">
                            <h2><i class="fa fa-edit"></i><strong>Modification Reporting</strong></h2>
                        </div>
                        <div class="panel-body">
                          @foreach ($reportings as $reportings)
                          <form action="{{ route ('Reporting.update', $reportings->id)}}" method="post" enctype="multipart/form-data" class="form-vertical hover-stripped" role="form">
                       {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="modif" value="1">

                          <div class="form-group">
                          
                            <div class="col-md-8"> 
                            <label for="direction-w1">Début</label>
                          <input name="date_debut" type="date" class="form-control" value="{{$reportings->date_debut}}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="direction-w1">Fin</label>
                          <input name="date_fin" type="date" value="{{$reportings->date_fin}}" class="form-control">
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


   
         @stop