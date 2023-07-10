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

  <div class="sh-pagetitle">
        <div class="input-group">
         <!--  <input type="search" class="form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn"><i class="fa fa-search"></i></button> -->
         <!--  </span> -->
        </div><!-- input-group -->
        <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="icon ion-ios-gear mg-t-3"></i></div>
          <div class="sh-pagetitle-title">
           
            <h2>Paramétrage Reunion Département</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->

      <div class="sh-pagebody">

 <ol class="breadcrumb">
     <div class="col-sm-6 col-md-3">
              
                <a style="text-decoration:none" href="/Liste-activités"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->

              <div class="col-sm-6 col-md-3">
              
                <a style="text-decoration:none" href="{{route('listereuniondepartement')}}"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-file-text"></i> Liste Compte Rendu</button></a>
                
              </div><!-- col-sm -->
             
           <!--  <li><i class="fa fa-plus"></i>Parametrer</li>   -->            
          </ol>
  <div class="card bd-primary mg-t-20">
          <!-- <div class="card-header bg-primary tx-white">Basic Content Wizard</div> -->
          <div class="card-body pd-sm-30">
            <!-- <p class="mg-b-20 mg-sm-b-30">Below is an example of a basic horizontal form wizard.</p>
 -->
            <div id="example-basic">
              <h3>Ordre du jour & Participants</h3>
              <section style="background: white;">

                <div class="col-md-12" style="">
                <div class="panel panel-default">                               
                        <div class="panel-heading">
                            <h2 style="font-size:20pt; color:#6495ED;"><img src="{{asset('images/doco.png')}}"  style="height: 50px; color: blue;"><strong> Ordre du jour</strong></h2>
                        </div>
                        <div class="panel-body">
                         <form action="{{ route ('reuniondepartementupdate', $id)}}" method="post">
                       {{ csrf_field() }}
                        {{ method_field('PUT') }}

                         <div class="form-group">
                            <!-- <label for="textarea-input" >Ordre du jour</label> -->
                            <div class="">
                                <textarea id="ordre" name="ordre" rows="5" class="form-control" placeholder="Ordre du jours..">{{$ordre}}</textarea>
                            </div>
                        </div>  
<!-- class="btn btn-primary" form-group pull-right -->
                           
                       
                              <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-primary" >Modifier</button>
                                </div>          
                                
                                        
                            </form>
                        </div>
                    </div>

                    <div class="panel panel-default">                               
                        <div class="panel-heading">
                            <h2 style="font-size:20pt; color:#6495ED;"><i class="icon ion-person-add"></i> <strong>Ajout participant</strong></h2>
                        </div>
                        <div class="panel-body">
                          <form method="POST" action="{{ route ('ajoutparticipantdepartement')}}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="reuniondepartement" value="{{$id}}">
                        <div class="form-group">
                             <label for="direction-w1"><strong>Nom</strong></label>
                          <input name="nom" type="text" class="form-control" id="daterange" value="" required>
                        </div>  

                           
                       
                              <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-primary btn-block mg-b-10">Ajouter</button>
                                </div>          
                                
                                        
                            </form>
                        </div>
                    </div>


                    <!-- Participants -->

                     <div class="panel panel-default">
            <div class="panel-heading">
              <h2 style="font-size:20pt; color:#6495ED;"><i class="icon ion-person-stalker"></i><span class="break"></span> <strong>Participants</strong></h2>
             <!--  <div class="panel-actions">
                <a href="table.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                <a href="table.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                <a href="table.html#" class="btn-close"><i class="fa fa-times"></i></a>
              </div> -->
            </div>
            <div class="panel-body">
             
              <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                  <tr style="background: #0b0e69;color: white;">
                    <th style="width:50%;">Nom</th>
                    <th>Actions</th>
                  </tr>
                </thead>   
                <tbody>   
                 @foreach ($participantdepartement as $participantdepartements)             
                <tr>
                  <td>{{$participantdepartements->nom}}</td>
                  <td>
                    <a class="btn btn-info" data-toggle="modal" data-target="#modif{{$participantdepartements->id}}" title="Modifier" data-rel="tooltip">
                      <i class="fa fa-edit " style="color: white;" ></i>                                            
                    </a>
                    <!-- modification -->
                    <div class="modal fade" id="modif{{$participantdepartements->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">MODIFICATION</h4>
        </div>
        <div class="modal-body">
           <form action="{{ route ('participantdepartementupdate', $participantdepartements->id)}}" method="post" enctype="multipart/form-data" class="form-vertical hover-stripped" role="form">
                       {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="modif" value="1">

                      
                        <div class="form-group">
                             <label for="direction-w1">NOM</label>
                          <input name="nom" type="text" class="form-control" id="daterange" value="{{$participantdepartements->nom}}" required>
                        </div>  
        </div>
        <div class="modal-footer">
          
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button class="btn btn-primary" type=" button submit"><i class="fa fa-trash" style="color: white;" ></i> MODIFIER</button>
          </form>
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
                   
                  
                    <a class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$participantdepartements->id}}" title="Supprimer" data-rel="tooltip">
                      <i class="fa fa-trash-o " style="color: white;" ></i> 

                    </a>
                     <!-- Suppression -->

                    <div class="modal fade" id="myModal{{$participantdepartements->id}}">
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
          <form action="{{ route ('participantdepartementupdate', $participantdepartements->id)}}" method="post" >
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
                  </td>
                </tr>
                @endforeach
                
                </tbody>
              </table>            
            </div>
          </div></div>
              </section>
