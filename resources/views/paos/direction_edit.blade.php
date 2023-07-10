@extends('pages.Default')
@section('content')
         
 @if(session()->has('success'))
      <div class="row">
     <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Succés!</strong> {{session()->get('message')}}.
              </div>
              </div>
              @endif 

              <div class="sh-pagebody">
               <div class="card-header bg-primary tx-white">Modification</div>   

 <div class="row">
        <div class="col-lg-12">
         
          <ol class="breadcrumb">
            <div class="col-sm-6 col-md-3 ">
              
                <a style="text-decoration:none" href="Liste-activités"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->

               <div class="smallstat red-bg">
            <a style="text-decoration:none" href="/Liste-directions"><button class="btn btn-primary btn-block mg-b-10">

            <i class="fa fa-building-o"></i> <span class="title">Directions</span></button></a>

            

          </div><!--/.smallstat-->


             <!-- <li><i class="fa fa-plus"></i>Ajout direction</li>  -->               
          </ol>
        </div>
      </div>


 
         
       

@foreach ($direction as $direction)


        

      <div class="row profile">
        
        
        <div class="col-md-8">
        
                    <div class="panel panel-default">                               
                        <div class="panel-heading">
                            <h2><i class="fa fa-edit red"></i><strong>Modification</strong></h2>
                        </div>
                        <div class="panel-body">
                           <form action="{{ route ('directionupdate', $direction->id)}}" method="post" enctype="multipart/form-data" class="form-vertical hover-stripped" role="form">
                       {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="modif" value="1">

                               <div class="form-group">
                             <label for="direction-w1">Nom</label>
                          <input name="nom" type="text" class="form-control" id="daterange" value="{{$direction->nom}}">
                        </div>  

                                    

                           

                <div class="form-group">
                  <label class="control-label" for="textarea2">Description</label>
                  <div class="controls">
                  <textarea id="description1" name="description"  id="limit" class="form-control" rows="6" style="width:100%">
                    {{$direction->description}}
                  </textarea>
                  </div>
                </div>

                  <div class="form-group">
                  <label class="control-label" for="textarea2">Objectif spécifique</label>
                  <div class="controls">
                  <textarea name="objectif"  id="limit" class="form-control" rows="6" style="width:100%">
                    {{$direction->objectif}}
                  </textarea>
                  </div>
                </div>
                              
                              
                       
                              <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </div>          
                                
                                        
                            </form>
                        </div>
                    </div>
          
        </div><!--/.col-->
      
      </div><!--/.row profile-->  


   

      @endforeach


       <script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>


<script type="text/javascript">
  CKEDITOR.replace( 'objectif');
  CKEDITOR.replace( 'description1');
</script>
         @stop