


         @extends('pages.Default')
@section('content')

 <div class="sh-pagetitle">
        <div class="input-group">
          
        </div><!-- input-group -->
       <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="fa fa-folder"></i></div>
 <div class="sh-pagetitle-title">
            
            <h2>Plan d'Action Annuel</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->
        



 
      <div class="sh-pagebody">

       <!--  <div class="card bd-primary mg-t-20"> -->
          
          <!-- <div class="card-body pd-sm-30"> -->
            
        <!--   <h3 class="page-header"><i class="fa fa-table"></i> PAO</h3> -->
           @if((Auth::user()->user_role==5)||(Auth::user()->user_role==1)||(Auth::user()->user_role==2)||(Auth::user()->user_role==3)||(Auth::user()->user_role==8))
             <div class="col-sm-6 col-md-2">

                <a style="text-decoration:none" href="addactivite"><button  class="btn btn-outline-primary btn-block">

            <span class="title"></span><i class="fa fa-plus mg-r-10"></i>Ajout Activité</button></a>
                
              </div><!-- col-sm -->
               @endif
                <br>

                <form action="{{ route('activite')}}" method="POST" class="form-inline">
                {{ csrf_field() }}
                <input type="hidden" name="page" value="1">

<div class="row">

                           <div class="col-lg-2">
                       <div class="form-group">
                            <label class="control-label" for="select">Direction</label>
                            
                        <select id="select" name="direction" class="form-control" size="1">
                          <option value="-1">Toutes</option>
                            @foreach ($direction as $directions)
                             @if(isset($exist_dir) and ($exist_dir!=-1) and ($directions->id==$exist_dir))
           <option value="{{$directions->id}}" selected>{{$directions->sigle}}</option>
          @else
          <option value="{{$directions->id}}">{{$directions->sigle}}</option>
          @endif
                            @endforeach

                           

                                </select>
                        </div>
                        </div>
                        <div class="col-lg-2">
                      <div class="form-group">
                            <label class=" control-label" for="select">Statuts</label>
                         
                            <select id="select" name="statut" class="form-control" size="1">
                              <option value="-1">Tous</option>
                              @if(isset($exist_statut) and ($exist_statut!=-1) and ($exist_statut==0))
                               <option value="0" selected>Non démarré</option>
                              @else
                              <option value="0">Non démarré</option>
                              @endif

                               @if(isset($exist_statut) and ($exist_statut!=-1) and ($exist_statut==1))
                               <option value="1" selected>En Cours</option>
                              @else
                              <option value="1">En Cours</option>
                              @endif

                              @if(isset($exist_statut) and ($exist_statut!=-1) and ($exist_statut==2))
                               <option value="2" selected>Terminé</option>
                              @else
                              <option value="2">Terminé</option>
                              @endif

                              @if(isset($exist_statut) and ($exist_statut!=-1) and ($exist_statut==3))
                               <option value="3" selected>Retardé</option>
                              @else
                              <option value="3">Retardé</option>
                              @endif
                               @if(isset($exist_statut) and ($exist_statut!=-1) and ($exist_statut==4))
                               <option value="4" selected>Annulé</option>
                              @else
                              <option value="4">Annulé</option>
                              @endif
                                </select>
                          
                        </div>
                         </div>
                         
                          <div class="col-lg-2">
                        <div class="form-group">
                            <label class="control-label" for="input-small">Debut</label>
                             @if(isset($exist_debut))
                               <input type="date" id="input-small" name="date_debut" class="form-control input-sm" value="{{$exist_debut}}">
                              @else
                              <input type="date" id="input-small" name="date_debut" class="form-control input-sm" placeholder="">
                              @endif
                                
                            </div>
                        </div>
                        <div class="col-lg-2">
                         <div class="form-group">
                            <label class="control-label" for="input-small">Fin</label>
                              @if(isset($exist_fin))
                                <input type="date" id="input-small" name="date_fin" class="form-control input-sm" value="{{$exist_fin}}">
                              @else
                               <input type="date" id="input-small" name="date_fin" class="form-control input-sm" placeholder="">
                              @endif
                               
                            
                        </div>
                        </div>
                        
                       <div class="col-lg-2">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-dot-circle-o"></i> Filtrer</button>
                       <?php 
                       if (!isset($exist_dir)) {
                          $exist_dir=-1;
                        }

                        if (!isset($exist_statut)) {
                          $exist_statut=-1;
                        }

                        if (!isset($exist_debut)) {
                          $exist_debut=-1;
                        }

                        if (!isset($exist_fin)) {
                          $exist_fin=-1;
                        }

                         ?>
           <a target="_blank" href="{{route('pdfactivite',[$exist_dir,$exist_statut,$exist_debut,$exist_fin])}}" class="btn btn-sm btn-warning"><i class="fa fa-print"></i> Imprimer</a> </div> </div> 
                    </form>
          
  
            <div class="table-responsive mg-t-25">
              <table id="datatable1" class="table display responsive">
                <thead class="bg-info">
                  <tr>

                     <th>Directions</th>
                     <th style="width:8px;">Activités</th> 
                    <!-- <th >Indicateurs</th> -->
                    <th >Statuts</th>
                    <th >Début</th>
                    <th >Fin</th>
                    <th style="width:7px;">Financement</th>
                <th >Budget</th>
                    <th >Actions</th>
                    
                  </tr>
                </thead>

 <tfoot class="bg-info"> 
                  <tr>

                     <th>Directions</th>
                     <th style="width:5px;">Activités</th> 
                  <!--   <th>Indicateurs</th> -->
                    <th>Statuts</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Financement</th>
                <th>Budget</th>
                    <th>Actions</th>
                    
                  </tr>
                </tfoot>

                <tbody>
                   @foreach ($activite as $activites)
                  <tr>
                    <td><b>{{$activites->sigle}}</b></td>
                   @if($activites->sousactivite==1)
                  <td style="background: #f4dcac8f;border: 1px solid #cdb5b5;"><p><b>  {{$activites->libelle}}</b></p>
                    <p>
                       <a class="btn btn-warning" data-toggle="modal" data-target="#SousActiviteModal{{$activites->id}}" title="Voir les Sous-Activités" data-rel="tooltip">
                      <i class="fa fa-code-fork"> Sous-activités</i>
                      </a>
                      <!-- Modal Sous Activités -->

                      <div class="modal fade" id="SousActiviteModal{{$activites->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Liste Sous-Activités de [<span style="color: red;">{{$activites->libelle}}</span>]</h4>
        </div>
        <div class="modal-body">
           <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                  <tr style="background: #0b0e69;color: white;">
                    <th>Sous-Activités</th>
                    <th>Statuts</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Actions</th>
                  </tr>
                </thead>   
                <tbody>  
                <?php $sousactivites=getAllSousActivites($activites->id) ?> 
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

                    @if($sousactivite->niveau<=0)
                       <div class="progress" title="0%" data-rel="tooltip">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                          0%
                        </div>
                      </div>
                    @elseif($sousactivite->niveau>=100) 
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
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

                      <!-- Fin Modal Sous Activités -->
                    </p></td>
                  @else
                  <td><b> {{$activites->libelle}}</b></td>
                  @endif
                   <td>
                    @if($activites->statut==0)
                    <span class="label label-default">Non démarré</span>
                    @elseif($activites->statut==2) 
                    <span class="label label-primary">Terminé</span>
                    @elseif($activites->statut==3) 
                    <span class="label label-warning">Retardé</span>
                    @elseif($activites->statut==4) 
                    <span class="label label-danger">Annulé</span>
                    @else
                    <span class="label label-success">En Cours</span>
                    @endif

                    @if($activites->niveau==0)
                       <div class="progress" title="0%" data-rel="tooltip">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                          0%
                        </div>
                      </div>
                    @elseif($activites->niveau==100) 
                     <div class="progress" title="100%" data-rel="tooltip">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                          100%
                        </div>
                      </div>
                    @else
                     <div class="progress" title="{{$activites->niveau}}%" data-rel="tooltip">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$activites->niveau}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$activites->niveau}}%;">
                          {{$activites->niveau}}%
                        </div>
                      </div>
                    @endif
                 
                  </td>
                  <td>
                    {{(new DateTime($activites->date_debut))->format("d/m/Y")}}
                    @if($activites->reporter==1)
                    <a data-toggle="modal" data-target="#Reporting{{$activites->id}}" title="Voir les Reportings" data-rel="tooltip" style="font-size: 12px;color: red;cursor: pointer;font-weight: bold;">
                      Reportée <i class="fa fa-calendar"></i></a>
                    @endif

                    
                  </td>
                  <td>
                    {{(new DateTime($activites->date_fin))->format("d/m/Y")}}
                     @if($activites->reporter==1)
                     <a data-toggle="modal" data-target="#Reporting{{$activites->id}}" title="Voir les Reportings" data-rel="tooltip" style="font-size: 12px;color: red;cursor: pointer;font-weight: bold;">Reportée <i class="fa fa-calendar"></i></a>
                    @endif
                     <!-- Modal Sous Activités -->

                      <div class="modal fade" id="Reporting{{$activites->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Liste Reporting Activité [<span style="color: red;">{{$activites->libelle}}</span>]</h4>
        </div>
        <div class="modal-body">
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
                <?php $reportings=getAllReportings($activites->id) ?> 
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
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

                      <!-- Fin Modal Sous Activités -->
                  </td>
                  <td>
                    <p>
                        <u style="font-style: italic;">Financement prevu:</u>
                      </p>
                      <p style="color: #78b2e4;">
                        {{$activites->finan_prev}}
                      </p>
                      
                      <p>
                        <u style="font-style: italic;">Etat Financement:</u>
                      </p>
                      <p style="color: #78b2e4;">
                        {{$activites->etat_finan}}
                      </p>
                   
                  </td>
                  <td>{{$activites->budget}}</td>
                   <td>
                    <a href="{{ route ('activiteshow', $activites->id)}}" title="Voir l'activité"><button class="btn btn-success"><i class="fa fa-search-plus "></i></button></a>
      @if((Auth::user()->user_role==5)||(Auth::user()->user_role==1)||(Auth::user()->user_role==2)||(Auth::user()->user_role==3)||(Auth::user()->user_role==8))
                    <a class="btn btn-info" href="{{ route ('editActivite', $activites->id)}}" title="Modifier l'activité" data-rel="tooltip">
                      <i class="fa fa-edit "></i>                                           
                    </a>

                     <a class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$activites->id}}" title="Supprimer" data-rel="tooltip">
                      <i class="fa fa-trash-o " style="color: white;"></i> 

                    </a>
                    @endif


                  
                     <!-- Suppression -->

                    <div class="modal fade" id="myModal{{$activites->id}}">
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
          <form action="{{ route ('Activite.update', $activites->id)}}" method="post" >
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
            </div><!-- table-wrapper -->
          </div><!-- card-body -->
        </div><!-- card -->
        </div><!-- sh-pagebody -->

        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
         <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

        <script src="{{asset('assets/lib/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/lib/popper.js/popper.js')}}"></script>
    <script src="{{asset('assets/lib/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
    <script src="{{asset('assets/lib/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
     <script src="{{asset('assets/lib/select2/js/select2.min.js')}}"></script> 

    <script src="{{asset('assets/lib/select2/js/select2.min.js')}} ../js/shamcey.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>




    
    <script>
      $(function() {
        'use strict';

        $('#datatable1').DataTable({
          responsive: false,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });

        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true
        });


      });


         $(document).ready(function(){
            $("#demo").on("keyup", function() {
               var value = $(this).val().toLowerCase();
               $("#test tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
               });
            });
         });
       

        // $(document).ready(function(){
        //     $('#example').DataTable({
        //       dom: 'Bfrtip',
        //       buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ]
        //     } 
        //     });
        //  buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ]

      
         // $(document).ready(function(){
         //    $("#demo").on("keyup", function() {
         //       var value = $(this).val().toLowerCase();
         //       $("#test tr").filter(function() {
         //          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
         //       });
         //    });
         // });
   


    </script>
    
    @endsection

   
      
    