<h3>Interventions</h3>
              <section style="background: white;">
               
                    <div class="panel panel-default">                               
                        <div class="panel-heading">
                            <h2 style="font-size:20pt; color:#6495ED;"><img src="{{asset('images/lo.png')}}"  style="height: 40px;"> <strong>Ajout Intervention</strong></h2>
                        </div>
                        <div class="panel-body">
                          <form method="POST" action="{{ route ('ajoutexposedepartement')}}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="reuniondepartement" value="{{$id}}">
                        <div class="form-group">
                             <label for="direction-w1"><strong>Exposant</strong></label>
                          <input name="exposant" type="text" class="form-control" id="daterange" value="" required>
                        </div>

                         <div class="form-group">
                            <label for="textarea-input"><strong>Exposé</strong></label>
                            <div class="">
                                <textarea id="expose" name="details" rows="9" class="form-control" placeholder="Description.."></textarea>
                            </div>
                        </div>  

                           
                       
                              <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </div>          
                                
                                        
                            </form>
                        </div>
                    </div>



                     <div class="panel panel-default">
            <div class="panel-heading">
              <h2 style="font-size:20pt; color:#6495ED;"><img src="{{asset('images/do.png')}}"  style="height: 40px; "><span class="break"></span><strong>Exposés</strong></h2>
             <!--  <div class="panel-actions">
                <a href="table.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                <a href="table.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                <a href="table.html#" class="btn-close"><i class="fa fa-times"></i></a>
              </div> -->
            </div>
            <div class="panel-body">
             
              <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                  <tr style="background: #0b0e69;color: white;">
                    <th style="width:40%;">Exposant</th>
                    <th style="width:40%;">Details</th>
                    <th>Actions</th>
                  </tr>
                </thead>   
                <tbody>   
                 @foreach ($exposedepartement as $exposedepartements)             
                <tr>
                  <td>{{$exposedepartements->exposant}}</td>
                  <td>{!!$exposedepartements->details!!}</td>
                  <td>
                    <a class="btn btn-info" data-toggle="modal" data-target="#modifexpo{{$exposedepartements->id}}" title="Modifier" data-rel="tooltip">
                      <i class="fa fa-edit " style="color: white;" ></i>                                            
                    </a>
                    <!-- modification -->
                    <div class="modal fade" id="modifexpo{{$exposedepartements->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">MODIFICATION</h4> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
           <form action="{{ route ('exposedepartementupdate', $exposedepartements->id)}}" method="post" enctype="multipart/form-data" class="form-vertical hover-stripped" role="form">
                       {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="modif" value="1">

                      
                        <div class="form-group">
                             <label for="direction-w1">Exposant</label>
                          <input name="exposant" type="text" class="form-control" id="daterange" value="{{$exposedepartements->exposant}}" required>
                        </div>  

                        <div class="form-group">
                            <label for="textarea-input">Exposé</label>
                            <div class="">
                                <textarea id="expose2" name="details" rows="9" class="form-control" placeholder="Description..">{{$exposedepartements->details}}</textarea>
                            </div>
                        </div>  
        
        <div class="modal-footer">
          
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button class="btn btn-primary" type=" button submit"><i class="fa fa-trash" style="color: white;" ></i> MODIFIER</button>
          </form>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
                   
                  
                    <a class="btn btn-danger" data-toggle="modal" data-target="#myModalexpo{{$exposedepartements->id}}" title="Supprimer" data-rel="tooltip">
                      <i class="fa fa-trash-o " style="color: white;" ></i> 

                    </a>
                     <!-- Suppression -->

                    <div class="modal fade" id="myModalexpo{{$exposedepartements->id}}">
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
          <form action="{{ route ('exposedepartementupdate', $exposedepartements->id)}}" method="post" >
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
                  </td>
                </tr>
                @endforeach
                
                </tbody>
              </table>            
            </div>
          </div>

                    <!-- Fin participants -->
          
        
              </section>


              <h3>Recommandation</h3>
              <section style="background: white;">
               
                    <div class="panel panel-default">                               
                        <div class="panel-heading">
                            <h2 style="font-size:20pt; color:#6495ED;"><i class="fa fa-edit red"></i><strong>Ajout recommandation</strong></h2>
                        </div>
                        <div class="panel-body">
                          <form method="POST" action="{{ route ('ajoutrecommandationdepartement')}}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="reuniondepartement" value="{{$id}}">
                        <div class="form-group">
                             <label for="direction-w1">Recommandation</label>
                           <textarea id="details" name="details" rows="9" class="form-control" required></textarea>
                        </div>  

                           
                       
                              <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </div>          
                                
                                        
                            </form>
                        </div>
                    </div>


                     <div class="panel panel-default">
            <div class="panel-heading">
              <h2 style="font-size:20pt; color:#6495ED;"><img src="{{asset('images/so.png')}}"  style="height: 40px;"><span class="break"></span><strong>Recommandations</strong></h2>
             <!--  <div class="panel-actions">
                <a href="table.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                <a href="table.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                <a href="table.html#" class="btn-close"><i class="fa fa-times"></i></a>
              </div> -->
            </div>
            <div class="panel-body">
             
              <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                  <tr style="background: #0b0e69;color: white;">
                    <th style="width:50%;">Details</th>
                    <th>Actions</th>
                  </tr>
                </thead>   
                <tbody>   
                  @foreach ($recommandationdepartement as $recommandationdepartements)              
                <tr>
                  <td>{{$recommandationdepartements->details}}</td>
                  <td>
                    <a class="btn btn-info" data-toggle="modal" data-target="#modifrec{{$recommandationdepartements->id}}" title="Modifier" data-rel="tooltip">
                      <i class="fa fa-edit " style="color: white;" ></i>                                            
                    </a>
                    <!-- modification -->
                    <div class="modal fade" id="modifrec{{$recommandationdepartements->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">MODIFICATION</h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
           <form action="{{ route ('recommandationdepartementupdate', $recommandationdepartements->id)}}" method="post" enctype="multipart/form-data" class="form-vertical hover-stripped" role="form">
                       {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="modif" value="1">

                      
                        <div class="form-group">
                             <label for="direction-w1">Details</label>
                             <textarea id="details2" name="details" rows="9" class="form-control" required>{{$recommandationdepartements->details}}</textarea>
                         
                        </div>  
        
        <div class="modal-footer">
          
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button class="btn btn-primary" type=" button submit"><i class="fa fa-trash"></i> MODIFIER</button>
          </form>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
                   
                  
                    <a class="btn btn-danger" data-toggle="modal" data-target="#myModalrec{{$recommandationdepartements->id}}" title="Supprimer" data-rel="tooltip">
                      <i class="fa fa-trash-o " style="color: white;" ></i> 

                    </a>
                     <!-- Suppression -->

                    <div class="modal fade" id="myModalrec{{$recommandationdepartements->id}}">
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
          <form action="{{ route ('recommandationdepartementupdate', $recommandationdepartements->id)}}" method="post" >
               {{ csrf_field() }}
              {{ method_field('PUT') }}
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button class="btn btn-primary" type=" button submit"><i class="fa fa-trash" style="color: white;" ></i> SUPPRIMER</button>
                        <input type="hidden" name="sup" value="0">
          </form>
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
                  </td>
                </tr>
                @endforeach
                
                </tbody>
              </table>            
            </div>
          </div>

                    <!-- Fin recommandation -->
          
    
                    
              </section>
              
             
            </div>
          </div><!-- card-body -->
        </div><!-- card -->
      </div><!-- card -->

     <link href="{{asset('assets/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('assets/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet"> 
     <link href="{{asset('assets/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('assets/lib/jquery.steps/jquery.steps.css')}}" rel="stylesheet"> 

    
    <link rel="stylesheet" href="{{asset('assets/css/shamcey.css')}}">
       <script src="{{asset('assets/lib/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/lib/popper.js/popper.js')}}"></script>
    <script src="{{asset('assets/lib/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
    <script src="{{asset('assets/lib/jquery.steps/jquery.steps.js')}}"></script>
     <script src="{{asset('assets/lib/parsleyjs/parsley.js')}}"></script>

    <!-- <script src="{{asset('assets/js/shamcey.js')}}"></script> -->
    
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script type="text/javascript">
 
</script>      

<script>

$("#example-basic").steps({
    headerTag: "h3",
    bodyTag: "section",
    autoFocus: true,
     titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>'
});



</script>
 <script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

<script type="text/javascript">
  CKEDITOR.replace( 'expose' );
  CKEDITOR.replace( 'expose2' );
  CKEDITOR.replace( 'ordre' );
  CKEDITOR.replace( 'details' );
  CKEDITOR.replace( 'details2' );
</script>
@stop