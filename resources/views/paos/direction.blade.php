@extends('pages.Default')
@section('content')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

   @if(session()->has('success'))
      <div class="row">
     <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                 <strong>Succès!</strong> Direction ajoutée avec succès.
              </div>
              </div>
              @endif    

              <div class="sh-pagetitle">
        <div class="input-group">
          
        </div><!-- input-group -->
       <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="fa fa-bank"></i></div>
 <div class="sh-pagetitle-title">
            
            <h2>Directions</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->

  <div class="sh-pagebody">
               <!-- <div class="card-header bg-primary tx-white"></i> Direction</div> -->   
          <div class="row">
        <div class="col-lg-12">
         
          <ol class="breadcrumb">
            <div class="col-sm-6 col-md-3 ">
              
                <a style="text-decoration:none" href="/dashboard"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->

               <div class="smallstat red-bg">
            <a style="text-decoration:none" href="#" data-toggle="modal" data-target="#ajout"><button class="btn btn-primary btn-block mg-b-10">

            <i class="fa fa-plus white-bg"></i> <span class="title">Ajout direction</span></button></a>

            

          </div><!--/.smallstat-->


             <!-- <li><i class="fa fa-plus"></i>Ajout direction</li>  -->               
          </ol>
        </div>
      </div>
     <div class="row">
        
      <!--  php if (Auth::user()->poste=="Administrateur"): ?>-->
         
        <!--   <php endif ?>-->


         <!-- Validation -->

                    <div class="modal fade" id="ajout">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Ajout direction</h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
        <form method="POST" action="ajoutdirection" enctype="multipart/form-data">
                        @csrf
          <p>         <div class="form-group">
                            <label for="textarea-input">Nom</label>
                            <div class="">
                               <input type="text" name="nom" class="form-control" required>
                            </div>
                        </div>

                       

                        <div class="form-group">
                            <label for="textarea-input">Description</label>
                            <div class="">
                                <textarea id="textarea-input" id="description1" name="description" rows="9" class="form-control" placeholder="Description.."></textarea>
                            </div>
                        </div>

                          <div class="form-group">
                            <label for="textarea-input">Objectif spécifique</label>
                            <div class="">
                                <textarea id="textarea-input" id="objectif1" name="objectif" rows="9" class="form-control" placeholder="Objectif spécifique..."></textarea>
                            </div>
                        </div>

                          </p>
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button class="btn btn-primary" type=" button submit"><i class="fa fa-trash"></i> Ajouter</button>
                        <input type="hidden" name="valide" value="0">
          </form>
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
             
      
      </div><!--/.row-->  
     

      <div class="row">   
        <div class="col-lg-12">
          <div class="panel panel-default">
            
            <div class="panel-body">
              
 <input class = "form-control" id = "demo" type = "text" placeholder = "Recherchez ici,..">
         <br>
         <div class=" table-responsive">

                           <table id="datatable1" class="table display responsive nowrap table-hover table-info mg-b-0">
            <thead  >
               <tr>
                    <th>Directions</th>
                     <th>Descriptions</th>
                     <th>Objectif Spécifique</th>
                    <th>Actions</th>
                  </tr>
            </thead>
            <tbody id = "test">
              @foreach ($direction as $direction)
                  <tr>
                   <td>   
                     {{$direction->nom}}
                  </td>
                  
                   <td>   
                     {!!$direction->description!!}
                  </td>
                  <td>   
                     {!!$direction->objectif!!}
                  </td>

                  <td>
                     
                   <!--  php if (Auth::user()->poste=="Administrateur"): ?>-->
                         
                     <a class="btn btn-info" href="{{ route ('editDirection', $direction->id)}}" title="Modifier" data-rel="tooltip">
                      <i class="fa fa-edit "></i>                                            
                    </a>
                    <a data-toggle="modal" data-target="#myModal{{$direction->id}}" type="button" class="btn btn-default" href="#" title="Suppression" data-rel="tooltip">
                      <i class="fa fa-trash-o "></i> 
                    </a>
                   <!--   <php endif ?>-->
                  </td>
                 
                  
                </tr>

                 <!-- Suppression -->

                    <div class="modal fade" id="myModal{{$direction->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Voulez-vous vraiment supprimer cet element ?</h4>
        </div>
        <div class="modal-body">
          <p>Cliquer sur SUPPRIMER si c'est le cas !</p>
        </div>
        <div class="modal-footer">
          <form action="{{ route ('directionupdate', $direction->id)}}" method="post" >
               {{ csrf_field() }}
              {{ method_field('PUT') }}
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button class="btn btn-primary" type=" button submit"><i class="fa fa-trash"></i> SUPPRIMER</button>
                        <input type="hidden" name="sup" value="0">
          </form>
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
                 @endforeach
               
            </tbody>
         </table>      
            </div>
          </div>
        </div><!--/col-->
      
      </div><!--/row--> 

      <script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>


<script type="text/javascript">
  CKEDITOR.replace( 'objectif');
  CKEDITOR.replace( 'description1');
</script>

  <script>
         $(document).ready(function(){
            $("#demo").on("keyup", function() {
               var value = $(this).val().toLowerCase();
               $("#test tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
               });
            });
         });
      </script> 
         @stop